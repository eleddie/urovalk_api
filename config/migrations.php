<?php
use Illuminate\Database\Capsule\Manager as Capsule;

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
    $table->string('username')->unique();
    $table->string('password');
    $table->timestamps();
});

//php start.php
//composer dumpautoload