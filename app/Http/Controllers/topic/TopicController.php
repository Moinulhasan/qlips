<?php

namespace App\Http\Controllers\topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Http\Resources\topic\TopicResource;
use App\Repository\topic\TopicRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicController extends Controller
{
    //

    /**
     * @var TopicRepositoryInterface
     */
    private $topic;

    public function __construct(TopicRepositoryInterface $topicRepository)
    {
        $this->topic = $topicRepository;
    }

    public function index()
    {

    }

    public function create(TopicRequest $request)
    {
        try {
            $output = $this->topic->createCustomTopic($request);
            return ['status' => true, 'data' => $output];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function getAll()
    {
        try {
            $output = $this->topic->getAll();
            return ['status' => true, 'data' => TopicResource::collection($output)];
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }
}
