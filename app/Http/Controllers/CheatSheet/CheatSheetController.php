<?php


namespace App\Http\Controllers\CheatSheet;


use App\Http\Controllers\Controller;
use App\Models\CheatSheet;
use App\Models\CheatSheetMd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CheatSheetController extends Controller
{
    public function index()
    {
        $data = CheatSheet::orderBy('sort', 'desc')->get();
        return $this->response($data);
    }

    public function store(Request $request, CheatSheet $obj)
    {
        $params = $request->all();
        $obj->fill($params);
        $obj->save();
        return $this->response();
    }

    public function update($id, Request $request)
    {
        $obj = CheatSheet::where('id', $id)->first();
        $obj->update($request->all());
        return $this->response();
    }

    public function build($id)
    {
        $data = CheatSheet::find($id);
        $list = CheatSheetMd::where('pid', $id)->get();
        $Parsedown = new \Parsedown();
        foreach ($list as $item) {
            $item->content = $Parsedown->text($item->content);
        }
        Storage::disk('cheatsheet')->put($data->name_en . '.html', view('cheatsheet.item', compact('data', 'list')));
        $cheatSheetList = CheatSheet::get();
        Storage::disk('cheatsheet')->put('index.html', view('cheatsheet.index', ['list' => $cheatSheetList]));
    }

    public function destroy($id)
    {
        $obj = CheatSheet::where('id', $id)->first();
        Storage::disk('cheatsheet')->delete($obj->name_en . '.html');
        $obj->delete();
        return $this->response($id);
    }
}
