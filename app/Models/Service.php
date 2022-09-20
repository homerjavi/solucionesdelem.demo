<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [ 'title', 'description', 'price' ];

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function chats() {
        return $this->hasMany( Chat::class );
    }

    public function scopeNotCreatedByAuthenticatedUser( Builder $builder ) {
        return $builder->where( 'user_id', '!=', auth()->user()->id );
    }

    public function scopeCreatedByAuthenticatedUser( Builder $builder ) {
        return $builder->where( 'user_id', auth()->user()->id );
    }

    protected static function boot() {
        parent::boot();
        self::creating(function ($model) {
            if (!app()->runningInConsole()) {
                $model->user_id = auth()->user()->id;
            }
        });
    }

}
