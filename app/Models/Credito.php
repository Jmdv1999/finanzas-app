<?php

namespace App\Models;

use App\Models\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;
    use Multitenantable;

    protected $fillable = [
        'cliente',
        'monto',
        'descripcion',
        'user_id'
    ];
}
