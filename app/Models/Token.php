<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'api_token',
        'limit'
    ];
    protected $hidden = ['api_token'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tokenStatistic(): HasMany
    {
        return $this->hasMany(TokenStatistic::class);
    }
}
