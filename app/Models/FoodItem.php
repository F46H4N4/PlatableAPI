<?php

namespace App\Models;
use App\Models\Donor;
use App\Models\Recipient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
 use HasFactory;
 protected $fillable = ['name', 
 'description', 
 'expiryDate',
 'quantity',
'recipientId',
'donorId'];
public function recipient(){
    return $this->belongsTo(Recipient::class,'recipientId');
}
public function donor(){
    return $this->belongsTo(Donor::class,'donorId');
}
}
