<?php
namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Multitenantable{
    protected static function bootMultitenantable(): void{
        static::creating(function($model){
            $model->user_id = auth()->id();
        });
        static::addGlobalScope('created_by_user_id', function(Builder $builder){
            $builder->where('user_id', auth()->id());
        });
    }
}