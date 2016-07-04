@extends('layout.boot')

@section('title', '编辑学生信息')

@section('content')
    <div class="page-header">
        <h1>编辑学生信息</h1>
    </div>

    <form class="form-horizontal" method="post" action="/student/update">
        <div class="form-group">
            <label class="col-sm-2 control-label" style="color: lightpink;"><?=empty($update_word) ? '' : $update_word?></label>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$id}}">
                <input type="text" class="form-control" id="name" placeholder="学生姓名" name="name" value="{{empty(old('name')) ? $name : old('name')}}">
                <span class="error-tips">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">性别</label>
            <div class="col-sm-10">
                <select name="sex">
                    <option value="1" {{ (old('sex') == '1' || (empty(old('sex')) && $sex == '1')) ? 'selected="selected"' : ''  }}>男</option>
                    <option value="2" {{ (old('sex') == '2' || (empty(old('sex')) && $sex == '2')) ? 'selected="selected"' : ''  }}>女</option>
                </select>
                <span class="error-tips">{{$errors->first('sex')}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">生日</label>
            <div class="col-sm-10 input-append date form_datetime">
                <input size="16" type="text" class="form-control datepicker-here" readonly
                       data-language="zh" id="birthday" placeholder="选择生日"
                       name="birthday" value="{{ empty(old('birthday')) ? $birthday : old('birthday') }}">
                <span class="error-tips">{{$errors->first('birthday')}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">入学年份</label>
            <div class="col-sm-10">
                <input type="year" class="form-control" id="grade" placeholder="填写入学年份" name="grade" value="{{ empty(old('grade')) ? $grade : old('grade') }}">
                <span class="error-tips">{{$errors->first('grade')}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">班级</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="class" placeholder="填写班级号" name="class" value="{{ empty(old('class')) ? $class : old('class') }}">
                <span class="error-tips">{{$errors->first('class')}}</span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </form>
    </div>

    <!-- 时间选择器 -->
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <link href="/static/air_datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css">
    <script src="/static/air_datepicker/js/datepicker.js"></script>
    <script src="/static/air_datepicker/js/i18n/datepicker.lang.js"></script>
@endsection