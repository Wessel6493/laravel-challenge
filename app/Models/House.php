<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class House extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "title", "surface_area", "day_price", "description"]; 

    public function photos(){
        return $this->hasMany(HousePhoto::class, 'house_id');
    }
    public function getPhotos(){
        return HousePhoto::where('house_id', $this->id)->get();
    }
}
