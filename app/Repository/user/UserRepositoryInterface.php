<?php


namespace App\Repository\user;


use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function __construct(Model $model);
}
