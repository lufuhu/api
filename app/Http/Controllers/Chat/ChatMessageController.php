<?php


namespace App\Http\Controllers\Chat;


use App\Http\Controllers\Controller;
use App\Models\Chat\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function index(Request $request)
    {
        $data = ChatMessage::where('room_id', $request->input('room_id'))->get();
        return $this->response($data);
    }

    public function store(Request $request, ChatMessage $obj)
    {
        $params = $request->all();
        $params['user_id'] = $request->user()->id;
        $obj->fill($params);
        $obj->save();
        return $this->response($obj);
    }

    public function update($id, Request $request)
    {
        if ($request->input('status')) {
            $obj = ChatMessage::where('id', $id)->where('user_id', $request->user()->id)->first();
            $obj->update(['status'=>$request->input('status')]);
        }
        return $this->response();
    }

    public function destroy($id, Request $request)
    {
        $obj = ChatMessage::where('id', $id)->where('user_id', $request->user()->id)->first();
        $obj->delete();
        return $this->response();
    }
}
