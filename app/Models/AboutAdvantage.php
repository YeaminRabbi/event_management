<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutAdvantage extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'title'];

    public function aboutUs()
    {
        return $this->belongsTo(AboutUs::class);
    }
}
