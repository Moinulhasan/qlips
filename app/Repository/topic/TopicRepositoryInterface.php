<?php


namespace App\Repository\topic;


use App\Models\CustomStatus;
use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface TopicRepositoryInterface
{

    public function __construct(Model $model,StatusRepositoryInterface $statusRepository);
}
