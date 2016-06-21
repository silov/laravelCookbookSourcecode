<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends BaseModel
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'students';

    public static $sexConfig = [
        1   => '男',
        2   => '女'
    ];

    /**
     * 创建 并返回学生ID
     * @param $name
     * @param int $sex
     * @param string $birthday
     * @param int $grade
     * @param int $class
     * @return mixed
     */
    public function addStudent($name, $sex = 1, $birthday = '0000-00-00', $grade = 1, $class = 1)
    {
        $student = new static;
        $student->name      = $name;
        $student->sex       = $sex;
        $student->birthday  = $birthday;
        $student->grade     = $grade;
        $student->class     = $class;
        $student->save();
        return empty($student->id) ? false : $student->toArray();
    }

    /**
     * 根据条件,获取查询结果数组
     * @param array $condition
     * @param array $order
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getList($condition = [], $order = [], $limit = 0, $offset = 0)
    {
        $handler = $this;
        //查询条件
        if (!empty($condition)) {
            foreach ($condition as $field => $value) {
                if (is_array($value)) {
                    $handler = $handler->where($field, $value['operator'], $value['value']);
                } else {
                    $handler = $handler->where($field, $value);
                }
            }
        }
        //排序
        if (!empty($order)) {
            foreach ($order as $sortField => $sortType) {
                $handler = $handler->orderBy( $sortField, $sortType);
            }
        }
        // limit/offset
        if ($offset > 0) {
            $handler = $handler->skip($offset);
        }
        if ($limit > 0) {
            $handler = $handler->take($limit);
        }
        //取得查询结果并返回数组
        $result = $handler->get();
        return empty($result) ? [] : $result->toArray();
    }

    /**
     * 根据条件返回总记录条数
     * @param $condition
     * @return mixed
     */
    public function getCountByCondition($condition)
    {
        $handler = $this;
        //查询条件
        if (!empty($condition)) {
            foreach ($condition as $field => $value) {
                if (is_array($value)) {
                    $handler = $handler->where($field, $value['operator'], $value['value']);
                } else {
                    $handler = $handler->where($field, $value);
                }
            }
        }
        return $handler->count();
    }

    /**
     * 软删除数据
     * @param $id
     * @return mixed
     */
    public function softDeleteById($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * 将软删除的数据,彻底删除
     * @param $id
     * @return bool|mixed|null
     */
    public function destroySoftdataById($id)
    {
        $obj = $this->withTrashed()->find($id);
        return $obj->forceDelete();
    }

    /**
     * 恢复软删除的数据
     * @param $id
     * @return mixed
     */
    public function restoreById($id)
    {
        $obj = $this->withTrashed()->find($id);
        return $obj->restore();
    }

}
