<?php


namespace App\Models;


class CheatSheet extends BaseModel
{
    protected $table = "cheatsheets";

    protected $fillable = [
        "name",
        "name_en",
        "summary",
        "icon",
        "url",
        "sort",
    ];

    public static $EnumStatus = [
        0 => '草稿', 1 => '发布'
    ];

    public function getUrlAttribute($value)
    {
        return $value ? $value : '/cheatsheets/' . $this->name_en . '.html';
    }
}
