<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    public $timestamps = false;

    /**
     * 
     * @return mixed
     */
    public static function login($user, $pass, $course)
    {
        return static::query()->where([
                    'user' => $user,
                    'pass' => sha1($pass),
                    'course_id' => $course
                ])->first();
    }

    public static function changePassword($user, $old, $new)
    {
        $data = static::query()->where([
                    'id' => $user,
                    'pass' => sha1($old)
                ])->first();

        if ($data)
        {
            $data->pass = sha1($new);
            return $data->save();
        }

        return false;
    }

}
