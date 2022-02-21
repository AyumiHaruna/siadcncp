<?php

namespace App\Modelos\Sicofi;

use Illuminate\Database\Eloquent\Model;
use Session;

class SicProyectos extends Model
{
    protected $connection = 'mysqlSicofi2017';
    protected $table = 'proyectos';
    public $timestamps = false;
    //
}
