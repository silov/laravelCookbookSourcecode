<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getIndex()
    {
        echo "Student.Index";
    }

    public function getList(Request $request)
    {
        $params = $request->all();

        $page = empty($params['p']) ? 1 : intval($params['p']);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $order = [
            'id'    => 'asc'
        ];

        $condition = [];

        !empty($params['id']) && $condition['id'] = intval($params['id']);
        !empty($params['name']) && $condition['name'] = $params['name'];

        $pageParams = $params;
        unset($pageParams['p']);
        $pageUrl = '/student/list/?' . http_build_query($pageParams) . (empty($pageParams) ? "" : "&");

        $model = new Student();
        $list = $model->getList($condition, $order, $limit, $offset);
        $total = $model->getCountByCondition($condition);
        $ret = [
            'total'         => (int)$total,
            'page_size'     => $limit,
            'page_count'    => ceil($total / $limit),
            'page'          => $page,
            'list'          => $list,
            'page_url'      => $pageUrl
        ];
        return view("student.list", $ret);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddv()
    {
        return view("student.addv");
    }

    public function postAdd(Request $request)
    {
        $params = $request->all();

//        $student = new Student;
//        $student->name  = $params['name'];
//        $student->sex   = $params['sex'];
//        $student->birthday  = $params['birthday'];
//        $student->grade     = $params['grade'];
//        $student->class     = $params['class'];
//        $student->save();
//        var_dump($student->toArray());

        $rules = [
            'name'  => 'required|max:30',
            'sex'   => 'required|between:1,2',
            'birthday'  => 'required|date',
            'grade' => 'required|integer',
            'class' => 'required|int'
        ];
        $messages = [
            'required'      => '* 不能为空!',
            'name.max'      => '* 学生姓名长度过大',
            'sex.between'   => '* 性别填写错误',
            'birthday.date' => '* 生日格式应为 YYYY-mm-dd',
            'grade.integer' => '* 年级信息请填写入学年份数字,如:' . date('Y'),
            'class.integer' => '* 班级信息请填写班级数字'
        ];
        $this->validate($request, $rules, $messages);

        $studentModel = new Student();
        $student = $studentModel->addStudent($params['name'], $params['sex'], $params['birthday'], $params['grade'], $params['class']);
        return redirect("/student/list");
    }

    public function postDeleteManage(Request $request)
    {
        $params = $request->all();
        if (empty($params['action']) || empty($params['id'])) {
            return $this->renderJson(config('http_code.PARAMS_ERROR'), null, '参数不齐');
        }
        $model = new Student();
        switch ($params['action']) {
            case 'soft_delete': // 休学,软删除
                $res = $model->softDeleteById($params['id']);
                break;
            case 'destroy': // 直接退学,删除数据
                $res = $model->find($params['id'])->forceDelete();
                break;
            case 'restore': // 恢复软删除
                $res = $model->restoreById($params['id']);
                break;
            case 'delete': // 软删除数据彻底删除
                $res = $model->destroySoftdataById($params['id']);
                break;
            default:
                return $this->renderJson(config('http_code.PARAMS_ERROR'), null, '参数不齐');
                break;
        }
        if ($res) {
            return $this->renderJson(config('http_code.SUCCESS_CODE'), ['result' => true]);
        } else {
            return $this->renderJson(config('http_code.FAILED_NEED_REPEAT'), '操作失败,请重试');
        }
    }
}
