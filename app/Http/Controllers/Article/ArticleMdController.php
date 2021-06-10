<?php


namespace App\Http\Controllers\Article;


use App\Http\Controllers\Controller;
use App\Models\Article\ArticleMd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class ArticleMdController extends Controller
{
    public function enum()
    {
        $enumType = $this->parseEnum(ArticleMd::$EnumType);
        $enumStatus = $this->parseEnum(ArticleMd::$EnumStatus);
        return $this->response(compact('enumStatus', 'enumType'));
    }

    public function index(Request $request)
    {
        $query = new ArticleMd();
        if ($request->input('keyword')) {
            $query = $query->whereRaw("concat('title','topic','tag') like '%" . $request->input('keyword') . "%'");
        }
        if ($request->input('type')) {
            $query = $query->where("type", $request->input('type'));
        }
        if ($request->input('status')) {
            $query = $query->where("status", $request->input('status'));
        }
        $data = $query->orderBy('updated_at', 'desc')->paginate();
        return $this->response($data);
    }

    public function view($id)
    {
        $obj = ArticleMd::where('id', $id)->first();
        return $this->response($obj);
    }

    public function store(Request $request, ArticleMd $obj)
    {
        $params = $request->all();
        $params['title'] = $request->input('title') ? $params['title'] : "标题";
        $params['type'] = $request->input('type') ? $params['type'] : 0;
        $params['status'] = $request->input('status') ? $params['status'] : 0;
        $obj->fill($params);
        $obj->save();
        $this->build($obj->id);
        return $this->response($obj->id);
    }

    public function update($id, Request $request)
    {
        $obj = ArticleMd::where('id', $id)->first();
        $obj->update($request->all());
        $this->build($id);
        return $this->response();
    }

    public function destroy($id)
    {
        $obj = ArticleMd::where('id', $id)->first();
        $this->delMdFile($obj);
        $obj->delete();
        return $this->response();
    }

    public function build($id)
    {
        $obj = ArticleMd::where('id', $id)->first();
        if ($obj->status == 1){
            $content = '---' . "\n";
            $content = $content . 'title: ' . $obj->title . "\n";
            $content = $content . 'date: ' . $obj->created_at . "\n";
            $content = $content . 'topic: ' . $obj->topic . "\n";
            $content = $content . 'tags:' . $obj->topic . "\n";
            foreach ($obj->tag as $item) {
                $content = $content . '  - ' . $item . "\n";
            }
            $content = $content . '---' . "\n\n";
            $content = $content . $obj->content;
            $url = date("Y-m-d", strtotime($obj->created_at)) . '-' . $obj->id . '.md';
            if ($obj->type == 1) {
                $url = '_posts/'.$url;
            }
            Storage::disk('article')->put($url, $content);
        } else {
            $this->delMdFile($obj);
        }
        return $this->response();
    }

    private function delMdFile($obj)
    {
        $url = date("Y-m-d", strtotime($obj->created_at)) . '-' . $obj->id . '.md';
        $res = Storage::disk('article')->delete($url);
        if (!$res) {
            abort(5409);
        }
        return $res;
    }
}
