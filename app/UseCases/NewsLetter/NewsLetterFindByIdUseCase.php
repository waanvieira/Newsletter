<?php

// declare(strict_types=1);

namespace App\UseCases\NewsLetter;

use App\Repositories\Eloquent\NewsLetterEloquentRepository;

class NewsLetterFindByIdUseCase
{
    protected $repository;

    public function __construct(NewsLetterEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id)
    {
        return $this->repository->findById($id);
    }
}
