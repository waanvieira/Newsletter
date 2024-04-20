<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Tests\Traits\TestModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

//Testes unitarios
class UserTest extends TestCase
{
    use TestModels;

    private $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new User();
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
            'email',
            'password',
            'is_admin'

        ];
    }

    public function casts(): array
    {
        return [
            'id' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean'

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
            HasApiTokens::class,
            HasFactory::class,
            Notifiable::class,
            \App\Traits\UuidTrait::class,
        ];
    }
}
