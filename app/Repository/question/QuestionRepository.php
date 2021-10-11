<?php


namespace App\Repository\question;


use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuestionRepository extends \App\Repository\BasicRepository implements QuestionRepositoryInterface
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

    public function createCustom($data)
    {
        DB::beginTransaction();
        try {
            $question = new $this->model;
            $question->name = $data['name'];
            $status = $this->status->getSingle($data['status']);
            $question->status()->associate($status);
            $question->save();

            if (isset($data['topic'])){
                foreach ($data['topic'] as $topic)
                {
                    $question->topic()->sync($topic);
                }
            }
            DB::commit();
            return true;
        }catch (\Exception $exception)
        {
            DB::rollBack();
            return false;
        }
    }

}
