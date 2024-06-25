<?php

namespace App\Models;

use App\Models\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuenteIngreso extends Model
{
    use HasFactory;
    use Multitenantable;
    protected $fillable = ["mombre", "descripcion", "user_id"];
}
