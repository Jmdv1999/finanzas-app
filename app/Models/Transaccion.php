<?php

namespace App\Models;

use App\Models\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;
    use Multitenantable;
    protected $fillable = ["monto", "concepto", "tipo_transaccion", "cuenta_id", "user_id"];

    public function cuentas(){
        return $this->belongsTo(Cuenta::class, 'cuenta_id');
    }
}

