<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>表单</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="" rel="stylesheet">
</head>
<body>
    <form action="/home/test/modeladd" method="post">
        <p>姓名：<input type="text" name="name" value=""></p>
        <p>年龄：<input type="text" name="age" value=""></p>
        <p>邮箱：<input type="email" name="email" value=""></p>
        {{csrf_field()}}
        <input type="submit" value="提交">
    </form>
</body>
</html>
