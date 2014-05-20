<?php


class Images extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'images';
        
        protected $guarded = array('id');
               
        public function reviews(){
            return $this->belongsToMany('Reviews', 'reviews_images');
        }
        
        public function listings(){
            return $this->belongsToMany('Listings', 'listings_images');
        }
        
        public function destinations(){
            return $this->belongsToMany('Destinations', 'destinations_images');
        }
}