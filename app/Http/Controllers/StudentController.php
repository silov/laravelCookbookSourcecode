<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class StudentController extends Controller
{
    public function getIndex()
    {
        echo "Student.Index";
    }

    /**
     * 新增学生 页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddv()
    {
        return view("student.addv");
    }

    /**
     * 保存新增学生
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * 删除/恢复 管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * 学生列表 - 在籍
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList(Request $request)
    {
        $params = $request->all();

        $_params = [
            'id'    => empty($params['id']) ? '' : $params['id'],
            'name'  => empty($params['name']) ? '' : $params['name'],
        ];

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
        $list = $model->getList($condition, 0,$order, $limit, $offset);
        $total = $model->getCountByCondition($condition, 0);
        $ret = [
            'total'         => (int)$total,
            'page_size'     => $limit,
            'page_count'    => ceil($total / $limit),
            'page'          => $page,
            'list'          => $list,
            'page_url'      => $pageUrl,
            '_params'       => $_params
        ];
        return view("student.list", $ret);
    }

    /**
     * 学生列表 - 休学
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDropList(Request $request)
    {
        $params = $request->all();

        $_params = [
            'id'    => empty($params['id']) ? '' : $params['id'],
            'name'  => empty($params['name']) ? '' : $params['name'],
        ];


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
        $pageUrl = '/student/droplist/?' . http_build_query($pageParams) . (empty($pageParams) ? "" : "&");

        $model = new Student();
        $list = $model->getList($condition, 2,$order, $limit, $offset);
        $total = $model->getCountByCondition($condition, 2);
        $ret = [
            'total'         => (int)$total,
            'page_size'     => $limit,
            'page_count'    => ceil($total / $limit),
            'page'          => $page,
            'list'          => $list,
            'page_url'      => $pageUrl,
            '_params'       => $_params
        ];
        return view("student.droplist", $ret);
    }

    public function getEdit(Request $request)
    {
        $id = $request->get('id', 0);
        if (empty($id)) {
            return redirect("/student/addv");
        }

        $model = new Student();
        $student = $model->find($id)->toArray();

//        $mes = $request->session()->get('update_word', null);
//        if (!empty($mes)) {
//            $student['update_word'] = $mes;
//        }

        return view('student.edit', $student);
    }

    public function postUpdate(Request $request)
    {
        $params = $request->all();

        $rules = [
            'id'        => 'required|integer',
            'name'      => 'required|max:30',
            'sex'       => 'required|between:1,2',
            'birthday'  => 'required|date',
            'grade'     => 'required|integer',
            'class'     => 'required|int'
        ];
        $messages = [
            'required'      => '* 不能为空!',
            'id.required'   => '* 学生ID为空!',
            'id.integer'    => '* 学生ID格式错误!',
            'name.max'      => '* 学生姓名长度过大',
            'sex.between'   => '* 性别填写错误',
            'birthday.date' => '* 生日格式应为 YYYY-mm-dd',
            'grade.integer' => '* 年级信息请填写入学年份数字,如:' . date('Y'),
            'class.integer' => '* 班级信息请填写班级数字'
        ];
        $this->validate($request, $rules, $messages);

        $studentModel = new Student();
        $id = $params['id'];
        unset($params['id']);
        unset($params['_token']);
        $res = $studentModel->updateById($id, $params);
        $word = $res ? '更新成功!' : '更新失败!';
        return redirect('/student/edit?id=' . $id)->with('update_word', $word);
    }
}
