<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loginModel extends Model
{
   protected  $table = "login";
    protected  $primiaryKey = 'id';
    public  $incrementing = true;
    protected  $KeyType = 'int';
    public  $timestamps = true;
}
