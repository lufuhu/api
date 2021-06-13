<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Models\Article;

class IndexController extends Controller
{
    public function index()
    {
        $data['swiper'] = Article::where('status', 1)->where('type', 3)->select('id', 'title', 'pic', 'summary')->get();
        $data['project'] = Article::where('status', 1)->where('type', 2)->select('id', 'title', 'pic', 'summary')->get();
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
            'article' => Article::where('status', 1)->where('type', 1)->count(),
            'project' => Article::where('status', 1)->where('type', 2)->count(),
            'topic' => count($topic),
            'tag' => count($data['tag']),
        ];
        return $this->response($data);
    }
}
