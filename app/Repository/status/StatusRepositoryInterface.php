<?php


namespace App\Repository\status;


use Illuminate\Database\Eloquent\Model;

interface StatusRepositoryInterface
{

    public function __construct(Model $model);
}
