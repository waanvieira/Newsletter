<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\UseCases\DTO\User\UserCreateInputDto;
use App\UseCases\DTO\User\UserDeleteInputDto;
use App\UseCases\DTO\User\UserUpdateInputDto;
use App\UseCases\DTO\User\UserUpdateOutputDto;

// use DateTimeImmutable;

class UserDeleteUseCase
{
    protected $repository;

    public function __construct(UserEntityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UserCreateInputDto $input) : bool
    {
        return $this->repository->delete($input->id);
    }
}
