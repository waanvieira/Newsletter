<?php

namespace Tests\Unit\Models;

use App\Domain\Entities\UserEntity;
use Tests\TestCase;

class UserEntityTest extends TestCase
{

    public function testAttributes()
    {
        $user = new UserEntity(
            '',
            name: 'name',
            email: 'email@dev.com',
            password: '1234'
        );

        $this->assertEquals('name', $user->name);
        $this->assertEquals('email@dev.com', $user->email);
        $this->assertEquals(false, $user->isAdmin);
    }

    public function testUpdateName()
    {
        $user = new UserEntity(
            '',
            name: 'name',
            email: 'email@dev.com',
            password: '1234'
        );

        $arrayActual = [
            'name' => 'updated',
            'email' => 'devupdated@dev.com.br'
        ];

        $user->update($arrayActual['name'], $arrayActual['email']);
        $this->assertEquals($user->name, $arrayActual['name']);
        $this->assertEquals($user->email, $arrayActual['email']);
    }
}
