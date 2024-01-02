<?php

namespace App\Models;
use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;
    protected $fillable = 
    ['name', 
    'contact_info'];
    public function Foods(){
       return $this->hasMany(FoodItem::class);
      }
}
