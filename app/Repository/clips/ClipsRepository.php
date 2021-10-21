<?php


namespace App\Repository\clips;


use App\Repository\advisor\AdvisorRepositoryInterface;
use App\Repository\question\QuestionRepositoryInterface;
use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClipsRepository extends \App\Repository\BasicRepository implements ClipsRepositoryInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    private $question;
    /**
     * @var AdvisorRepositoryInterface
     */
    private $advisor;
    /**
     * @var StatusRepositoryInterface
     */
    private $status;

    public function __construct(Model $model,
                                QuestionRepositoryInterface $questionRepository,
                                AdvisorRepositoryInterface $advisorRepository,
                                StatusRepositoryInterface $statusRepository
    )
    {
        parent::__construct($model, $questionRepository, $advisorRepository);
        $this->model = $model;
        $this->question = $questionRepository;
        $this->advisor = $advisorRepository;
        $this->status = $statusRepository;
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $clip = new $this->model;
            $question = $this->question->getSingle($data['question']);
            $clip->question()->associate($question);

            $advisor = $this->advisor->getSingle($data['advisor']);
            $clip->advisor()->associate($advisor);

            if (isset($data['url'])) {
                $clip->youtube = $data['url'];
            }
            $clip->content_size = $data['audio']->getSize();
            $clip->content = $data['audio']->store('audio', 'public');
            $clip->upvote = $data['upvote'];
            $clip->listing = $data['listening'];
            $status = $this->status->getSingleWith('Active');
            $clip->status()->associate($status);
            $clip->save();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    public function getAllCustom()
    {
        return $this->model->with('question','advisor','status')->orderBy('created_at','desc')->paginate(10);
    }
    public function updateStatus($data,$id)
    {
        try {
            $clips = $this->model->find($id);
            $status = $this->status->getSingleWith($data);
            $clips->status()->associate($status);
            $clips->save();
            return true;
        }catch (\Exception $exception)
        {
            return false;
        }
    }

}