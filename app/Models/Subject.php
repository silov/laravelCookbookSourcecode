<?php
/**
 * Created by PhpStorm.
 * User: silov
 * Date: 16/6/21
 * Time: 16:03
 */

namespace App\Models;


class Subject extends BaseModel
{
    protected $primaryKey = 'subject_id';
    protected $table = 'subjects';

    public function students()
    {
        return $this->belongsToMany('App\Models\Student','subject_choose', 'subject_id', 'student_id');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'bind');
    }
}