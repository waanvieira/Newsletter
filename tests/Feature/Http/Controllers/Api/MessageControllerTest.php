<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Controllers\Api\MessageController;
use App\Models\Message;
use App\Models\NewsLetter;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\Traits\TestResources;
use Tests\Traits\TestSaves;
use Tests\Traits\TestValidations;

use function PHPUnit\Framework\assertEquals;

class MessageControllerTest extends TestCase
{
    use DatabaseTransactions;
    use TestValidations;
    use TestSaves;
    use TestResources;
    // use WithOutMiddleware;

    private $newletter;
    private $controller;
    private $moduloPagamentoMock;
    private $message;
    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->withoutMiddleware([
        //     JWTAuthenticateAccess::class
        // ]);
        $this->controller = $this->controller();
        $user = User::factory()->create();
        $this->user = User::where('email', $user->email)->first();
        NewsLetter::factory()->create();
        $this->newletter = NewsLetter::orderBy('id', 'DESC')->first();
        Message::factory()->create();
        $this->message = $this->model()::orderBy('id', 'DESC')->first();
    }

    private $serializedFields = [
        'id',
        // 'creator_id',
        'newletter_id',
        'title',
        'message',
        'created_at',
        'updated_at'
    ];


    public function testGetAll()
    {
        $response = $this->get(route('message.index'));
        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => $this->serializedFields
                    ],
                    'links' => [],
                    // 'meta' => [],
                ]
            );
    }


    public function testShow()
    {
        $response = $this->get(route('message.show', ['message' => $this->message->id]));
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => $this->serializedFields
            ]);
    }


    public function testAssertInvalidationStore()
    {
        $data = [
            // 'creator_id' => null,
            'newletter_id' => null,
            'title' => null,
            'message' => null,
        ];

        $this->assertInvalidationInStoreAction($data, 'required', [], $this->routeStore());
    }

    public function testAssertInvalidationUpdate()
    {
        $data = [
            // 'creator_id' => null,
            'newletter_id' => null,
            'title' => null,
            'message' => null,
        ];

        $this->assertInvalidationInUpdateAction($data, 'required', [], $this->routeUpdate());
    }

    public function testHandleRelation()
    {
        $this->assertTrue(true);
    }

    public function testStore()
    {
        $data = [
            // 'creator_id' => $this->user->id,
            'newletter_id' => $this->newletter->id,
            'title' => 'titulo teste',
            'message' => 'mensgem teste para enviar email',
        ];

        $response = $this->assertStore($data, $data, [], route('message.store'));
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => $this->serializedFields
            ]);
    }


    public function testUpdate()
    {
        $data = [
            'creator_id' => $this->user->id,
            'newletter_id' => $this->newletter->id,
            'title' => 'titulo teste',
            'message' => 'mensgem teste para enviar email',
        ];

        $response = $this->assertUpdate($data, $data);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => $this->serializedFields
        ]);
    }

    public function testDestroy()
    {
        $response = $this->json('DELETE', route('message.destroy', ['message' => $this->message->id]));
        $response->assertStatus(204);
        $userExcluded = $this->model()::where('id', $this->message->id)->first();
        $this->assertNull($userExcluded);
    }

    public function routeStore()
    {
        return route('message.store');
    }

    public function routeUpdate()
    {
        return route('message.update', ['message' => $this->message->id]);
    }

    protected function assertHasUser($userId, $nesLetterId)
    {
        $this->assertDatabaseHas('newletter_user', [
            'user_id' => $userId,
            'newletter_id' => $nesLetterId
        ]);
    }


    public function model()
    {
        return Message::class;
    }

    public function controller()
    {
        return new MessageController();
    }
}
