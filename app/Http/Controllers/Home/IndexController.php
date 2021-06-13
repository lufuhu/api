<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Article\ArticleMd;

class IndexController extends Controller
{
    public function index()
    {
        $data['swiper'] = Article::select('id', 'title', 'pic')->get();
        $data['notice'] = Article::select('id', 'title')->get();
        $data['project'] = Article::select('id', 'title', 'pic')->limit(5)->get();
        $topics = Article::getTopicAll();
        $topic = [];
        foreach ($topics as $item) {
            $topic[] = [
                'name' => $item,
                'children' => Article::where('topic', $item)->limit(5)->select('id', 'title')->get()
            ];
        }
        $data['topic'] = $topic;
        $data['tag'] = Article::getTagAll();
        $data['statistics'] = [
            'article' => rand(0, 1000),
            'project' => rand(0, 1000),
            'topic' => rand(0, 1000),
            'tags' => rand(0, 1000),
        ];
        return $this->response($data);
    }
}
