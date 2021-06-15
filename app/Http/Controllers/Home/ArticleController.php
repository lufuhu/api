<?php


namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function enum()
    {
        $enumType = $this->parseEnum(Article::$EnumType);
        $enumStatus = $this->parseEnum(Article::$EnumStatus);
        return $this->response(compact('enumStatus', 'enumType'));
    }

    public function getSelectData()
    {
        $tag = Article::getTagAll();
        $topic = Article::getTopicAll();
        return $this->response(compact('tag', 'topic'));
    }

    public function index(Request $request)
    {
        $query = new Article();
        if ($request->input('keyword')) {
            $query = $query->where('title', 'like', '%' . $request->input('keyword') . "%");
        }
        if ($request->input('type')) {
            $query = $query->where("type", $request->input('type'));
        }
        if ($request->input('status')) {
            $query = $query->where("status", $request->input('status'));
        }
        if ($request->input('topic')) {
            $query = $query->where("topic", $request->input('topic'));
        }
        if ($request->input('tag')) {
            $query = $query->where("tag", '%' . $request->input('tag') . '%');
        }
        $data = $query->where('status', 1)
            ->orderBy('sort', 'desc')
            ->orderBy('created_at', 'desc')
            ->select('id', "title", "type", "pic", "topic", "tag", 'summary', 'status', 'url', 'sort', 'created_at', 'updated_at')->paginate(18);
        return $this->response($data);
    }

    public function view($id)
    {
        $obj = Article::find($id);
        return $this->response($obj);
    }

    public function store(Request $request, Article $obj)
    {
        $params = $request->all();
        $params['title'] = $request->input('title') ? $params['title'] : "标题";
        $params['type'] = $request->input('type') ? $params['type'] : 0;
        $params['status'] = $request->input('status') ? $params['status'] : 0;
        $obj->fill($params);
        $obj->save();
        $this->build($obj);
        return $this->response($obj->id);
    }

    public function update($id, Request $request)
    {
        $obj = Article::where('id', $id)->first();
        $obj->update($request->all());
        $this->build($obj);
        return $this->response();
    }

    public function build($data)
    {
        $Parsedown = new \Parsedown();
        $data->content = $Parsedown->text($data->content);
        Storage::disk('article')->put($data->id . '.html', view('articles', compact('data')));
    }

    public function destroy($id)
    {
        $obj = Article::where('id', $id)->first();
        Storage::disk('article')->delete($obj->id . '.html');
        $obj->delete();
        return $this->response();
    }
}
