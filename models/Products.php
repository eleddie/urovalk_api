<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Products extends Eloquent {
    protected $fillable = ['name', 'serial', 'stock', 'price'];
    protected $table = 'products';
}