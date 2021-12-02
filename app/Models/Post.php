<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Price;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status',
        'image',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function price(){
        return $this->belongsTo(Price::class, 'id' , 'post_id');
    }

}
