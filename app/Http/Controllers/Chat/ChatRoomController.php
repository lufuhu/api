<?php


namespace App\Http\Controllers\Chat;


use App\Http\Controllers\Controller;
use App\Models\Chat\ChatMessage;
use App\Models\Chat\ChatRoom;
use App\Models\Chat\ChatRoomUser;
use Illuminate\Http\Request;


class ChatRoomController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $data = ChatRoomUser::where('user_id', $user_id)->get();
        foreach ($data as $item) {
            $item->last_message = ChatMessage::where('room_id', $item->id)
                ->orderBy('id', 'desc')->first();
            $item->unread_count = ChatMessage::where('user_id', $user_id)
                ->where('room_id', $item->id)
                ->where('id', '>', $item->read_message_id)->count();
            $item->chat_room = ChatRoomUser::where('id', $item->room_id)->first();
        }
        return $this->response($data);
    }

    public function view($id, Request $request)
    {
        $obj = ChatRoom::where('id', $id)->where('user_id', $request->user()->id)->first();
        return $this->response($obj);
    }

    public function store(Request $request, ChatRoom $obj)
    {
        $params = [];
        $params['user_id'] = $request->user()->id;
        $obj->fill($params);
        $obj->save();
        return $this->view($obj->id, $request);
    }

    public function update($id, Request $request)
    {
        $obj = ChatRoom::where('id', $id)->where('user_id', $request->user()->id)->first();
        $obj->update($request->all());
        return $this->view($id, $request);
    }

    public function destroy($id, Request $request)
    {
        $obj = ChatRoom::where('id', $id)->where('user_id', $request->user()->id)->first();
        $obj->delete();
        return $this->response();
    }
}
