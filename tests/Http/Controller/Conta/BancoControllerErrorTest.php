<?php

use Illuminate\Support\Facades\Lang;
use Tests\TestCase;

class BancoControllerErrorTest extends TestCase
{
    public function test_obrigatorio()
    {
        $response = $this->json('POST', 'bancos', []);

        $response->seeJson([
            Lang::get('validation.required', ['attribute' => 'nome'])
        ]);

        $response->seeJson([
            Lang::get('validation.required', ['attribute' => 'cnpj'])
        ]);

        $response->seeJson([
            Lang::get('validation.required', ['attribute' => 'codigo'])
        ]);

        $response->seeJson([
            Lang::get('validation.required', ['attribute' => 'agencia'])
        ]);

        $response->seeJson([
            Lang::get('validation.required', ['attribute' => 'conta'])
        ]);

        $response->seeJson([
            Lang::get('validation.required', ['attribute' => 'carteira'])
        ]);
    }

    public function test_boleano()
    {
        $response = $this->json('POST', 'bancos', [
            'principal' => 'a',
            'conciliacao' => 'a',
            'repasse' => 'a',
        ]);

        $response->seeJson([
            Lang::get('validation.boolean', ['attribute' => 'principal'])
        ]);

        $response->seeJson([
            Lang::get('validation.boolean', ['attribute' => 'conciliacao'])
        ]);

        $response->seeJson([
            Lang::get('validation.boolean', ['attribute' => 'repasse'])
        ]);
    }

    public function test_min()
    {
        $response = $this->json('POST', 'bancos', [
            'nome' => 'a',
            'cnpj' => 'a',
            'codigo' => 'a',
            'agencia' => 'a',
            'conta' => 'a',
            'carteira' => 'a',
        ]);

        $response->seeJson([
            Lang::get('validation.min.string', ['attribute' => 'nome', 'min' => 3])
        ]);

        $response->seeJson([
            Lang::get('validation.min.string', ['attribute' => 'cnpj', 'min' => 14])
        ]);

        $response->seeJson([
            Lang::get('validation.min.string', ['attribute' => 'codigo', 'min' => 3])
        ]);

        $response->seeJson([
            Lang::get('validation.min.string', ['attribute' => 'agencia', 'min' => 4])
        ]);

        $response->seeJson([
            Lang::get('validation.min.string', ['attribute' => 'conta', 'min' => 4])
        ]);

        $response->seeJson([
            Lang::get('validation.min.string', ['attribute' => 'carteira', 'min' => 2])
        ]);
    }

    public function test_boolean()
    {
        $response = $this->json('POST', 'bancos', [
            'conciliacao' => '123',
            'repasse' => '123',
        ]);

        $response->seeJson([
            Lang::get('validation.boolean', ['attribute' => 'conciliacao'])
        ]);

        $response->seeJson([
            Lang::get('validation.boolean', ['attribute' => 'repasse'])
        ]);
    }

    public function test_max()
    {
        $response = $this->json('POST', 'bancos', [
            'nome' => str_repeat('a', 500),
            'cnpj' => str_repeat('a', 500),
            'codigo' => str_repeat('a', 500),
            'agencia' => str_repeat('a', 500),
            'conta' => str_repeat('a', 500),
            'carteira' => str_repeat('a', 500),
        ]);

        $response->seeJson([
            Lang::get('validation.max.string', ['attribute' => 'nome', 'max' => 150])
        ]);

        $response->seeJson([
            Lang::get('validation.max.string', ['attribute' => 'cnpj', 'max' => 14])
        ]);

        $response->seeJson([
            Lang::get('validation.max.string', ['attribute' => 'codigo', 'max' => 3])
        ]);

        $response->seeJson([
            Lang::get('validation.max.string', ['attribute' => 'agencia', 'max' => 14])
        ]);

        $response->seeJson([
            Lang::get('validation.max.string', ['attribute' => 'conta', 'max' => 14])
        ]);

        $response->seeJson([
            Lang::get('validation.max.string', ['attribute' => 'carteira', 'max' => 5])
        ]);
    }
}
