<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'recommendable_type', 'recommendable_id'];

    public function recommendable()
    {
        return $this->morphTo();
    }
}
