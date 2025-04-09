<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousePhoto extends Model
{
    use HasFactory;

    protected $fillable = ['house_id', 'file_name'];

    public function house(){

        return $this->belongsTo(House::class);
    }
}
