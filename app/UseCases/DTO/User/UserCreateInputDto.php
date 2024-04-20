<?php

namespace App\UseCases\DTO\User;

class UserCreateInputDto
{
    public function __construct(
        public string $id = '',
        public string $name,
        public string $email,
        public string $password = '',
        public bool $isAdmin = false,
        public string $createdAt = ''
    )
    {

    }
}
