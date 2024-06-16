<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\Multitenantable;

class Divisa extends Model
{
    use HasFactory;
    use Multitenantable;
    protected $fillable = ["nombre", "codigo","user_id"];

    public function cuentas(){
        return $this->hasMany(cuenta::class, 'id');
    }
}
