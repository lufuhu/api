<?php


namespace App\Models\Chat;


use App\Models\BaseModel;

class ChatRoomUser extends BaseModel
{
    protected $table = "chat_room_user";

    protected $fillable = [
        "user_id",
        "room_id",
        "name",
        "name_note",
        "nickname",
        "avatar",
        "read_message_id",
        "disturbing",
        "show_nickname",
        "stick",
    ];
}
