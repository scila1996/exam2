<?php

namespace App\Models;

use System\Core\Model;

abstract class DataTable extends Model
{

    /**
     * @return string
     */
    abstract public function tableName();
}
