<?php


namespace App\Repository\advisor;


use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface AdvisorRepositoryInterface
{
    public function __construct(Model $model,StatusRepositoryInterface $statusRepository);
}
