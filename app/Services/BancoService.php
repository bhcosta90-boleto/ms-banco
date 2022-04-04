<?php

namespace App\Services;

use App\Models\Banco;

final class BancoService
{

    use Traits\ValidateTrait;

    public function __construct(private Banco $repository)
    {
        //
    }

    public function cadastrarNovoBanco(array $data)
    {
        $rules = $ruleDefault = [
            'codigo' => 'required|min:3|max:3',
            'nome' => 'required|min:3|max:150',
            'cnpj' => 'required|min:14|max:14',
            'agencia' => 'required|min:4|max:14',
            'conta' => 'required|min:4|max:14',
            'principal' => 'nullable|boolean',
            'carteira' => 'required|min:2|max:5',
            'conciliacao' => 'nullable|boolean',
            'repasse' => 'nullable|boolean',
        ];

        $codigoBanco = $data['codigo'] ?? '0';

        match((string) $codigoBanco) {
            Banco::BANCO_BPP => $rules += ['conta_bancaria' => 'required'],
            default => []
        };

        $data = $this->validate($data, $rules);

        $dataData = $data;
        foreach(array_keys($ruleDefault) as $rs) {
            unset($dataData[$rs]);
        }

        $obj = $this->repository->fill($data);
        $obj->data = $dataData;
        $obj->save();
        return $obj;
    }
}
