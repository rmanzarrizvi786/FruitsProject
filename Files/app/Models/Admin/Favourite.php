<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = ['fruit_id', 'user_id'];
    public function nutritions()
    {
        return $this->hasOne(Nutrition::class, 'fruit_id', 'fruit_id');
    }
}
