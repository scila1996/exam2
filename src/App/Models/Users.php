<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    public function getdata()
    {
        return $this->hasMany(Files::class, 'user_id', 'id');
    }

}
