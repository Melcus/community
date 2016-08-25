<?php

namespace App\Http\Controllers;

use App\Category;
use App\CommunityLink;
use App\Queries\CommunityLinksQuery;
use Auth;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller

{
	
	public function index(Category $category = null)

	{
		$orderBy = request()->exists('popular') ? 'votes_count' : 'updated_at';

		$links = (new CommunityLinksQuery)->get($category, $orderBy);   // App\Queries\CommunityLinksQuery;   

		$categories = Category::orderby('title', 'asc')->get();

		return view('community.index', compact('links', 'categories', 'category'));
	}

	public function store(Request $request)

	{


		$this->validate($request, [
			'category' =>'required|exists:categories,id',
			'title' => 'required',
					'link' =>'required|active_url', // to make unique, add |unique:community_links
					]);

		$request->user_id = auth::user()->id;

		if($existing = $this->hasAlreadyBeenSubmitted($request->link))
		{

			flashy()->success('That link has already been submitted. We\'ll instead bump the timestamps.');
			$existing->touch();
			return back();


		}
		else
		{
			if(auth::user()->trusted){

				CommunityLink::create([
					'user_id' => $request->user_id,
					'category_id' => $request->category,
					'title' => $request->title,
					'link' => $request->link,
					'approved' =>1
					]);
				flashy()->success('Thanks for the contribution. Your link has been published.');


			}
			else
			{
				CommunityLink::create([
					'user_id' => $request->user_id,
					'category_id' => $request->category,
					'title' => $request->title,
					'link' => $request->link,
					]);
				flashy()->muted('Thanks for the contribution. Your link will be approved shortly.');


			}
		}


		return back();
	}

	protected function hasAlreadyBeenSubmitted($link)

	{
		return CommunityLink::where('link', $link)->first();
	}



}
