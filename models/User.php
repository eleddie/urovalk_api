<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
    protected $fillable = ['name', 'lastname', 'username', 'password', 'token'];
    protected $table = 'users';
    protected $hidden = ['password'];
}