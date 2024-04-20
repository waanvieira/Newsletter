<?php

namespace App\Domain\Entities;

declare(strict_types=1);

namespace App\Domain\User;

use App\Traits\MethodsMagicsTrait;
use DateTimeImmutable;

class NewsLetter
{
    use MethodsMagicsTrait;

    // public readonly string $prop;
    public function __construct(
        protected ?string $id = '',
        protected string $name = '',
        protected string $mensagem  = '',
    ) {
        if (!$this->id) {
            $this->id = Uuid::uuid4()->toString();
            // $this->isAdmin = false;
        }
    }

    public static function create(?int $id, string $name, string $email, $password): self
    {
        return new self(
            id: $id,
            name: $name,
            email: $email,
            password: $password,
            createdAt: new DateTimeImmutable('2023-09-09 00:15:00'),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public static function fromArray(
        array $data
    ): self {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            password: null,
            createdAt: null,
        );
    }

    public function update(string $name, string $mensagem) : void
    {
        $this->name = $name;
        $this->mensagem = $mensagem;
    }
}
