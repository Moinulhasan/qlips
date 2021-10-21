<?php


namespace App\Repository\clips;


use App\Repository\advisor\AdvisorRepositoryInterface;
use App\Repository\question\QuestionRepositoryInterface;
use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface ClipsRepositoryInterface
{

    public function __construct(Model $model,
                                QuestionRepositoryInterface $questionRepository,
                                AdvisorRepositoryInterface $advisorRepository,
                                StatusRepositoryInterface $statusRepository
    );
}
