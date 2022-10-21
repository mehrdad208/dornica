<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProvinceCity extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='province_cities';

    protected $fillable =['parent','title'];


    public function users(){
        return $this->belongsToMany(User::class);
    }
}
