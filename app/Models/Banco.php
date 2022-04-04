<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PJBank\Package\Models\Traits\SendQueue;
use PJBank\Package\Models\Traits\UuidGenerate;

class Banco extends Model
{
    use UuidGenerate, SendQueue, HasFactory;

    const BANCO_BPP = '301';

    public $fillable = [
        'codigo',
        'cnpj',
        'nome',
        'agencia',
        'conciliacao',
        'conta',
        'carteira',
        'principal',
        'data',
    ];

    public function data(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
