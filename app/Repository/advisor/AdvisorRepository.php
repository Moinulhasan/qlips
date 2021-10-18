<?php


namespace App\Repository\advisor;


use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdvisorRepository extends \App\Repository\BasicRepository implements AdvisorRepositoryInterface
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

        public function store($data)
        {
            DB::beginTransaction();
            try {
                $advisor = new $this->model;
                $advisor->name = $data['name'];
                $advisor->profession = $data['profession'];
                $advisor->image = $data['image']->store('image/advisor','public');
                $status = $this->status->getSingleWith('Active');
                $advisor->status()->associate($status);
                $advisor->save();
                DB::commit();
                return true;
            }catch (\Exception $exception)
            {
                DB::rollBack();
                return false;
            }
        }

        public function updateStatus($data,$id)
        {
            try {
                $advisor = $this->model->find($id);
                $status = $this->status->getSingleWith($data);
                $advisor->status()->associate($status);
                $advisor->save();
                return true;
            }catch (\Exception $exception)
            {
                return false;
            }
        }
}
