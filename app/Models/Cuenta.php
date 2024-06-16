<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Multitenantable;
class Cuenta extends Model
{
    use HasFactory;
    use Multitenantable;
    
    protected $fillable = ["numero","nombre","divisas_id", "user_id"];

    public function divisas(){
        return $this->belongsTo(Divisa::class, 'divisas_id');
    }
}
