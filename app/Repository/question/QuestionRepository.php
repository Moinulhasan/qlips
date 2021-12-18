<?php


namespace App\Repository\question;


use App\Models\CustomStatus;
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
            $question->question = $data['name'];
            $status = $this->status->getSingleWith('Active');
            $question->status()->associate($status);
            $question->save();

            if (isset($data['topic'])) {

                $question->topic()->sync($data['topic']);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }

    public function updateStatus($data, $id)
    {
        try {
            $advisor = $this->model->find($id);
            $status = $this->status->getSingleWith($data);
            $advisor->status()->associate($status);
            $advisor->save();
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getRecentQuestion()
    {
        return $this->model->orderBy('created_at', 'desc')->take(1)->first();
    }

    public function allClips()
    {
        $hiden = CustomStatus::where('name', 'Hide')->first();
        return $this->model->with(['clips' => function ($app) use ($hiden) {
            $app->where('status_id', '!=', $hiden->id);
        }, 'clips.advisor' => function ($op) use ($hiden) {
            $op->where('status_id', '!=', $hiden->id);
        }, 'topic' => function ($jj) use ($hiden) {
            $jj->where('status_id', '!=', $hiden->id);
        }])->where('status_id', '!=', $hiden->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    public function recentClipsQuestion()
    {
        $hiden = CustomStatus::where('name', 'Hide')->first();
        return $this->model->with(['clips' => function ($app) use ($hiden) {
            $app->where('status_id', '!=', $hiden->id);
        }, 'clips.advisor' => function ($op) use ($hiden) {
            $op->where('status_id', '!=', $hiden->id);
        }, 'topic' => function ($jj) use ($hiden) {
            $jj->where('status_id', '!=', $hiden->id);
        }])->where('status_id', '!=', $hiden->id)
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();
    }

    public function topicClipsQuestion($id)
    {
        $hiden = CustomStatus::where('name', 'Hide')->first();
        return $this->model->with(['topic', 'clips' => function ($ok) use ($hiden) {
            $ok->where('status_id', '!=', $hiden->id);
        }, 'clips.advisor'])
            ->whereHas('topic', function ($app) use ($id) {
                $app->with('status')->whereHas('status', function ($kk) {
                    $kk->where('name', '!=', 'Hide');
                })->where('topic_id', $id);
            })->where('status_id','!=',$hiden->id)->orderBy('created_at', 'desc')->paginate(20);
    }

}
