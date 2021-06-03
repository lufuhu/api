<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function upload(Request $request){
        $url = Storage::putFile('public/github/' . date("Ymd"), $request->file('file'));
        return $this->response(env('APP_URL').'/storage/'.str_replace('public/', '', $url));
    }
}
