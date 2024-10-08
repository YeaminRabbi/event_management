<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'platform',
        'credentials',
        'status',
    ];

    protected $casts = [
        'credentials' => 'array', // Automatically casts the credentials as JSON
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
