<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
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
