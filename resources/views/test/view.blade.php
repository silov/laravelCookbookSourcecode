<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>多图文系统</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="/static/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/static/bootstrap/css/theme.css" rel="stylesheet">

    <!-- addBy Silov datetimePicker -->
    <link href="/static/bootstrap/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/static/bootstrap/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/static/bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .essay-list {
            margin: 0 auto;
            border: 1px solid lightgrey;
            height: 90%;
            padding-bottom: 20px;
        }
        .essay-edit {
            margin: 0 auto;
            border: 1px solid lightgrey;
            border-left: none;
            height: 90%;
        }
        .first-image {
            height: 120px;
            background-color: lightgrey;
            padding: 0;
        }
        .first-title {
            background-color: darkgrey;
            height: 30px;
            line-height: 28px;
            position:absolute;
            bottom:0px;
            text-align: left;
            padding: 3px auto;
        }
        .list-image {
            background-color: lightgrey;
            height:60px;
        }
        .list-title {
            height: 60px;
            background-color: lightblue;
            padding: 2px auto auto 2px;
        }
        .title-input {
            width:95%;
            height: 30px;
            border: 0 !important;
            font-weight: bold;
            padding-left: 10px;
            -webkit-border-radius:0;
            -moz-border-radius:0;
            border-radius:0;
            box-shadow: none;
        }
        input.title-input:hover {
            border: 0 !important;
        }
    </style>
</head>

<body role="document">

<div class="container theme-showcase" role="main">
    <div class="row">
        <div class="col-md-3 essay-list">
            <div class="page-header" style="margin-top: 20px">
                <h5>图文列表</h5>
            </div>
            <div class="col-md-12 essay-first">
                <div class="col-md-12 first-image">
                    <div class="col-md-12 first-title">
                        标题
                    </div>
                </div>
            </div>
            <div class="col-md-12 essay-follow">
                <div class="col-md-4 list-image">

                </div>
                <div class="col-md-8 list-title">
                    标题
                </div>
            </div>
        </div>
        <div class="col-md-9 essay-edit">
            <div class="page-header" style="margin-top: 20px">
                <input type="text" class="form-control title-input" name="title"/>
            </div>
        </div>
    </div>
</div> <!-- /container -->



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- <script src="/static/bootstrap/assets/js/docs.min.js"></script> -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/static/bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>

<!-- addBy Silov self-made common.js -->
<script src="/static/bootstrap/js/common.js"></script>
</body>
</html>
