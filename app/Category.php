<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{

	use Searchable;
    protected $fillable = ['title', 'slug', 'color'];



    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function toSearchableArray()
    {
    	
    	return [
    	'title' => $this->title,
    	'slug'  => $this->slug
    	];
    }
}
