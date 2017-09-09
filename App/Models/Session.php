<?php

namespace App\Models;

use System\Libraries\Http\Messages\Session as SessionLibrary;

class Session extends SessionLibrary
{

    const USER_AUTH = 'authentication';

    public function __construct()
    {
        self::start();
        parent::__construct('iland');
    }

}
