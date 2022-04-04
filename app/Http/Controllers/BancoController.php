<?php

namespace App\Http\Controllers;

use App\Http\Resources\BancoResource;
use App\Services\BancoService;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    public function store(BancoService $contaService, Request $request)
    {
        $ret = $contaService->cadastrarNovoBanco($request->all());

        return response()->json([
            'data' => new BancoResource($ret)
        ], 201);
    }
}
