<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    public const ROOT = 1;

    protected $fillable = ['title','parent_id','slug','description'];

    public function parentCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(__CLASS__,'parent_id','id');
    }

    public function getParentTitleAttribute(): string
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
            ? 'Корневая' : '???');

        return $title;
    }

    public function isRoot(): bool
    {
        return $this->id === self::ROOT;
    }

}
