<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'title',
        'header',
        'image_tumbnail',
        'image_content',
        'link_video',
        'content',
        'views',
        'type_content',
        'type_trash',
        'user_id',
    ];

    protected function typeContent(): Attribute
    {
        return new Attribute(
            get: fn($value) =>  ["DIY", "Course"][$value],
        );
    }

    protected function typeTrash(): Attribute
    {
        return new Attribute(
            get: fn($value) =>  ["Organic", "Anorganic"][$value],
        );
    }
}
