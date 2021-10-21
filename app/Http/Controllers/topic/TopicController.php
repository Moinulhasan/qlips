<?php

namespace App\Http\Controllers\topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Http\Resources\topic\TopicResource;
use App\Repository\topic\TopicRepositoryInterface;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use mysql_xdevapi\Exception;

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
        $data = $this->topic->getAll(true);
        return view('pages.topics', ['data' => $data]);
    }

    public function create(TopicRequest $request)
    {
        try {
            $output = $this->topic->createCustomTopic($request, 'api');
            return ['status' => true, 'data' => $output];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function createTopic(TopicRequest $request)

    {
        try {
            $output = $this->topic->createCustomTopic($request);
            if ($output == true) {
                return redirect()->back()->with('success', 'Topic add successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
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

    public function topicStatusChange(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        try {
            $output = $this->topic->updateStatus($id, $status);
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

