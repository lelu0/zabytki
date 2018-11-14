<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monument extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function location()
    {
        return $this->hasOne('App\Location');
    }

    public static function getAll($isConfirmed)
    {
        return Monument::select(array('id', 'name', 'description'))->where(array('confirmed' => $isConfirmed))->paginate(10);
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function sources()
    {
        return $this->hasMany('App\Source');
    }
    public function photos()
    {
        return $this->hasMany('App\Photo');
        
    }
    public function category()
    {
        return $this->hasOne('App\Category');
    }
}
