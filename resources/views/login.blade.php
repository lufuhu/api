<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="lufuhu,编程问号">
    <meta name="keywords" content="编程问号,lufuhu">
    <meta name="author" content="编程问号">
    <link rel="icon" href="/favicon.ico">
    <title>LUFUHU | 编程问号</title>
    <style>
        *, html {
            margin: 0;
            padding: 0;
        }
        a {
            color: inherit;
            text-decoration: inherit;
        }
        .w-main {
            width: 1024px;
            margin: 0 auto;
        }
        .content {
            min-height: calc(100vh - 330px);
            padding-top: 80px;
            padding-bottom: 50px;
        }
    </style>
    <style>
        .login {
            width: 600px;
            margin: 0 auto;
            border-radius: 4px;
            border: 1px solid #ebeef5;
            background-color: #fff;
            overflow: hidden;
            color: #303133;
            transition: .3s;
            box-shadow: 0 2px 12px 0 rgba(0, 0, 0, .1);
            margin-top: 20vh;
            min-height: 30vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

@include("header")

<div class="content">
    <div class="w-main">
        @if ($ok)
            <div class="login">
                登录成功
            </div>
        @else
            <div class="login">
                <a href="/auth/github">
                    GitHub
                </a>
            </div>
        @endif
    </div>
</div>

@include("footer")
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script>
    if ({{$ok}}) {
        Cookies.set('token', data.token);
        Cookies.set('userInfo',  JSON.stringify(data.userInfo));
        window.location.href = "/";
    }
</script>
</body>
</html>
