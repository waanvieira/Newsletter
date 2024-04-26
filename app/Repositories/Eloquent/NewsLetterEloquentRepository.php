<?php

namespace App\Repositories\Eloquent;

use App\Domain\Entities\NewsLetter as EntitiesNewsLetter;
use App\Domain\Repositories\NewsletterEntityRepositoryInterface;
use App\Models\NewsLetter;
use Illuminate\Database\Eloquent\Model;

class NewsLetterEloquentRepository implements NewsletterEntityRepositoryInterface
{
    protected $model;

    public function __construct(NewsLetter $model)
    {
        $this->model = $model;
    }

    public function model(): Model
    {
        return $this->model;
    }

    public function insert(EntitiesNewsLetter $newsLetter): EntitiesNewsLetter
    {
        $dataDb = $this->model->create([
            'id' => $newsLetter->id,
            'name' => $newsLetter->name,
            'description' => $newsLetter->description,
            'created_at' => $newsLetter->createdAt,
        ]);

        return $this->convertToEntity($dataDb);
    }

    public function findById(string $NewsLetterId): EntitiesNewsLetter
    {
        $dataDb =  $this->model()->findOrFail($NewsLetterId);
        return $this->convertToEntity($dataDb);
    }

    public function getAllPaginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15)
    {
        $query = $this->model;
        if ($filter) {
            $query = $query->where('name', 'LIKE', "%{$filter}%");
        }
        $query = $query->orderBy('name', $order);
        $dataDb = $query->paginate($totalPage);

        return $dataDb;
    }

    public function getAll(string $filter = '', $order = 'DESC'): array
    {
        return [];
    }

    public function update(EntitiesNewsLetter $newsLetter): EntitiesNewsLetter
    {
        $newsLetterDb = $this->model->findOrFail($newsLetter->id);
        $newsLetterDb->update([
            'name' => $newsLetterDb->name,
            'description' => $newsLetterDb->description,
        ]);
        $newsLetterDb->refresh();
        return $this->convertToEntity($newsLetterDb);
    }

    public function delete(string $NewsLetterId): bool
    {
        $newsLetterDb = $this->model->findOrFail($NewsLetterId);
        return $newsLetterDb->delete();
    }

    public function registerUserOnList(string $newsLetterId, string $idUser) : void
    {
        $newsletter = $this->model->find($newsLetterId);

        if (!$newsletter->users->where('id', $idUser)->first()) {
            $newsletter->users()->attach($idUser);
        }
    }

    private function convertToEntity(NewsLetter $model): EntitiesNewsLetter
    {
        return EntitiesNewsLetter::restore(
            id: $model->id,
            name: $model->name,
            description: $model->description,
            createdAt: $model->created_at
        );
    }
}
