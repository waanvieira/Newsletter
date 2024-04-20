<?php

declare(strict_types=1);

namespace App\UseCases\Message;

use App\Domain\Repositories\MessageEntityRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class MessageCreateUseCase
{
    protected $repository;

    public function __construct(
        MessageEntityRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function execute(array $input): Model
    {
        return $this->repository->insert($input);
        // Event disparar emails para RabbitMQ
    }
}
