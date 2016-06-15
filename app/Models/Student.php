<?php

namespace App\Models;


class Student extends BaseModel
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'students';
    protected $dateFormat = 'U';
    public $timestamps = true;
}
