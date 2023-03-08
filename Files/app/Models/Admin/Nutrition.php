<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Fruit;

class Nutrition extends Model
{
    use HasFactory;
    protected $fillable = ['fruit_id', 'carbohydrates', 'protein', 'fat', 'calories', 'sugar'];
    public function fruits()
    {
        return $this->belongsTo(Fruit::class);
    }
}
