<?php

namespace App\Queries;

use App\CommunityLink;

class CommunityLinksQuery {

	public function get($category, $orderBy)
	{

		return CommunityLink::with('creator', 'category')
		->withCount('votes')
		->forCategory($category)
		->where('approved', 1)
		->orderBy($orderBy, 'desc')
		->paginate(3);
	}

	
	

}