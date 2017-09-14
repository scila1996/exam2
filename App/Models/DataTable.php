<?php

namespace App\Models;

use System\Core\Model;
use System\Core\Controller;
use System\Libraries\Database\DB;

abstract class DataTable extends Model
{

    /**
     * @return string
     */
    abstract public function tableName();
}
