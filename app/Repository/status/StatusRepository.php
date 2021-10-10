<?php


namespace App\Repository\status;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class StatusRepository extends \App\Repository\BasicRepository implements StatusRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function customCreate($data)
    {
        DB::beginTransaction();
        try {
            $status =new $this->model;
            $status->name = $data['name'];
            $status->slug = str_replace(' ', '_', strtolower($data['name']));
            $status->save();
            DB::commit();
            return $status;
        } catch (Exception $exception) {
            DB::rollBack();
            return false;
        }

    }

    public function getSingleWith($name)
    {
        return $this->model->where('name','=',$name)->first();
    }

}
