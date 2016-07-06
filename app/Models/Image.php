<?php
/**
 * Created by PhpStorm.
 * User: silov
 * Date: 16/6/21
 * Time: 16:03
 */

namespace App\Models;


class Image extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = 'images';

    public function bind()
    {
        return $this->morphTo();
    }
}