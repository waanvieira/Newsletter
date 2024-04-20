<?php

namespace App\Repositories\Eloquent;

use App\Domain\Repositories\MessageEntityRepositoryInterface;
use App\Exceptions\NotFoundException;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;

class MessageEloquentRepository extends AbstractBaseCrudRepository implements MessageEntityRepositoryInterface
{
    protected $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }

    public function model(): Model
    {
        return $this->model;
    }

    public function getAll(string $filter = '', $order = 'DESC'): array
    {
        $dataDb = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('title', 'LIKE', "%{$filter}%");
                }
            })
            ->orderBy('title', $order)
            ->get();

        return $dataDb->toArray();
    }

    public function getAllPaginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15)
    {
        $query = $this->model;
        if ($filter) {
            $query = $query->where('title', 'LIKE', "%{$filter}%");
        }
        $query = $query->orderBy('title', $order);
        $dataDb = $query->paginate($totalPage);

        return $dataDb;
    }

    public function getAllByNesLetter(string $id)
    {
        $reseponse = $this->model->where('newsletter_id', $id)->get();
        if (!$reseponse) {
            throw new NotFoundException('Nenhuma mensagem encontrada para essa lista');
        }

        return $reseponse;
    }
}
