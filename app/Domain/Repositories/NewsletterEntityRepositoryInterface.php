<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UserEntity;
use Illuminate\Database\Eloquent\Model;

interface UserEntityRepositoryInterface
{
    public function insert(UserEntity $UserEntity): Model;

    public function findById(string $UserEntityId): Model;

    public function getAllPaginate(string $filter = '', $order = 'DESC');

    public function getAll(string $filter = '', $order = 'DESC'): array;

    public function update(UserEntity $UserEntity): UserEntity;

    public function delete(string $UserEntityId): bool;
}
