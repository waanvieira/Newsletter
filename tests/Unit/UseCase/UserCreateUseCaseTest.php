<?php

namespace Tests\Unit\UseCase;

use App\Domain\Entities\UserEntity;
use App\Domain\Repositories\UserEntityRepositoryInterface;
use App\UseCases\DTO\User\UserCreateInputDto;
use App\UseCases\DTO\User\UserCreateOutputDto;
use App\UseCases\User\UserCreateUseCase;
use Mockery;
use PHPUnit\Framework\TestCase as FrameworkTestCase;
use stdClass;

//Testes unitarios
class UserCreateUseCaseTest extends FrameworkTestCase
{
    public function testCreateNewUser()
    {
        $name = 'usuario teste';
        $email = 'email@dev.com.br';
        $pass = 'email@dev.com.br';
        $modelEntity = Mockery::mock(UserEntity::class, ['', $name, $email, $pass]);
        $repositoyMock = Mockery::mock(stdClass::class, UserEntityRepositoryInterface::class);
        $repositoyMock->shouldReceive('insert')->andReturn($modelEntity);
        $useCase = new UserCreateUseCase($repositoyMock);
        $mockInputDto = Mockery::mock(UserCreateInputDto::class, [$name, $email, $pass]);
        $userResponse =  $useCase->execute($mockInputDto);

        $this->assertInstanceOf(UserCreateOutputDto::class, $userResponse);
        $this->assertNotNull($userResponse->id);
        $this->assertEquals($name, $userResponse->name);
        $this->assertEquals($email, $userResponse->email);
        $this->assertFalse($userResponse->isAdmin);
        Mockery::close();
    }

    public function testCreateNewUserSpie()
    {
        $name = 'usuario teste';
        $email = 'email@dev.com.br';
        $pass = '123456';
        $modelEntity = Mockery::mock(UserEntity::class, ['', $name, $email,$pass]);
        $repositoySpy = Mockery::spy(stdClass::class, UserEntityRepositoryInterface::class);
        $repositoySpy->shouldReceive('insert')->andReturn($modelEntity);
        $useCase = new UserCreateUseCase($repositoySpy);
        $mockInputDto = Mockery::mock(UserCreateInputDto::class, [$name, $email,$pass]);
        $userResponse =  $useCase->execute($mockInputDto);
        $res = $repositoySpy->shouldHaveReceived('insert');
        $this->assertNotNull($res);
        Mockery::close();
    }
}
