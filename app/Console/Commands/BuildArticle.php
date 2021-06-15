<?php


namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class BuildArticle extends Command
{
    /**
     * 命令名称及签名
     */
    protected $signature = 'article:build {id?}';

    /**
     * 命令描述
     */
    protected $description = '构建文章HTML页面';

    /**
     * 创建命令
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 执行命令
     */
    public function handle()
    {
        $query = new Article();
        $ids = $this->argument('id') ? explode(',', $this->argument('id')) : [];
        if (count($ids) > 0){
            $query = $query->whereIn('id', $ids);
        }
        $data = $query->get();
        $Parsedown = new \Parsedown();
        foreach ($data as $item){
            $item->content = $Parsedown->text($item->content);
            Storage::disk('article')->put($item->id . '.html', view('articles', ['data' => $item]));
        }
    }
}
