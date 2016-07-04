<?php
/**
 * Created by PhpStorm.
 * User: silov
 * Date: 16/6/21
 * Time: 16:03
 */

namespace App\Models;


class Room extends BaseModel
{
    protected $primaryKey = 'room_id';
    protected $table = 'rooms';

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

}