<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\UseCases\DTO\User\UserCreateInputDto;
use App\UseCases\DTO\User\UserCreateOutputDto;

class UserFindByIdUseCase
{
    protected $repository;

    public function __construct(UserEntityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserCreateInputDto $input): UserCreateOutputDto
    {
        $user = $this->repository->findById($input->id);
        return new UserCreateOutputDto(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            isAdmin: false,
            createdAt: $user->createdAt
        );

        // dispatch email by event
    }
}
