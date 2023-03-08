<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    use HasFactory;
    protected $fillable = ['genus', 'name', 'family', 'order'];
    public function nutritions()
    {
        return $this->hasOne(Nutrition::class);
    }
}
