<?php

declare(strict_types=1);

namespace App\UseCases\NewLetter;

use App\Repositories\Eloquent\NewLetterEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class NewLetterCreateUseCase
{
    protected $repository;

    public function __construct(NewLetterEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $input) : Model
    {
        return $this->repository->insert($input);
    }

}
