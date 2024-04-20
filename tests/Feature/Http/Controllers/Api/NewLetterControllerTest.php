<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Controllers\Api\NewLetterController;
use App\Models\NewsLetter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\Traits\TestResources;
use Tests\Traits\TestSaves;
use Tests\Traits\TestValidations;

class NewLetterControllerTest extends TestCase
{
    use DatabaseTransactions;
    use TestValidations;
    use TestSaves;
    use TestResources;
    // use WithOutMiddleware;

    private $newletter;
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
        $fakeUser = NewsLetter::factory()->create();
        $this->newletter = $this->model()::orderBy('id', 'DESC')->first();
    }

    private $serializedFields = [
        'id',
        'name',
        'description',
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
        $response = $this->get(route('newsletter.index'));
        $response
            ->assertStatus(200)
            // ->assertJson([
            //     // 'message' => 'Registros encontrados com sucesso',
            //     'data' => [
            //         '*' => $this->serializedFields
            //     ],
            //     'per_page' => 20
            // ]);
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

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testShow()
    {
        $response = $this->get(route('newsletter.show', ['newsletter' => $this->newletter->id]));
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
            'name'     => null
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
            'name'     => null
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
            'description' => 'description',
        ];

        $response = $this->assertStore($data, $data, [], route('newsletter.store'));
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
            'description' => 'updated descript',
        ];

        $response = $this->assertUpdate($data, $data);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => $this->serializedFields
        ]);
    }

    /**
     *
     * @group FechamentoCaixa
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->json('DELETE', route('newsletter.destroy', ['newsletter' => $this->newletter->id]));
        $response->assertStatus(204);
        $userExcluded = $this->model()::where('id', $this->newletter->id)->first();
        $this->assertNull($userExcluded);
    }


    public function routeStore()
    {
        return route('newsletter.store');
    }

    public function routeUpdate()
    {
        return route('newsletter.update', ['newsletter' => $this->newletter->id]);
    }

    public function model()
    {
        return NewsLetter::class;
    }

    public function controller()
    {
        return new NewLetterController();
    }
}
