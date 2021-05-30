<?php


namespace App\Models\Chat;


use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatRoom extends BaseModel
{
    use SoftDeletes;

    protected $table = "chat_room";

    protected $fillable = [
        "type",
    ];


}
