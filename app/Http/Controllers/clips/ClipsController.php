<?php

namespace App\Http\Controllers\clips;

use App\Http\Controllers\Controller;
use App\Http\Requests\clips\ClipsRequest;
use App\Http\Resources\clips\ClipsResource;
use App\Http\Resources\clips\TopicClipsResource;
use App\Repository\advisor\AdvisorRepositoryInterface;
use App\Repository\clips\ClipsRepositoryInterface;
use App\Repository\question\QuestionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class ClipsController extends Controller
{
    //
    /**
     * @var ClipsRepositoryInterface
     */
    private $clips;
    /**
     * @var QuestionRepositoryInterface
     */
    private $question;
    /**
     * @var AdvisorRepositoryInterface
     */
    private $advisor;

    public function __construct(ClipsRepositoryInterface $clipsRepository,
                                QuestionRepositoryInterface $questionRepository,
                                AdvisorRepositoryInterface $advisorRepository
    )
    {
        $this->clips = $clipsRepository;
        $this->question = $questionRepository;
        $this->advisor = $advisorRepository;
    }

    public function index()
    {
        $data = $this->clips->getAllCustom();
        return view("pages.audioClips", ['data' => $data]);
    }

    public function uploadAudio()
    {
        $question = $this->question->getAllStatus();
        $advisor = $this->advisor->getAllStatus();
        return view("pages.uploadAudio", [
            'questions' => $question,
            'advisors' => $advisor
        ]);
    }

    public function store(ClipsRequest $request)
    {
        try {
            $output = $this->clips->store($request->all());
            if ($output == true) {
                return redirect()->route('audio.index')->with('success', 'Clips add successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

    public function audioUpdate(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        try {
            $output = $this->clips->updateStatus($status, $id);
            if ($output == true) {
                return redirect()->back()->with('success', 'Clips status update successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

    public function getAll()
    {
        try {
            $output = $this->clips->getAllActive('Active');
            $final = ClipsResource::collection($output);
            return ['status' => true, 'data' => $final->response()->getData(true)];
        } catch (Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function getQuestionClips($id)
    {
        try {
            $output = $this->clips->getRelationClips($id, 'question');
            $final = ClipsResource::collection($output);
            return ['status' => true, 'data' => $final->response()->getData()];
        } catch (Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function getAdvisorClips($id)
    {
        try {
            $output = $this->clips->getRelationClips($id, 'advisor');
            $count = $this->clips->getCount($id,'advisor');
            $final  = ClipsResource::collection($output);
            return ['status' => true, 'total_listening'=>(int)$count,'data' => $final->response()->getData()];
        } catch (Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function updateUpvote($id)
    {
        try {
            $user = Auth::guard('sanctum')->user();

            $output = $this->clips->updateUpvote($user->id, $id);
            return ['status' => true, 'data' => new ClipsResource($output)];
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function updateListeningItem($id)
    {
        $user = Auth::guard('sanctum')->user();

        $output = $this->clips->updateListening($user, $id);
        return ['status' => true, 'data' => new ClipsResource($output)];
    }

    public function recentClips()
    {
        try {
            $output = $this->clips->recentQuestionClips();
            $final = ClipsResource::collection($output['clips']);
            return ['status' => true, 'question' => $output['question'], 'data' => $final->response()->getData()];
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function topicClips($id)
    {
        try {
            $output = $this->clips->topicClips($id);
            $final = TopicClipsResource::collection($output['clips']);
            return ['status' => true, 'total_listening' => (int)$output['sum'], 'data' => $final->response()->getData()];
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }


}
