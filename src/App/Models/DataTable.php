<?php

namespace App\Models;

use System\Core\Model;
use ErrorException;

class DataTable extends Model
{

    /**
     * @return string
     */
    public static function tableName()
    {
        throw new ErrorException('table name is must be define');
    }

}
