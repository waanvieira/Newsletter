<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Tests\Traits\TestResources;
use Tests\Traits\TestSaves;
use Tests\Traits\TestValidations;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;
    use TestValidations;
    use TestSaves;
    use TestResources;
    // use WithOutMiddleware;

    private $user;
    private $controller;
    private $moduloPagamentoMock;
    private $paymentMock;
    private $cartaoMock;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->withoutMiddleware([
        //     JWTAuthenticateAccess::class
        // ]);

        $this->controller = $this->controller();
        // $this->user = User::factory()->create();
        // $this->user->id = Uuid::uuid4()->toString();
        $fakeUser = User::factory()->create([
            'id' => Uuid::uuid4()->toString(),
            'name' => fake()->name(),
            'email' => 'teste@dev.com.br',
            'email_verified_at' => now(),
            'password' => '1234',
        ]);

        $this->user = $this->model()::where('email', $fakeUser->email)->first();

        // dd($this->user);
        // C009LancamentoAdiantamento::factory()->create();
        // $lancamento = C009LancamentoParcela::factory()->create();
        // $caixa = C037FechamentoCaixa::factory()->create();
        // C009Boleto::factory()->create([
        //     'ChaveRef2' => $caixa->user,
        //     'ValDoc' => $lancamento->Valor
        // ]);

        // C009LancamentoAdiantamento::factory()->create([
        //     'user' => $caixa->user
        // ]);
    }

    private $serializedFields = [
        'id',
        'name',
        'email',
        'created_at',
        'updated_at'
    ];

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testGetAll()
    {
        $response = $this->get(route('user.index'));
        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => $this->serializedFields
                    ],
                    'links' => [],
                ]
            );
    }

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testShow()
    {
        $response = $this->get(route('user.show', ['user' => $this->user->id]));
        $response
            ->assertStatus(200);
        // ->assertJsonStructure([
        //     'data' => $this->serializedFields
        // ]);
    }

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testAssertInvalidationStore()
    {
        $data = [
            'name'     => null,
            'email'    => null,
            'password' => null,
        ];

        $this->assertInvalidationInStoreAction($data, 'required', [], $this->routeStore());
    }

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testAssertInvalidationUpdate()
    {
        $data = [
            'name'     => null,
            'email'    => null,
        ];

        $this->assertInvalidationInUpdateAction($data, 'required', [], $this->routeUpdate());
    }

    public function testHandleRelation()
    {
        $this->assertTrue(true);
    }

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testStore()
    {
        $data = [
            'name' => 'teste',
            'email' => 'testeend@dev.com.br',
            'password' => '123',
        ];

        $response = $this->assertStore($data, $data, [], route('user.store'));
        $response
            ->assertStatus(201);
        // ->assertJsonStructure([
        //     'data' => $this->serializedFields
        // ]);
    }

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testUpdate()
    {
        $data = [
            'name' => 'updated',
            'email' => 'updatedev.com.br',
        ];

        $response = $this->assertUpdate($data, $data);
        $response->assertStatus(Response::HTTP_OK);
        // dd($response->assertStatus());
        // $response->assertJsonStructure([
        //     'data' => $this->serializedFields
        // ]);
    }

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->json('DELETE', route('user.destroy', ['user' => $this->user->id]));
        $response->assertStatus(204);
        $userExcluded = $this->model()::where('id', $this->user->id)->first();
        $this->assertNull($userExcluded);
    }


    public function routeStore()
    {
        return route('user.store');
    }

    public function routeUpdate()
    {
        return route('user.update', ['user' => $this->user->id]);
    }

    public function model()
    {
        return User::class;
    }

    public function controller()
    {
        return new UserController();
    }
}
