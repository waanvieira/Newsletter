<?php

declare(strict_types=1);

namespace App\UseCases\NewLetter;

use App\Exceptions\BadRequestException;
use App\Repositories\Eloquent\NewLetterEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class NewLetterCreateUseCase
{
    protected $repository;
    protected $userEloquentRepository;

    public function __construct(
        NewLetterEloquentRepository $repository,
        UserEloquentRepository $userEloquentRepository
    ) {
        $this->repository = $repository;
        $this->userEloquentRepository = $userEloquentRepository;
    }

    public function execute(array $input): Model
    {
        $user = $this->userEloquentRepository->findByEmail($input['email']?? '');

        if (!$user || !$user->is_admin) {
            throw new BadRequestException('Usuário não tem permissão para criar lista');
        }

        return $this->repository->insert($input);
    }
}
