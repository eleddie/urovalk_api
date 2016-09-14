<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
    protected $fillable = ['username', 'password'];
    protected $table = 'users';
    protected $hidden = ['password'];
}