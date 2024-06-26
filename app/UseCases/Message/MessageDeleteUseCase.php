<?php

// declare(strict_types=1);

namespace App\UseCases\Message;

use App\Domain\Repositories\MessageEntityRepositoryInterface;

class MessageDeleteUseCase
{
    protected $repository;

    public function __construct(MessageEntityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id)
    {
        return $this->repository->delete($id);
    }
}
