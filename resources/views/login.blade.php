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
    <title>编程问号 | 登录</title>
    <style>
        *, html {
            margin: 0;
            padding: 0;
        }

        a {
            color: inherit;
            text-decoration: inherit;
        }

        .header {
            height: 60px;
            z-index: 50;
            position: fixed;
            width: 100%;
            background: #ffffff;
        }

        .border-b {
            border-bottom: 1px solid #e5e7eb;
        }

        .w-main {
            width: 1024px;
            margin: 0 auto;
        }

        .header .logo img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
        }

        .header .logo p {
            font-weight: 700;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .footer {
            height: 200px;
            background: #1a202c;
        }

        .content {
            min-height: calc(100vh - 330px);
            padding-top: 80px;
            padding-bottom: 50px;
        }

        .avatar {
            height: 30px;
            width: 30px;
            border-radius: 50%;
        }

        .sub-title {
            margin-top: 15px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            font-size: 14px;
            color: #52585f;
        }

        .text-center {
            text-align: center;
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
<div class="header border-b">
    <div class="w-main flex items-center justify-between">
        <a href="/" class="logo flex items-center">
            <img src="https://www.lufuhu.com/favicon.ico">
            <p>编程问号</p>
        </a>
        <a href="/user" class="flex items-center">
            <img class="avatar" src="https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png">
        </a>
    </div>
</div>
<div class="content">
    <div class="w-main">
        @if ($data)
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
<div class="footer">

</div>
<script type="module" src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
<script>
    let data = {{$data}};
    if (data) {
        Cookies.set('token', data.token);
        Cookies.set('userInfo', data.userInfo);
    }
</script>
</body>
</html>
