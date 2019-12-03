<?php

namespace Tests\Unit;

use App\Models\Admin\Operacao;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OperacaoTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testeCadastro()
    {
        $request = [
            'nome' => "Teste caixa branca",
            'descricao' => "Teste de caixa branca",
            'equipe_id' => 1
        ];
        $operacao = Operacao::make($request);

        $this->assertTrue($operacao->save());
    }
}
