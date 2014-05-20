<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersRatings
 *
 * @author odrulea
 */
class UsersRatings extends Eloquent{
    //put your code here
    protected $table = 'users_ratings';
        
    protected $guarded = array('id');
    
    
    public static function getListingUserRatings($listing_id, $user_id){
        $query = DB::table('users_ratings');
        $query->where('users_id',$user_id)->where('listings_id',$listing_id);
        //$query->where()
        return $query->get();
    }
    
    public function listingRating(){
        return $this->belongsTo('ListingsRatings', 'listings_ratings_id');
    }
}

?>
