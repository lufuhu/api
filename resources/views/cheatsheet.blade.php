<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="{{$data->summary}}">
    <meta name="keywords" content="速查表,lufuhu,{{$data->name}},{{$data->name_en}}">
    <meta name="author" content="速查表">
    <link rel="icon" href="/favicon.ico">
    <title>LUFUHU | 速查表-{{$data->name}}</title>
    <link href="https://cdn.bootcdn.net/ajax/libs/github-markdown-css/4.0.0/github-markdown.min.css" rel="stylesheet">
    <script src="https://cdn.bootcdn.net/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
    <style>
        *, html {
            margin: 0;
            padding: 0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        body {
            /*background-color: #384448;*/
        }

        .cs-name {
            text-align: center;
            padding: 30px 0;
        }

        .item {
            background: none;
            font-size: 1em;
            border: 1px solid #384448;
            border-radius: 4px;
            margin: 0.35rem;
        }

        .item .title {
            border-bottom: 1px solid #384448;
            font-weight: 600;
            padding: 10px 15px;
        }

        .content {
            padding: 0 0.5rem 2rem 0.5rem;
        }

        .grid {
            max-width: 2000px;
            margin: 0 auto;
        }

        .grid-item {
            width: 100%;
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
<div>
    <h2 class="cs-name">
        {{$data->name}}
    </h2>
    <div class="content">
        <div class="grid">
            @foreach ($list as $item)
                <div class="grid-item">
                    <div class="item">
                        <div class="title">{{$item->title}}</div>
                        <div class="markdown-body">{!! $item->content !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@include("footer")
<script>var msnry = new Masonry('.grid', {itemSelector: '.grid-item',});</script>
</body>
</html>
