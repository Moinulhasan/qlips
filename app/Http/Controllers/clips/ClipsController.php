<?php

namespace App\Http\Controllers\clips;

use App\Http\Controllers\Controller;
use App\Http\Requests\clips\ClipsRequest;
use App\Repository\advisor\AdvisorRepositoryInterface;
use App\Repository\clips\ClipsRepositoryInterface;
use App\Repository\question\QuestionRepositoryInterface;
use Illuminate\Http\Request;

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
        return view("pages.audioClips",['data'=>$data]);
    }

    public function uploadAudio()
    {
        $question = $this->question->getAll();
        $advisor = $this->advisor->getAll();
        return view("pages.uploadAudio",[
            'questions'=>$question,
            'advisors'=>$advisor
        ]);
    }

    public function store(ClipsRequest $request)
    {
        try
        {
            $output = $this->clips->store($request->all());
            if ($output == true)
            {
                return redirect()->route('audio.index')->with('success', 'Clips add successfully');
            }else{
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }
        }catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

    public function audioUpdate(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        try {
            $output = $this->clips->updateStatus($status,$id);
            if ($output == true) {
                return redirect()->back()->with('success', 'Clips status update successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }

        }catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }
}
