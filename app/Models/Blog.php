<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'slug',
        'description',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'parentable');
    }
}
