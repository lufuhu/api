<?php


namespace App\Models;


class CheatSheetMd extends BaseModel
{
    protected $table = "cheatsheet_md";

    protected $fillable = [
        "pid",
        "title",
        "content",
        "sort",
    ];
}
