<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class BancoControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_cadastrar()
    {
        $response = $this->json('POST', 'bancos', [
            'nome' => 'teste',
            'cnpj' => '99999999999999',
            'codigo' => '033',
            'agencia' => '1234',
            'conta' => '1234',
            'carteira' => '1234',
            'principal' => 1,
            'conciliacao' => true,
            'repasse' => true,
        ]);

        $response->assertResponseStatus(201);

        $this->seeInDatabase('bancos', [
            'uuid' => $response->response->json('data.uuid'),
            'codigo' => '033',
            'cnpj' => '99999999999999',
            'nome' => 'teste',
            'agencia' => '1234',
            'conta' => '1234',
            'carteira' => '1234',
            'principal' => 1,
            'conciliacao' => 1,
            'repasse' => 1,
        ]);
    }

}
