<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramAccount extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'url', 'description', 'followers_count', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
