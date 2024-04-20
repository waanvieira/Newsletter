<?php

namespace App\UseCases\DTO\User;

class UserUpdateInputDto
{
    public function __construct(
        public string $id,
        public string $name = '',
        public string $email = '',
        public bool $isAdmin = false,
    )
    {

    }
}
