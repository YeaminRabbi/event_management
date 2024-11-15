<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'mission', 'vision'];

    public function advantages()
    {
        return $this->hasMany(AboutAdvantage::class);
    }
}
