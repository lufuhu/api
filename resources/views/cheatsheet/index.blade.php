<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="速查表">
    <meta name="keywords" content="lufuhu,速查表">
    <meta name="author" content="lufuhu">
    <link rel="icon" href="/favicon.ico">
    <title>LUFUHU | 速查表</title>
    <style>
        *, html {
            margin: 0;
            padding: 0
        }

        body{
            background-color: #e4e7e7;
        }

        a {
            color: inherit;
            text-decoration: inherit
        }
        .header{
            height: 35vh;
            background-color: #2b2b2b;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .w-main {
            width: 1024px;
            margin: 0 auto;
            padding: 30px 0;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            display: grid;
        }
        .item{
            border: 1px solid #eceaea;
            display: flex;
            align-items: center;
            background-color: #ffffff;
            border-radius: 5px;
            padding: 10px 15px;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,.01);
        }
        .item .icon{
            width: 45px;
            height: 45px;
        }
        .item .title{
            margin-left: 10px;
        }
        /*sm*/
        @media (min-width: 640px) {
            .grid-item {
                width: 100%;
            }
        }

        /*md*/
        @media (min-width: 768px) {
            .grid-item {
                width: 50%;
            }
        }

        /*lg*/
        @media (min-width: 1024px) {
            .grid-item {
                width: 33.3333333%;
            }
        }

        /*xl*/
        @media (min-width: 1280px) {
            .grid-item {
                width: 33.3333333%;
            }
        }

        /*2xl*/
        @media (min-width: 1800px) {
            .grid-item {
                width: 25%;
            }
        }
    </style>
</head>
<body>
<div class="content">
    <div class="header">
        <h1>速查表</h1>
    </div>
    <div class="w-main">
        @foreach ($list as $item)
            <a href="/{{$item->name_en}}.html" class="item">
                <img class="icon" src="{{$item->icon}}">
                <div class="title">{{$item->name}}</div>
            </a>
        @endforeach
    </div>
</div>
@include("footer")
</body>
</html>
