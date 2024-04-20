<?php

// declare(strict_types=1);

namespace App\UseCases\NewLetter;

use App\Repositories\Eloquent\NewLetterEloquentRepository;

class NewLetterDeleteUseCase
{
    protected $repository;

    public function __construct(NewLetterEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id)
    {
        return $this->repository->delete($id);
    }
}
