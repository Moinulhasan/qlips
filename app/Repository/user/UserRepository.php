<?php


namespace App\Repository\user;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserRepository extends \App\Repository\BasicRepository implements UserRepositoryInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function register($data)
    {
        // check user already exits
        try {
            $user = $this->model->where('email','=',$data['email'])
                                ->first();
            if ($user)
            {
                $user['bearer_token'] = 'Bearer '.$this->createToken($user);
                return $user;
            }else{
              DB::beginTransaction();
                try {
                    $store = new $this->model;
                    $store->name = $data['name'];
                    $store->email = $data['email'];
                    $store->uid = $data['uid'];
                    $store->avatar = $data['profile_url'];
                    if (isset($data['password']))
                    {
                        $data->password = Hash::make($data['password']);
                    }
                    $store->save();
                    $store['bearer_token'] = 'Bearer '.$this->createToken($store);
                    DB::commit();
                    return $store;

                }catch (\Exception $e)
                {
                    DB::rollBack();
                    return false;
                }
            }
        }catch (\Exception $exception)
        {
            return false;
        }
    }

    private function createToken($user)
    {
        return $user->createToken('API Token')->plainTextToken;
    }
}
