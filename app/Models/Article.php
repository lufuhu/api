<?php


namespace App\Models;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Article extends BaseModel
{
    protected $table = "articles";

    protected $fillable = [
        "title",
        "type",
        "url",
        "pic",
        "topic",
        "tag",
        "content",
        "summary",
        "sort",
        "status",
    ];

    protected $appends = ['url'];

    public static $EnumType = [
        0 => '默认', 1 => '博客文章', 2 => '开源项目', 3 => '轮播图', 4 => '速查表',
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

    public static function getTopicAll()
    {
        $topics = self::pluck('topic')->toArray();
        return array_filter(array_unique($topics));
    }

    public static function getTagAll()
    {
        $tags = self::pluck('tag')->toArray();
        $tag = [];
        foreach ($tags as $item) {
            $tag = array_merge($tag, $item);
        }
        return array_filter(array_unique($tag));
    }
}
