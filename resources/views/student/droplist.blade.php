@extends('layout.boot')

@section('title', '学生列表')

@section('content')
    <div class="page-header">
        <h1>学生列表</h1>
    </div>
    <div class="row page-header">
        <form method="get" action="/student/list">
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">学号</button>
                    </span>
                    <input type="number" class="form-control" name="id" placeholder="学号" value="{{$_params['id']}}">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">姓名</button>
                    </span>
                    <input type="text" class="form-control" name="name" placeholder="姓名" value="{{$_params['name']}}">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
            <div class="col-md-3">
                <input type="submit" class="btn btn-success" value="查询"/>
            </div>

        </form>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            @if (!empty($list))
            <table class="table">
                <thead>
                <tr>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>入学年份</th>
                    <th>班级</th>
                    <th>生日</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                @foreach( $list as $student)
                <tr>
                    <td>{{$student['id']}}</td>
                    <td>{{$student['name']}}</td>
                    <td>{{\App\Models\Student::$sexConfig[$student['sex']]}}</td>
                    <td>{{$student['grade']}}</td>
                    <td>{{$student['class']}}</td>
                    <td>{{$student['birthday']}}</td>
                    <td class="col-md-3">
                        <button class="btn btn-info" onclick="deleteManage('restore','{{$student['id']}}')">恢复</button>
                        <button class="btn btn-info" onclick="deleteManage('delete','{{$student['id']}}')">退学</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-md-10">
                <div class="btn-group" role="group" aria-label="...">
                    <a class="btn btn-info" @if($page > 1) href="{{$page_url . 'p=1'}}" @else disabled @endif>首页</a>
                    <a class="btn btn-info" @if($page > 1) href="{{$page_url . 'p=' . ($page-1)}}" @else disabled @endif>上一页</a>
                    <a class="btn btn-info" @if($page < $page_count) href="{{$page_url . 'p=' . ($page+1)}}" @else disabled @endif>下一页</a>
                    <a class="btn btn-info" @if($page < $page_count) href="{{$page_url . 'p=' . ($page_count)}}" @else disabled @endif>尾页</a>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;
                共 {{$total}} 条记录, 第 {{$page}}/{{$page_count}} 页
            </div>
            @else
                Empty List
            @endif
        </div>
    </div>
    <script>
        function deleteManage(action, id) {
            var ajaxUrl = '/student/delete-manage';
            var confirmMsg = '';
            switch (action) {
                case 'restore' :
                    confirmMsg = '确认为该生恢复学籍状态?';
                    break;
                case 'destroy' :
                    confirmMsg = '确认退学?操作后无法撤销';
                    break;
                default:
                    break;
            }
            var isContinue = confirm(confirmMsg);
            if (!isContinue) {
                return false;
            }
            var postData = {
                action      : action,
                id          : id,
                _token      : $('meta[name="csrf-token"]').attr('content')
            };
            $.ajax({
                type : "POST",
                url  : ajaxUrl,
                data : postData,
                dataType : "json",
                success : function(res) {
                    if (res.status == 200) {
                        alert("操作成功!");
                        window.location.reload();
                    } else {
                        alert(res.msg);
                    }
                }
            });
        }
    </script>
@endsection

