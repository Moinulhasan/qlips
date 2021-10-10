<?php


namespace App\Repository\topic;


use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopicRepository extends \App\Repository\BasicRepository implements TopicRepositoryInterface
{


    /**
     * @var StatusRepositoryInterface
     */
    private $status;

    public function __construct(Model $model, StatusRepositoryInterface $statusRepository)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->status = $statusRepository;
    }

    public function createCustomTopic($data)
    {
        DB::beginTransaction();
        try {
            $topic = new $this->model;
            $topic->name = $data['name'];
            $topic->slug = str_replace(' ','_',strtolower($data['name']));
            $topic->thumbnail = $data['thumbnail']->store('images/topic','public');
            $status = $this->status->getSingleWith($data['status']);
            $topic->status()->associate($status);
            $topic->save();
            DB::commit();
            return $topic;
        }catch (\Exception $exception)
        {
            DB::rollBack();
            return false;
        }
    }
}
