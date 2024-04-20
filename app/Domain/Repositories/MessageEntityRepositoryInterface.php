<?php

namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Model;

interface MessageEntityRepositoryInterface
{
    public function insert(array $data): Model;

    public function findById(string $id): Model;

    public function getAllPaginate(string $filter = '', $order = 'DESC');

    public function getAll(string $filter = '', $order = 'DESC'): array;

    public function update(array $data, string $id): Model;

    public function delete(string $id): bool;

    public function getAllByNesLetter(string $id);
}
