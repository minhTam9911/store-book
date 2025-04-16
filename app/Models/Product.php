<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'price',
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'products';
}
