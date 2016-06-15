<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $connection = 'mysql';
    protected $dateFormat = 'U';
    public $timestamps = true;
}
