<?php

namespace App\Http\Controllers\question;

use App\Http\Controllers\Controller;
use App\Http\Requests\question\QuestionRequest;
use App\Repository\advisor\AdvisorRepositoryInterface;
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

    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        TopicRepositoryInterface $topicRepository,
        AdvisorRepositoryInterface $advisorRepository
    )
    {
        $this->question = $questionRepository;
        $this->topic = $topicRepository;

    }

    public function index()
    {
        $topics = $this->topic->getAll();
        $question = $this->question->getAll(true);
        return view('pages.questions',['topics'=>$topics,'questions'=>$question]);
    }

    public function createQuestion(QuestionRequest $request)
    {
        try {
            $output = $this->question->createCustom($request->all());
            if ($output == true){
                return redirect()->back()->with('success', 'Question add successfully');
            }else{
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }
        }catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

    public function questionStatusUpdate(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        try {
            $output = $this->question->updateStatus($status,$id);
            if ($output == true) {
                return redirect()->back()->with('success', 'Topic status update successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

}
