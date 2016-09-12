<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Users extends Eloquent {
    protected $fillable = ['username', 'password'];
    protected $table = 'users';
}