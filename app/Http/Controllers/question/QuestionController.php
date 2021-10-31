<?php

namespace App\Http\Controllers\question;

use App\Http\Controllers\Controller;
use App\Http\Requests\question\QuestionRequest;
use App\Http\Resources\question\QuestionClipsResource;
use App\Http\Resources\question\QuestionResource;
use App\Repository\advisor\AdvisorRepositoryInterface;
use App\Repository\clips\ClipsRepositoryInterface;
use App\Repository\question\QuestionRepositoryInterface;
use App\Repository\topic\TopicRepositoryInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //

    /**
     * @var QuestionRepositoryInterface
     */
    private $question;
    /**
     * @var TopicRepositoryInterface
     */
    private $topic;
    /**
     * @var AdvisorRepositoryInterface
     */
    private $avdisor;
    /**
     * @var ClipsRepositoryInterface
     */
    private $clip;

    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        TopicRepositoryInterface $topicRepository,
        AdvisorRepositoryInterface $advisorRepository,
        ClipsRepositoryInterface $clipsRepository
    )
    {
        $this->question = $questionRepository;
        $this->topic = $topicRepository;
        $this->clip = $clipsRepository;

    }

    public function index()
    {
        $topics = $this->topic->getAllStatus();
        $question = $this->question->getAll(true);
        return view('pages.questions', ['topics' => $topics, 'questions' => $question]);
    }

    public function createQuestion(QuestionRequest $request)
    {
        try {
            $output = $this->question->createCustom($request->all());
            if ($output == true) {
                return redirect()->back()->with('success', 'Question add successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

    public function questionStatusUpdate(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        try {
            $output = $this->question->updateStatus($status, $id);
            if ($output == true) {
                return redirect()->back()->with('success', 'Topic status update successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

    public function getAllQuestion()
    {
        try {
            $output = $this->question->getAllStatus();
            return ['status' => true, 'data' => QuestionResource::collection($output)];
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function questionClips()
    {
        try {
            $output = $this->question->allClips();
            $final = QuestionClipsResource::collection($output);
            return ['status' => true, 'data' => $final->response()->getData()];
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function recentQuestionClips()
    {
        try {
            $output = $this->question->recentClipsQuestion();
            $final = QuestionClipsResource::collection($output);
            return ['status' => true, 'data' => $final];
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function topicQuestionClips($id)
    {
        try {
            $output = $this->question->topicClipsQuestion($id);
            $final = QuestionClipsResource::collection($output);
            $summ = $this->clip->topicClips($id);
            return ['status' => true,'total'=>(int)$summ, 'data' => $final->response()->getData()];
        }catch (\Exception $exception)
        {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

}
