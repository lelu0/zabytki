<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function monument(){
        return $this->belongsTo('App\Monument');
    }
}
