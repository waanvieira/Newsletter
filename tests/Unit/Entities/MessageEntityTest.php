<?php

namespace Tests\Unit\Models;

use App\Domain\Entities\Message;
use App\Domain\Entities\NewsLetter;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class MessageEntityTest extends TestCase
{
    private $newsLetterId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->newsLetterId = $this->newsLetterId()->id;
    }

    public function testAttributesCreate()
    {
        $message = Message::create(
            title: 'title',
            message: 'message',
            newsLetterId: $this->newsLetterId
        );

        $this->assertEquals('title', $message->title);
        $this->assertEquals('message', $message->message);
        $this->assertEquals($this->newsLetterId, $message->newsLetterId);
        $this->assertEquals(date('Y-m-d H:m:s'), $message->createdAt);
    }

    public function testAttributesRestore()
    {
        $id = Uuid::uuid4()->toString();
        $message = Message::restore(
            id: $id,
            title: 'title',
            message: 'message',
            newsLetterId: $this->newsLetterId,
            createdAt: ''
        );

        $this->assertEquals('title', $message->title);
        $this->assertEquals('message', $message->message);
        $this->assertEquals($this->newsLetterId, $message->newsLetterId);
        $this->assertNotNull($message->createdAt);
    }

    public function testUpdate()
    {
        $id = Uuid::uuid4()->toString();
        $message = Message::restore(
            id: $id,
            title: 'title',
            message: 'message',
            newsLetterId: $this->newsLetterId,
            createdAt: ''
        );

        $updatedNewsLetterId = $this->newsLetterId()->id;
        $arrayActual = [
            'title' => 'updated',
            'message' => 'devupdated',
            'newsLetterId' => $updatedNewsLetterId
        ];

        $message->update($arrayActual['title'], $arrayActual['message'], $arrayActual['newsLetterId']);
        $this->assertEquals($message->id, $id);
        $this->assertEquals($message->title, $arrayActual['title']);
        $this->assertEquals($message->message, $arrayActual['message']);
        $this->assertEquals($message->newsLetterId, $arrayActual['newsLetterId']);
    }

    public function testFromArray()
    {
        $id = Uuid::uuid4()->toString();
        $arrayGenerate = [
            'id' => $id,
            'title' => 'title',
            'message' =>  'message',
        ];

        $messageFromArray = Message::fromArray($arrayGenerate);
        $this->assertEquals($arrayGenerate['id'], $messageFromArray->id);
        $this->assertEquals($arrayGenerate['title'], $messageFromArray->title);
        $this->assertEquals($arrayGenerate['message'], $messageFromArray->message);
    }

    private function newsLetterId()
    {
        return NewsLetter::create('newsletter test', 'teste teste');
    }
}
