<?php


namespace App\Models;


class Interview extends BaseModel
{
    protected $table = "interviews";

    protected $fillable = [
        "title",
        "tag",
        "content",
        "html"
    ];

    public function getTagAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function setTagAttribute($value)
    {
        $this->attributes['tag'] = is_array($value) ? implode(',', $value) : '';
    }

    public function setHtmlAttribute()
    {
        $Parsedown = new \Parsedown();
        $this->attributes['html'] = $Parsedown->text($this->content);
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
