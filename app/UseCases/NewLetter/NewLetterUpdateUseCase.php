<?php

declare(strict_types=1);

namespace App\UseCases\NewLetter;

use App\Repositories\Eloquent\NewLetterEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class NewLetterUpdateUseCase
{
    protected $repository;

    public function __construct(NewLetterEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $input, string $id) : Model
    {
        return $this->repository->update($input, $id);
    }
}
