<style>
    .hn-item {
        line-height: 60px;
        margin: 0;
        border-bottom: 2px solid transparent;
        font-size: 14px;
        padding: 0 20px;
        cursor: pointer;
        -webkit-transition: border-color .3s, background-color .3s, color .3s;
        transition: border-color .3s, background-color .3s, color .3s;
        box-sizing: border-box;
    }

    .hn-item:hover {
        border-bottom: 2px solid #409EFF;
        color: #409EFF;
    }

    .header {
        box-shadow: 0 2px 12px 0 rgba(0, 0, 0, .1);
        border: 1px solid #ebeef5;
        width: 100%;
        position: fixed;
        top: 0;
        z-index: 50;
    }

    .h-64 {
        height: 62px;
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

    .w-main {
        width: 1024px;
        margin: 0 auto;
    }
</style>
<div class="header h-64">
    <div class="w-main h-64 flex items-center justify-between">
        <a href="/" class="logo flex items-center">
            <img src="https://www.lufuhu.com/favicon.ico">
            <p>编程问号</p>
        </a>
        <div class="flex items-center">
            <div class="flex items-center justify-center">
                <a class="hn-item" href="/">首页</a>
                <a class="hn-item" href="/article">博客文章</a>
            </div>
        </div>
    </div>
</div>
