<?php


namespace App\Http\Controllers\Interview;


use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InterviewController extends Controller
{
    public function getSelectData()
    {
        $tag = Interview::getTagAll();
        return $this->response(compact('tag'));
    }

    public function index(Request $request)
    {
        $query = new Interview();
        if ($request->input('keyword')) {
            $query = $query->where('title', 'like', '%' . $request->input('keyword') . "%");
        }
        if ($request->input('tag')) {
            $query = $query->where("tag", '%' . $request->input('tag') . '%');
        }
        $data = $query->orderBy('created_at', 'desc')->paginate(50);
        return $this->response($data);
    }

    public function view($id)
    {
        $obj = Interview::find($id);
        return $this->response($obj);
    }

    public function store(Request $request, Interview $obj)
    {
        $params = $request->all();
        $params['title'] = $request->input('title') ? $params['title'] : "标题";
        $obj->fill($params);
        $obj->save();
        return $this->response($obj->id);
    }

    public function update($id, Request $request)
    {
        $obj = Interview::where('id', $id)->first();
        $obj->update($request->all());
        return $this->response();
    }

    public function destroy($id)
    {
        $obj = Interview::where('id', $id)->first();
        $obj->delete();
        return $this->response();
    }
}
