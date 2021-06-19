<?php


namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\CheatSheet;
use App\Models\CheatSheetMd;

class IndexController extends Controller
{
    public function test(){
//        $id = 42;
//        $data = CheatSheet::find($id);
//        $list = CheatSheetMd::where('pid', $id)->get();
//        $Parsedown = new \Parsedown();
//        foreach ($list as $item) {
//            $item->content = $Parsedown->text($item->content);
//        }
//        return view('cheatsheet.item', compact('data', 'list'));
//        Storage::disk('cheatsheet')->put($data->name_en . '.html', view('cheatsheet.item', compact('data', 'list')));
        $cheatSheetList = CheatSheet::get();
        return view('cheatsheet.index', ['list' => $cheatSheetList]);
//        Storage::disk('cheatsheet')->put('index.html', view('cheatsheet.index', ['list' => $cheatSheetList]));
    }

    public function upload(Request $request){
        $key = array_key_first($request->file());
        $path = Storage::putFile('public/github/' . date("Ymd"), $request->file($key));
        $url = env('APP_URL').'/storage/'.str_replace('public/', '', $path);
        if ($request->input('source') == "mdEditor"){
            return response([
                'success' => 1,
                'message' => "上传成功",
                'url' => $url
            ]);
        }else {
            return $this->response($url);
        }
    }
}
