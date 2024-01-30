<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    protected $table = 'blog';
    // app/Models/Blog.php

    protected $fillable = ['title', 'description', 'userId', 'image'];

    use HasFactory;

    function getUser(){
        return $this->hasOne(User::class,'id','userId');
    }
}
