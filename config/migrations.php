<?php
use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropIfExists('products');
Capsule::schema()->dropIfExists('users');

Capsule::schema()->create('products', function($table){
    $table->increments('id');
    $table->string('name');
    $table->string('serial');
    $table->integer('stock');
    $table->float('price');
    $table->timestamps();
});

Capsule::schema()->create('users', function($table){
    $table->increments('id');
    $table->string('name');
    $table->string('lastname');
    $table->string('username')->unique();
    $table->string('password');
    $table->string('token');
    $table->timestamps();
});

//php start.php
//composer dumpautoload