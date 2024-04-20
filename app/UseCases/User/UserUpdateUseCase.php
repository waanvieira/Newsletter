<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\UseCases\DTO\User\UserUpdateInputDto;
use App\UseCases\DTO\User\UserUpdateOutputDto;

class UserUpdateUseCase
{
    protected $repository;

    public function __construct(UserEntityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserUpdateInputDto $input) : UserUpdateOutputDto
    {
        $userEntity = new UserEntity($input->id, $input->name, $input->email, '');
        $userDb = $this->repository->findById($userEntity->id);
        $userEntity->update($input->name, $input->email);
        $userDb = $this->repository->update($userEntity);
        return new UserUpdateOutputDto(
            id: $userDb->id,
            name: $userDb->name,
            email: $userDb->email,
            isAdmin: false,
            createdAt: $userDb->createdAt
        );

        // dispatch email by event
    }

}
