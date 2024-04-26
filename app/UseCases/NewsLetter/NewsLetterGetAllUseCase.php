<?php

declare(strict_types=1);

namespace App\UseCases\NewsLetter;

use App\Models\NewsLetter;
use App\Repositories\Eloquent\NewsLetterEloquentRepository;

class NewsLetterGetAllUseCase
{
    protected $repository;

    public function __construct(NewsLetterEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $input)
    {
        return $this->repository->getAllPaginate();
    }
}
