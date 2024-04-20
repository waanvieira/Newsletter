<?php

namespace App\Repositories\Eloquent;

use App\Models\NewsLetter;
use Illuminate\Database\Eloquent\Model;

class NewLetterEloquentRepository extends AbstractBaseCrudRepository
{
    protected $model;

    public function __construct(NewsLetter $model)
    {
        $this->model = $model;
    }

    public function model() : Model
    {
        return $this->model;
    }
}
