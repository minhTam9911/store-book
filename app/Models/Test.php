<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';
    public $fillable = [
        'products',
        
    ];
    public $timestamps = false;
    protected $primaryKey = 'id';
    
}
