<?php

namespace Tests\Unit\Models;

use App\Domain\Entities\NewsLetter;
use App\Domain\ValueObjects\Uuid as ValueObjectsUuid;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class NewsLetterEntityTest extends TestCase
{
    public function testAttributesCreate()
    {
        $newsletter = NewsLetter::create(
            name: 'name',
            description: 'description'
        );

        $this->assertEquals('name', $newsletter->name);
        $this->assertEquals('description', $newsletter->description);
        $this->assertEquals(date('Y-m-d H:i:s'), $newsletter->createdAt);
    }

    public function testAttributesRestore()
    {
        $id = ValueObjectsUuid::random();
        $newsletter = NewsLetter::restore(
            id: $id,
            name: 'name',
            description: 'description',
            createdAt: ''
        );

        $this->assertEquals('name', $newsletter->name);
        $this->assertEquals('description', $newsletter->description);
        $this->assertNotNull($newsletter->createdAt);
    }

    public function testUpdateName()
    {
        $id = ValueObjectsUuid::random();
        $newsletter = NewsLetter::restore(
            id: $id,
            name: 'name',
            description: 'description',
            createdAt: ''
        );

        $arrayActual = [
            'name' => 'updated',
            'description' => 'devupdated'
        ];

        $newsletter->update($arrayActual['name'], $arrayActual['description']);
        $this->assertEquals($newsletter->id, $id);
        $this->assertEquals($newsletter->name, $arrayActual['name']);
        $this->assertEquals($newsletter->description, $arrayActual['description']);
    }

    public function testFromArray()
    {
        $id = ValueObjectsUuid::random();
        $arrayGenerate = [
            'id' => $id,
            'name' => 'name',
            'description' =>  'description',
        ];

        $newsletterFromArray = NewsLetter::fromArray($arrayGenerate);
        $this->assertEquals($arrayGenerate['id'], $newsletterFromArray->id);
        $this->assertEquals($arrayGenerate['name'], $newsletterFromArray->name);
        $this->assertEquals($arrayGenerate['description'], $newsletterFromArray->description);
    }
}
