<?php

namespace App\Http\Controllers;

use App\CommunityLink;
use App\Http\Requests;
use Illuminate\Http\Request;

class VotesController extends Controller
{
	

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function store(CommunityLink $link)
    {


   
	    ////////////
    	//old way //
	    ////////////
	    
    	// $toggleVoteFor= $user->votedFor($link) ? 'unvoteFor' : 'voteFor';
    	// $user->$toggleVoteFor($link);
    	
    	
	    //////////////////
    	//Another metod //
	    //////////////////

    	// $vote = CommunityLinkVote::firstOrNew([
    	// 	'user_id' =>auth()->id,
    	// 	'community_link_id' => $link->id

    	// 	]);
    	// if ( $vote->exists) {
    	// 	$vote->delete();
    	// }
    	// else
    	// {
    	// 	$vote->save();
    	// }


    	auth()->user()->votes()->toggle($link); // 5.3 way 


    	return back();
    }


}
