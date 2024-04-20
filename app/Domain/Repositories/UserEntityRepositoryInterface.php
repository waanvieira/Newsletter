<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\UserEntity;
use Illuminate\Database\Eloquent\Model;

interface UserEntityRepositoryInterface
{
    public function insert(UserEntity $UserEntity): UserEntity;

    public function findById(string $UserEntityId): UserEntity;

    public function getIdsListIds(array $UserEntitysIds = []): array;

    public function getAllPaginate(string $filter = '', $order = 'DESC');

    public function getAll(string $filter = '', $order = 'DESC'): array;

    // public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;

    public function update(UserEntity $UserEntity): UserEntity;

    public function delete(string $UserEntityId): bool;
    public function findByEmail(string $email);
}
