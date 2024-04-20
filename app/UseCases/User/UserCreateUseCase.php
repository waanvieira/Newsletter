<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\UseCases\DTO\User\UserCreateInputDto;
use App\UseCases\DTO\User\UserCreateOutputDto;

class UserCreateUseCase
{
    protected $repository;

    public function __construct(UserEntityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserCreateInputDto $input) : UserCreateOutputDto
    {
        $userEntity = new UserEntity(
            '',
            name: $input->name,
            email:$input->email,
            password: $input->password
        );

        $user = $this->repository->insert($userEntity);

        return new UserCreateOutputDto(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            isAdmin: $user->isAdmin,
            createdAt: $user->createdAt
        );

        // dispatch email by event
    }

}
