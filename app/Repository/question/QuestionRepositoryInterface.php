<?php


namespace App\Repository\question;


use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface QuestionRepositoryInterface
{
    public function __construct(Model $model,StatusRepositoryInterface $statusRepository);
}
