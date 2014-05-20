<?php

class ListingsRatings extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'listings_ratings';
        
        protected $guarded = array('id');
 
        public $timestamps = FALSE;
         
        public function category(){
            return $this->belongsTo('ListingsRatingsCategories', 'listings_ratings_categories_id');
        }
        
}

?>
