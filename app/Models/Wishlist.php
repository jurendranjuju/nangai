<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;
    public $table = 'wishlist';
    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];
    
    protected $fillable = [
        'user_id',
        'product_id',
        //'deleted_at',
    ];
}
