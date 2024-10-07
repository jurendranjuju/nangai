<?php

namespace App;
use Kirschbaum\PowerJoins\PowerJoins;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Continent;

class Course extends Model
{
    //use SoftDeletes;
    use PowerJoins;
    public $table = 'product';

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at',
        //'deleted_at',
    ];


    public function categoryinfos() {
    	return $this->belongsTo('App\Category','category_id');
    }

    public function wishlistedByUsers()
   {
       return $this->belongsToMany(User::class, 'wishlists');
    }

   
}
