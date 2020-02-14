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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="" method="post">
        <p>姓名：<input type="text" name="name" value=""></p>
        <p>年龄：<input type="text" name="age" value=""></p>
        <p>邮箱：<input type="email" name="email" value=""></p>
        <p>验证码:<input type="text" name="captcha" /><img src="{{captcha_src()}}"></p>
        {{csrf_field()}}
        <input type="submit" value="提交">
    </form>
</body>
</html>
