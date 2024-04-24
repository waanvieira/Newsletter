<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Traits\MethodsMagicsTrait;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;

class NewsLetter
{
    use MethodsMagicsTrait;

    private function __construct(
        protected ?string $id,
        protected string $name,
        protected string $description,
        protected string $createdAt = '',
    ) {
    }

    public static function create(string $name, string $description): self
    {
        $id = Uuid::uuid4()->toString();
        $dateNow = date('Y-m-d H:m:s');
        return new self(
            id: $id,
            name: $name,
            description: $description,
            createdAt: $dateNow
        );
    }

    public static function restore(?string $id, string $name, string $description, string $createdAt = ''): self
    {
        return new self(
            id: $id,
            name: $name,
            description: $description,
            createdAt: $createdAt
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'createdAt' => $this->createdAt,
        ];
    }

    public static function fromArray(
        array $data
    ): self {
        return new self(
            id: $data['id'],
            name: $data['name'],
            description: $data['description'],
            // createdAt: null,
        );
    }

    public function update(string $name, string $description): void
    {
        $this->name = $name;
        $this->description = $description;
    }
}
