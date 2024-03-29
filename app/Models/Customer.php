<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    const CREATED_AT = 'date_reg';
    const UPDATED_AT = 'date_reg';
    protected $table = 'customers';
    protected $primaryKey = 'dni';
    protected $fillable = [
        "dni", "email", "name",
        "last_name", "address",
        "id_reg", "id_com"
    ];
    protected $casts = [
        'date_reg' => "datetime"
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, "id_reg", "id_reg");
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, "id_com", "id_com");
    }
}
