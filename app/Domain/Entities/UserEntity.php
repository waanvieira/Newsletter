<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Traits\MethodsMagicsTrait;
use Ramsey\Uuid\Uuid;

// use DateTimeImmutable;

class UserEntity
{
    use MethodsMagicsTrait;

    // public readonly string $prop;
    public function __construct(
        protected ?string $id = '',
        protected string $name = '',
        protected string $email  = '',
        protected string $password,
        protected bool $isAdmin = false,
        protected string $createdAt = ''

    ) {
        if (!$this->id) {
            $this->id = Uuid::uuid4()->toString();
            // $this->isAdmin = false;
        }
    }

    // public static function create(?int $id, string $name, string $email, $password): self
    // {
    //     return new self(
    //         id: $id,
    //         name: $name,
    //         email: $email,
    //         password: $password,
    //         createdAt: new DateTimeImmutable('2023-09-09 00:15:00'),
    //     );
    // }

    // public static function fromArray(
    //     array $data
    // ): self {
    //     return new self(
    //         id: $data['id'],
    //         name: $data['name'],
    //         email: $data['email'],
    //         password: null,
    //         createdAt:null,
    //     );
    // }

    public function activeAdmin() : void
    {
        $this->isAdmin = true;
    }

    public function update(string $name, string $email) : void
    {
        $this->name = $name;
        $this->email = $email;
    }
}
