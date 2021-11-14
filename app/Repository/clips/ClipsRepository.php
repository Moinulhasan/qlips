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
            $forPush = $advisor->name.','.$advisor->profession;
            $this->testNotification($forPush);
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
            $checkStatus = $this->status->getSingle($clips->status_id);
            $status = $this->status->getSingleWith($data);
            $clips->status()->associate($status);
            $clips->save();
            if ($data == 'Active')
            {
                // check already active or not

                if ($checkStatus->name != 'Active')
                {
                    $advisor = $this->advisor->getSingle($clips->advisor_id);
                    $forPush = $advisor->name.','.$advisor->profession;
                    $this->testNotification($forPush);
                }

            }
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
//        $clips = $this->model->with('question', 'question.topic', 'advisor', 'status')
//            ->whereHas('question.topic', function ($app) use ($id) {
//                $app->where('topic_id', $id);
//            })->whereHas('status',function ($app){
//                $app->where('name','=','Active');
//            })->orderBy('created_at','desc')
//            ->paginate(15);
        return $sum;
    }

    public function checkUserUpvoteOrListening($relation,$user_id,$clip)
    {
        $data = $this->model;
        if ($relation == 'user')
        {
            $data = $data->with('user');
            $data = $data->whereHas('user',function ($app) use($user_id,$clip){
                $app->where('user_id',$user_id)->where('qlips_id',$clip);
            });

        }
        else{
            $data = $data->with('userLisining')->whereHas('userLisining',function ($app) use($user_id,$clip){
                $app->where('user_id',$user_id)->where('qlips_id',$clip);
            });
        }

        $data = $data->first();
        return $data;
    }
    public function testNotification($advisor)
    {

        $url = "https://fcm.googleapis.com/fcm/send";
        $token = "/topics/global";
        $serverKey = 'AAAA_NgPeG8:APA91bE4-PTg3VzbTxfRhx_0VAA_XnAHi_ufx9czP5ZAcENHMk_FOvx728v8kPp11ddFLwosMEVbF6EQVgFYrloltVbSLzl02TxoruXcYUmFe7pGuHISl9OZL2jL_Th3kx097Q4eRDxn';
        $title = "New Qlip added";
        $body = $advisor." shares his insights.";
        $notification = array('title' =>$title ,'body'=>$body,'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

//        return $result;
    }
}
