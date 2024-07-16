<?php

namespace App\Models;

use App\Models\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Deuda extends Model
{
    use Multitenantable;
    use HasFactory;

    protected $fillable = [
        'acreedor',
        'monto',
        'descripcion',
        'user_id'
    ];
}
