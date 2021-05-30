<?php


namespace App\Models\Chat;

use App\Models\BaseModel;

class ChatMessage extends BaseModel
{

    protected $table = "chat_message";

    protected $fillable = [
        "user_id",
        "room_id",
        "content",
        "type",
        "status",
    ];
}
