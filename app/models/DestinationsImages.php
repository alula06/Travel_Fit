<?php


class DestinationsImages extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'destinations_images';
        
        protected $guarded = array('id');
        
        public function image(){
            return $this->belongsTo('Images', 'images_id');
        }
               
}