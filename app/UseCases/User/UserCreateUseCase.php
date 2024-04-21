<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\Exceptions\BadRequestException;
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

        $varifyEmail = $this->repository->findByEmail($input->email);
        if ($varifyEmail) {
            throw new BadRequestException('E-mail cadastrado , não é possível cadastrar E-mail já cadastrado');
        }

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
