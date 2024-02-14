<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'success',
        'ip_address',
        'token_id',
        'request',
        'response'
    ];

    protected $casts = [
        'success' => 'bool',
        'request' => 'collection',
        'response' => 'collection'
    ];

    public $timestamps = false;
}
