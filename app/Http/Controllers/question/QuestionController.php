<?php

namespace App\Http\Controllers\question;

use App\Http\Controllers\Controller;
use App\Http\Requests\question\QuestionRequest;
use App\Repository\question\QuestionRepositoryInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //

    /**
     * @var QuestionRepositoryInterface
     */
    private $question;

    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->question = $questionRepository;
    }

    public function createQuestion(QuestionRequest $request)
    {
        try {
            $output = $this->question->createCustom($request->all());
            if ($output == true){
                return ['status'=>true,'data'=>$output];
            }else{
                return['status'=>false,'message'=>'something went wrong'];
            }
        }catch (\Exception $exception)
        {
            return['status'=>false,'message'=>'something went wrong'];
        }
    }

    public function getAllCustom()
    {

    }
}
