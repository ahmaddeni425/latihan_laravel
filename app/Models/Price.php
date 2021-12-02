<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql_2';
    protected $table = 'tb_price';
    protected $primaryKey = 'id';

    public $timestamps = false;

    // public function post(){
    //     return $this->hasOne(Post::class, 'id' , 'post_id');
    // }
}
