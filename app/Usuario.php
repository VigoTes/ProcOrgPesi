<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{


    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = false;  //para que no trabaje con los campos fecha 


    protected $fillable = [
        'name', 'email','nombres','apellidos','DNI','password','remember_token'
    ];
}
