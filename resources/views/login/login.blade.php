@extends('layout.boot')

@section('title', '新增学生')

@section('content')
    <div class="page-header">
        <h1>登录</h1>
    </div>

    <form class="form-horizontal" method="post" action="/login/login">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">用户名</label>
            <div class="col-sm-6">
                {{csrf_field()}}
                <input type="text" class="form-control" style="width: 50% !important;" id="username" placeholder="登录名" name="username" value="{{old('username')}}">
                <span class="error-tips">{{$errors->first('username')}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-4 control-label">密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" style="width: 50% !important;" id="password" placeholder="密码" name="password" value="{{old('password')}}">
                <span class="error-tips">{{$errors->first('password')}}</span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <span class="error-tips">{{session('err')}}</span>
                <label for="inputEmail3" class="col-sm-4 control-label">
                    <button type="submit" class="btn btn-default">提交</button>
                </label>

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