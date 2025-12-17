<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\Assuntos as AssuntoService;

class AssuntosControllerTest extends TestCase
{
    use WithFaker;

    protected $assuntoServiceMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->assuntoServiceMock = Mockery::mock(AssuntoService::class);
        $this->app->instance(AssuntoService::class, $this->assuntoServiceMock);
    }

    /** @test */
    public function testIndexListandoAssuntos()
    {
        $items = [
            (object)['codAs' => '1', 'descricao' => 'Assunto 1'],
            (object)['codAs' => '2', 'descricao' => 'Assunto 2'],
        ];

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            count($items),
            15,
            1,
            ['path' => url('/assuntos')]
        );

        $this->assuntoServiceMock
            ->shouldReceive('get')
            ->withAnyArgs()
            ->once()
            ->andReturn($paginator);

        $response = $this->get(route('assuntos'));

        $response->assertStatus(200);
        $response->assertViewHas('assuntos', function ($assuntos) use ($paginator) {
            return $assuntos instanceof \Illuminate\Pagination\LengthAwarePaginator
                && $assuntos->total() === $paginator->total();
        });
    }

    /** @test */
    public function testCarregarFormularioNovoAssunto()
    {
        $response = $this->get(route('novoassunto'));

        $response->assertStatus(200);
        $response->assertViewIs('assuntos.novoassunto');
        $response->assertViewHas('assunto', null);
    }

    /** @test */
    public function testSalvarNovoAssunto()
    {
        $dados = ['descricao' => 'Novo Assunto'];

        $this->assuntoServiceMock
            ->shouldReceive('save')
            ->once()
            ->with($dados);

        $response = $this->post(route('novoassunto'), $dados);

        $response->assertRedirect(route('assuntos'));
        $response->assertSessionHas('success', 'Assunto salvo com sucesso!');
    }

    /** @test */
    public function testEditarAssuntoExistente()
    {
        $assunto = ['id' => 1, 'descricao' => 'Teste'];

        $this->assuntoServiceMock
            ->shouldReceive('getById')
            ->with(1)
            ->once()
            ->andReturn($assunto);

        $response = $this->get(route('novoassunto', ['codAs' => 1]));

        $response->assertStatus(200);
        $response->assertViewHas('assunto', $assunto);
    }

    /** @test */
    public function testSalvarAssuntoComErro()
    {
        $response = $this->post(route('novoassunto'), [
            'descricao' => '',
        ]);

        $response->assertStatus(302);
    }

    /** @test */
    public function testExcluirAssunto()
    {
        $this->assuntoServiceMock
            ->shouldReceive('delete')
            ->once()
            ->with(1);

        $response = $this->delete(route('deletarassunto', ['codAs' => 1]));

        $response->assertRedirect(route('assuntos'));
        $response->assertSessionHas('success', 'Assunto excluído com sucesso!');
    }

    /** @test */
    public function testExcluirAssuntoInexistente()
    {
        $this->assuntoServiceMock
            ->shouldReceive('delete')
            ->once()
            ->with(999)
            ->andThrow(new \Exception('Não encontrado'));

        $response = $this->delete(route('deletarassunto', ['codAs' => 999]));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Não foi possível realizar a exclusão: Não encontrado');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
