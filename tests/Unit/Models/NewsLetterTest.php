<?php

namespace Tests\Unit\Models;

use App\Models\NewsLetter;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Tests\Traits\TestModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

//Testes unitarios
class NewsLetterTest extends TestCase
{
    use TestModels;

    private $model;

    /**
     *
     * @group Pessoa
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new NewsLetter();
    }

    public function model(): Model
    {
        return $this->model;
    }

    public function filleableAtributes(): array
    {
        return [
            'id',
            'name',
            'description',
        ];
    }

    public function casts(): array
    {
        return [
            'id' => 'string',
            'name' => 'string',
            'description' => 'string',
            'created_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }



    public function primaryKeyName(): string
    {
        return 'id';
    }

    public function constantes(): array
    {
        return [
            // 0 => B004Pessoa::BLOQUEADO,
            // 1 => B004Pessoa::DESBLOQUEADO,
            // 1 => B004Pessoa::APROVADO,
            // 0 => B004Pessoa::NAO_APROVADO,
            // 1 => B004Pessoa::DIARIO,
            // 2 => B004Pessoa::SEMANAL,
            // 3 => B004Pessoa::QUINZENAL,
            // 4 => B004Pessoa::MENSAL,
        ];
    }

    public function relations(): array
    {
        $this->assertTrue(true);
        return [
        ];
    }

    public function traitsNeed() : array
    {
        return [
            // \App\Traits\UuidTrait::class,
            SoftDeletes::class,
            HasFactory::class
        ];
    }
}
