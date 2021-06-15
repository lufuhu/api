<style>
    .footer {
        height: 200px;
        background: #1a202c;
    }
</style>
<div class="footer">
    <div class="w-main mx-auto max-w-screen-xl flex flex-col justify-center items-center">
        <div class="flex mt-16 mb-12">
            <a class="footer-icon-1" href="https://github.com/lufuhu" target="_blank"><img src="https://www.lufuhu.com/static/icon/github.png"/></a>
            <a class="footer-icon-1" href="https://gitee.com/lufuhu" target="_blank"><img src="https://www.lufuhu.com/static/icon/gitee.png"/></a>
            <el-popover
                placement="top"
                width="200"
                trigger="hover">
                <div slot="reference">
                    <div class="footer-icon-1"><img src="https://www.lufuhu.com/static/icon/wexin.png"/></div>
                </div>
                <img src="https://www.lufuhu.com/static/wechat.jpg"/>
            </el-popover>
            <el-popover
                placement="top"
                width="200"
                trigger="hover">
                <div slot="reference">
                    <div class="footer-icon-1"><img src="https://www.lufuhu.com/static/icon/qq.png"/></div>
                </div>
                <img src="https://www.lufuhu.com/static/qq.png"/>
            </el-popover>
            <el-tooltip class="item" effect="dark" content="master@lufuhu.com" placement="top">
                <div class="footer-icon-1"><img src="https://www.lufuhu.com/static/icon/mail.png"/></div>
            </el-tooltip>
        </div>
        <div class="text-gray-300 text-sm flex justify-center items-center">
            <el-link href="https://beian.miit.gov.cn" target="_blank">鄂ICP备2021009343号-1</el-link>
            <el-divider direction="vertical"></el-divider>
            <div class="flex items-center">
                <img src="https://www.lufuhu.com/static/gongan.png" class="mr-1"/>
                <el-link href="http://www.beian.gov.cn" target="_blank">鄂公网安备号</el-link>
            </div>
        </div>
    </div>
</div>
