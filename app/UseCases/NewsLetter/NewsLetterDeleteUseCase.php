<?php

// declare(strict_types=1);

namespace App\UseCases\NewsLetter;

use App\Repositories\Eloquent\NewsLetterEloquentRepository;

class NewsLetterDeleteUseCase
{
    protected $repository;

    public function __construct(NewsLetterEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id)
    {
        return $this->repository->delete($id);
    }
}
