<?php

declare(strict_types=1);

namespace App\UseCases\Message;

use App\Domain\Repositories\MessageEntityRepositoryInterface;
use App\Listeners\EmailMessageCreated;
use Illuminate\Database\Eloquent\Model;

class MessageCreateUseCase
{
    protected $repository;
    protected $rabbitInterface;

    public function __construct(
        MessageEntityRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function execute(array $input): Model
    {
        $message  = $this->repository->insert($input);
        // Event disparar emails para RabbitMQ
        Event(new EmailMessageCreated($message));
        return $message;
    }
}
