<?php


namespace App\Http\Controllers\CheatSheet;


use App\Http\Controllers\Controller;
use App\Models\CheatSheetMd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheatSheetMdController extends Controller
{
    public function index($pid)
    {
        $data = CheatSheetMd::where('pid', $pid)->select('id',"pid", "title","sort")->orderBy('sort', 'desc')->get();
        return $this->response($data);
    }

    public function view($pid, $id)
    {
        $obj = CheatSheetMd::find($id);
        return $this->response($obj);
    }

    public function store(Request $request, CheatSheetMd $obj)
    {
        $params = $request->all();
        $obj->fill($params);
        $obj->save();
        return $this->response($obj->id);
    }

    public function update($id, Request $request)
    {
        $obj = CheatSheetMd::where('id', $id)->first();
        $obj->update($request->all());
        return $this->response();
    }

    public function destroy($id)
    {
        $obj = CheatSheetMd::where('id', $id)->first();
        $obj->delete();
        return $this->response($id);
    }
}
