<?php

namespace App;

use App\CommunityLink;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    

      public function votes() // $user->votes
    {
        return $this->belongsToMany(CommunityLink::class, 'community_links_votes')
        ->withTimestamps();
    }

    /*
    Vote Up
     */
    public function voteFor(CommunityLink $link)
    {
      return $this->votes()->sync([$link->id], false);  // or attach($link);  instead of sync
    }

    // /**
    //  * Vote Down  - Not needed, using toggle
        
    // */
    // public function unvoteFor(CommunityLink $link)
    // {
    //      return $this->votes()->detach($link);
    //  }

    public function votedFor(CommunityLink $link)
    {
        return $link->votes->contains('user_id', $this->id);
        
    }

  
}
