<?php

namespace App\Models;

use System\Core\Model;

class DataTable extends Model
{

    /** @var string */
    protected static $table = '';

    /** @var \Illuminate\Database\Query\Builder */
    protected $query = null;

    /**
     * 
     * @return string
     */
    final public static function getTable()
    {
        return static::$table;
    }

    /**
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    final public function getQuery()
    {
        return $this->query;
    }

    /**
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    final public function copyQuery()
    {
        return clone $this->query;
    }

}
