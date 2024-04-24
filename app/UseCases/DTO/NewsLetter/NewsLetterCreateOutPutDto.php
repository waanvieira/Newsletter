<?php

namespace App\UseCases\DTO\NewsLetter;

class NewsLetterCreateOutPutDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $createdAt
    )
    {

    }
}
