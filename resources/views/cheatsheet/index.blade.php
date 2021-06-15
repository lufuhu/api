<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="{{$data->summary}}">
    <meta name="keywords" content="编程问号,lufuhu,{{$data->topic}},{{implode(',', $data->tag)}}">
    <meta name="author" content="编程问号">
    <link rel="icon" href="/favicon.ico">
    <title>{{$data->title}}</title>
    <link href="https://cdn.bootcdn.net/ajax/libs/github-markdown-css/4.0.0/github-markdown.min.css" rel="stylesheet">
    <style>*,html{margin:0;padding:0}a{color:inherit;text-decoration:inherit}.border-b{border-bottom:1px solid #e5e7eb}.w-main{width:1024px;margin:0 auto}.flex{display:flex}.items-center{align-items:center}.justify-center{justify-content:center}.content{min-height:calc(100vh - 200px);padding-top:80px;padding-bottom:50px}.sub-title{margin-top:15px;margin-bottom:30px;padding-bottom:15px;font-size:14px;color:#52585f}.text-center{text-align:center}</style>
</head>
<body>
@include("header")
<div class="content">
    <div class="w-main">
        <h3 class="text-center">{{$data->title}}</h3>
        <div class="border-b flex items-center justify-center sub-title">
            <div>{{$data->topic}}</div>
            <div>{{implode(',', $data->tag)}}</div>
            <div>{{$data->created_at}}</div>
        </div>
        <div class="markdown-body">
            {!! $data->content !!}
        </div>
    </div>
</div>
@include("footer")
</body>
</html>
