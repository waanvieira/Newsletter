<?php

namespace App\Repositories\Eloquent;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserEloquentRepository implements UserEntityRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function insert(UserEntity $user): UserEntity
    {
        $dataDb = $this->model->create([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            // 'created_at' => $user->createdAt,
        ]);

        return $this->convertToEntity($dataDb);
    }

    public function findById(string $id): UserEntity
    {
        $dataDb = $this->model->find($id);
        if (!$dataDb) {
            throw new NotFoundException("Register {$id} Not Found");
        }

        return $this->convertToEntity($dataDb);
    }

    public function getIdsListIds(array $UsersIds = []): array
    {
        return $this->model
            ->whereIn('id', $UsersIds)
            ->pluck('id')
            ->toArray();
    }

    public function getAllPaginate(string $filter = '', $order = 'DESC')
    {
        $dataDb = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('name', 'LIKE', "%{$filter}%");
                }
            })
            ->orderBy('name', $order)
            ->paginate(20);

        return $dataDb;
    }

    public function getAll(string $filter = '', $order = 'DESC'): array
    {
        $dataDb = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('name', 'LIKE', "%{$filter}%");
                }
            })
            ->orderBy('name', $order)
            ->get();

        return $dataDb->toArray();
    }

    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15)
    {
        $query = $this->model;
        if ($filter) {
            $query = $query->where('name', 'LIKE', "%{$filter}%");
        }
        $query = $query->orderBy('name', $order);
        $dataDb = $query->paginate($totalPage);

        return $dataDb;
    }

    public function update(UserEntity $user): UserEntity
    {
        $dataDb = $this->findByIdEloquent($user->id);
        $dataDb->update([
            'name' => $user->name,
            'email' => $user->email
        ]);

        $dataDb->refresh();
        return $this->convertToEntity($dataDb);
    }

    public function delete(string $UserId): bool
    {
        $dataDb = $this->findByIdEloquent($UserId);
        return $dataDb->delete();
    }

    private function findByIdEloquent(string $id)
    {
        return $this->model->findOrFail($id);
    }

    private function convertToEntity(User $model): UserEntity
    {
        return new UserEntity(
            id: $model->id,
            name: $model->name,
            password: $model->password,
            email: $model->email,
            isAdmin: false,
            createdAt: $model->created_at
        );
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}
