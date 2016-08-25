<?php

namespace App;

use App\CommunityLink;
use Illuminate\Database\Eloquent\Model;

class CommunityLinkVote extends Model
{
   protected $table = 'community_links_votes';

   protected $fillable = ['user_id', 'community_link_id'];

   

  
}
