<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // name of the table associated with this model, such that eloquent can be used for 
    // querying.
    protected $table = "posts"; 

    // Primary key is id
    protected $primaryKey = 'id';
}
