<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [ 'service_id', 'user_id' ];

    public function service() {
        return $this->belongsTo( Service::class );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }
    
    public function messages() {
        return $this->hasMany( Message::class );
    }

    public function scopeForAuthenticatedUser( Builder $builder ) {
        return $builder->where( 'user_id', auth()->user()->id )
            ->orWhereHas( 'service', function( $query ) {
                $query->where( 'user_id', auth()->user()->id );
            } )
        ;
    }
}
