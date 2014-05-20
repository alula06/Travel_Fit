<?php


class Reviews extends Eloquent { //class name should be singular!!

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reviews';
        
        protected $guarded = array('id', 'photo');
                       
        public function images(){
            return $this->belongsToMany('Images', 'reviews_images');
        }
        
        public function user(){
            return $this->belongsTo('User','user_id');
        }
        
        public function searchListing($id = ''){
            return DB::table('reviews')->where('id', '=', $id )->pluck('listings_id');
        }
}