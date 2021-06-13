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
        0 => '默认', 1 => '博客文章', 2 => '开源项目', 3 => '速查表', 4 => '轮播图'
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

    public function getUrlAttribute()
    {
        return '/articles/' . $this->id . '.html';
    }

    public function setContentAttribute($value)
    {
        $Parsedown = new \Parsedown();
        Storage::disk('article')->put($this->id . '.html', $Parsedown->text($value));
        $this->attributes['content'] = $value;
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
