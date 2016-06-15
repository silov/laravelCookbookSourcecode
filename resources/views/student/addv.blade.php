<!DOCTYPE html>
<html>
<head>
    <title>Add Student - Students's Info Manage System</title>
</head>
<body>
<div class="container">
    <div class="content">
        <h3>新增学生</h3>
        <hr>
        <form method="post" action="/student/add">
            <label>姓名:</label>
            <input type="text" name="name" /><br>
            <label>性别:</label>
            <select name="sex">
                <option value="1">男</option>
                <option value="0">女</option>
            </select><br>
            <label>年级:</label>
            <input type="text" name="grade"/><br>
        </form>
    </div>
</div>
</body>
</html>
