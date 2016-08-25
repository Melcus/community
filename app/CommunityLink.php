<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    

	protected $fillable =['category_id', 'title', 'link', 'user_id', 'approved'];


    public function creator()

    {
    	return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Community Link -> Category Relationship
     * 
     */
    public function category()

    {
    	return $this->belongsTo(Category::class);
    }


/**
     * A community link has many votes
     * @return relationship
     */
    public function votes()
    {
    	return $this->hasmany(CommunityLinkVote::class, 'community_link_id');
    }
    /**
     * [Scope the query to records from a particular category ]
     * @param  [Builder] $builder  
     * @param  [Category] $category 
     * @return [Builder]           
     */
    public function scopeForCategory($builder, $category)
    {
    	if($category->exists) {
    		return $builder->where('category_id', $category->id);
    	}

    	return $builder;
    }

    


}
