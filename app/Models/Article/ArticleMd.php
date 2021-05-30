<?php


namespace App\Models\Article;


use App\Models\BaseModel;

class ArticleMd extends BaseModel
{
    protected $table = "article_md";

    protected $fillable = [
        "title",
        "type",
        "pic",
        "topic",
        "tag",
        "content",
        "status",
    ];

    public static $EnumType = [
        0 => '默认', 1 => '博客', 2 => '速查表',
    ];
    public static $EnumStatus = [
        0 => '草稿', 1 => '发布'
    ];

    public function getTagAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function setTagAttribute($value)
    {
        $this->attributes['tag'] = is_array($value) ? implode(',', $value) : '';
    }
}
