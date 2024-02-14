<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = 'communes';
    protected $primaryKey = 'id_com';
    public $timestamps = false;
    protected $fillable = ["description", "status"];

    public function region()
    {
        return $this->belongsTo(Region::class, "id_reg", "id_reg");
    }
}
