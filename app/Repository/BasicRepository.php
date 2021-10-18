<?php


namespace App\Repository;

use App\Models\CustomStatus;
use Illuminate\Database\Eloquent\Model;
class BasicRepository implements BasicRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll($paginate=false, $numberOfResults = 20, $orderByColumn = 'created_at', $order='desc')
    {
        // TODO: Implement getAll() method.
        $data = $this->model->orderBy($orderByColumn, $order);
        if ($paginate){
            $data = $data->paginate($numberOfResults);
        } else {
            $data = $data->get();
        }
        return $data;
    }
    public function getAllStatus($paginate=false, $numberOfResults = 20, $orderByColumn = 'created_at', $order='desc')
    {
        // TODO: Implement getAll() method.
        $data = $this->model->with('status')->whereHas('status',function ($app){
            $app->where('name','=','active');
        })->orderBy($orderByColumn, $order);
        if ($paginate){
            $data = $data->paginate($numberOfResults);
        } else {
            $data = $data->get();
        }
        return $data;
    }
    public function create(array $data)
    {
        // TODO: Implement create() method.
        $this->model->create($data);
    }
    public function update(array $data)
    {
        // TODO: Implement update() method.
        $this->model->update($data);
    }
    public function delete($id)
    {
        // TODO: Implement delete() method.
        $this->model->find($id)->delete();
    }
    public function getSingle($id)
    {
        // TODO: Implement getSingle() method.
       return $this->model->find($id);

    }

}
