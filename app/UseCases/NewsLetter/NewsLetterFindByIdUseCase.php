<?php

declare(strict_types=1);

namespace App\UseCases\NewsLetter;

use App\Domain\Repositories\NewsletterEntityRepositoryInterface;
use App\UseCases\DTO\NewsLetter\NewsLetterUpdateOutputDto;

class NewsLetterFindByIdUseCase
{
    public function __construct(
        protected NewsletterEntityRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function execute(string $id) : NewsLetterUpdateOutputDto
    {
        $newsLetterDb = $this->repository->findById($id);
        return new NewsLetterUpdateOutputDto(
            id: $newsLetterDb->id,
            name: $newsLetterDb->name,
            description: $newsLetterDb->description,
            created_at: $newsLetterDb->createdAt
        );
    }
}
