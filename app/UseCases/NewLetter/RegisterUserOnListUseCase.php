<?php

declare(strict_types=1);

namespace App\UseCases\NewLetter;

use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\Exceptions\BadRequestException;
use App\Repositories\Eloquent\NewLetterEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class RegisterUserOnListUseCase
{
    protected $repository;
    protected $userRepository;

    public function __construct(
        NewLetterEloquentRepository $repository,
        UserEntityRepositoryInterface $userRepository
        )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function execute(array $input, string $id)
    {
        $user = $this->userRepository->findByEmail($input['email']);
        if (!$user) {
            throw new BadRequestException("Não existe usuário com esse e-mail");
        }
        return $this->repository->registerUserOnList($id, $user->id);
    }
}
