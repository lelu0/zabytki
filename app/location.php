<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function monument()
    {
        return $this->belongsTo('App\Monument', 'monument_id', 'id');
    }
}
