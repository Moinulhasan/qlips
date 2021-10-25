<?php


namespace App\Repository\clips;


use App\Models\UserListening;
use App\Models\UserQlips;
use App\Repository\advisor\AdvisorRepositoryInterface;
use App\Repository\question\QuestionRepositoryInterface;
use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

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
        return $this->model->with('question', 'advisor', 'status')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function updateStatus($data, $id)
    {
        try {
            $clips = $this->model->find($id);
            $status = $this->status->getSingleWith($data);
            $clips->status()->associate($status);
            $clips->save();
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getAllActive($name)
    {
        return $this->model->with('question', 'advisor', 'status')
            ->whereHas('status', function ($app) use ($name) {
                $app->where('name', '=', $name);
            })->orderBy('created_at', 'desc')->paginate(20);
    }

    public function getRelationClips($id, $relation)
    {
        return $this->model->with('status', $relation)
            ->whereHas('status', function ($app) {
                $app->where('name', '=', 'Active');
            })->whereHas($relation, function ($app) use ($id) {
                $app->where('id', $id);
            })->orderBy('created_at','desc')
            ->paginate(20);
    }

    public function getCount($id,$relation)
    {
        return $this->model->with('status',$relation)->whereHas('status', function ($app) {
            $app->where('name', '=', 'Active');
        })->whereHas($relation, function ($app) use ($id) {
            $app->where('id', $id);
        })->sum('listing');
    }

    public function updateUpvote($user, $id)
    {
        $clips = $this->model->find($id);
        // first check if already have
        $check = UserQlips::where('user_id', $user)
            ->where('qlips_id', $id)
            ->first();
        if ($check) {
            $clips->user()->detach();
            $clips->upvote = ($clips->upvote - 1);
        } else {
            $clips->user()->sync($user);
            $clips->upvote = ($clips->upvote + 1);
        }
        $clips->save();
        return $clips;

    }

    public function updateListening($user, $id)
    {
        $clips = $this->model->find($id);
        // first check if already have
        $check = UserListening::where('user_id', $user)
            ->where('qlips_id', $id)
            ->first();
        if ($check) {
            $clips->userLisining()->detach();
            $clips->listing = ($clips->listing - 1);
        } else {
            $clips->userLisining()->sync($user);
            $clips->listing = ($clips->listing + 1);
        }
        $clips->save();
        return $clips;

    }

    public function recentQuestionClips()
    {
        $question = $this->question->getRecentQuestion();
        $id = $question->id;
        $clips = $this->model->with('question', 'advisor', 'status')
            ->whereHas('question', function ($app) use ($id) {
                $app->where('id', $id)->with('status', 'advisor')->whereHas('status', function ($jj) {
                    $jj->where('name', '=', 'Active');
                });

            })->whereHas('status', function ($kk) {
                $kk->where('name', '=', 'Active');
            })->paginate(20);
        return ['question' => $question, 'clips' => $clips];
    }

    public function topicClips($id)
    {
        $sum = $this->model->with('question', 'question.topic', 'advisor', 'status')
            ->whereHas('question.topic', function ($app) use ($id) {
                $app->where('topic_id', $id);
            })->whereHas('status',function ($app){
                $app->where('name','=','Active');
            })
            ->sum('listing');
        $clips = $this->model->with('question', 'question.topic', 'advisor', 'status')
            ->whereHas('question.topic', function ($app) use ($id) {
                $app->where('topic_id', $id);
            })->whereHas('status',function ($app){
                $app->where('name','=','Active');
            })->orderBy('created_at','desc')
            ->paginate(15);
        return ['sum'=>$sum,'clips'=>$clips];
    }

}
