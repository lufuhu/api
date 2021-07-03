<?php


namespace App\Http\Controllers\Tool;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ToolController extends Controller
{
    public function index()
    {
        return $this->response(Config::get('tools'));
    }
}
