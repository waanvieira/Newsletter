<?php

declare(strict_types=1);

namespace App\UseCases\NewLetter;

use App\Models\NewsLetter;
use App\Repositories\Eloquent\NewLetterEloquentRepository;

class NewLetterGetAllUseCase
{
    protected $repository;

    public function __construct(NewLetterEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $input)
    {
        return $this->repository->getAllPaginate();
    }
}
