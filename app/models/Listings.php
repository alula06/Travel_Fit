<?php


class Listings extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'listings';
        
        protected $guarded = array('id','ratingCategories','photo');
        
        public static $allStates = array(
                                        ''=>'Select One',
                                        'AL'=>"Alabama",
                                        'AK'=>"Alaska",
                                        'AZ'=>"Arizona",
                                        'AR'=>"Arkansas",
                                        'CA'=>"California",
                                        'CO'=>"Colorado",
                                        'CT'=>"Connecticut",
                                        'DE'=>"Delaware",
                                        'DC'=>"District Of Columbia",
                                        'FL'=>"Florida",
                                        'GA'=>"Georgia",
                                        'HI'=>"Hawaii",
                                        'ID'=>"Idaho",
                                        'IL'=>"Illinois",
                                        'IN'=>"Indiana",
                                        'IA'=>"Iowa",
                                        'KS'=>"Kansas",
                                        'KY'=>"Kentucky",
                                        'LA'=>"Louisiana",
                                        'ME'=>"Maine",
                                        'MD'=>"Maryland",
                                        'MA'=>"Massachusetts",
                                        'MI'=>"Michigan",
                                        'MN'=>"Minnesota",
                                        'MS'=>"Mississippi",
                                        'MO'=>"Missouri",
                                        'MT'=>"Montana",
                                        'NE'=>"Nebraska",
                                        'NV'=>"Nevada",
                                        'NH'=>"New Hampshire",
                                        'NJ'=>"New Jersey",
                                        'NM'=>"New Mexico",
                                        'NY'=>"New York",
                                        'NC'=>"North Carolina",
                                        'ND'=>"North Dakota",
                                        'OH'=>"Ohio",
                                        'OK'=>"Oklahoma",
                                        'OR'=>"Oregon",
                                        'PA'=>"Pennsylvania",
                                        'RI'=>"Rhode Island",
                                        'SC'=>"South Carolina",
                                        'SD'=>"South Dakota",
                                        'TN'=>"Tennessee",
                                        'TX'=>"Texas",
                                        'UT'=>"Utah",
                                        'VT'=>"Vermont",
                                        'VA'=>"Virginia",
                                        'WA'=>"Washington",
                                        'WV'=>"West Virginia",
                                        'WI'=>"Wisconsin",
                                        'WY'=>"Wyoming",
                                           );
        
        public static function search($term = '') {
                    return DB::table('listings')
                            ->where('name', 'LIKE', '%'.$term.'%')
                            ->orWhere('type', 'LIKE', '%'.$term.'%')->get();

                    
//1 search listing, 2 listing + dest 3. destin from drop down box.
        }
        
        public static function searchListingAndDestination($listingTerm = NULL, $destinationId = NULL, $listingType = NULL, $orderByName = array("name" => "ASC")){
            $query = DB::table('listings');
            
             //$query->leftJoin('listings_ratings', 'listings.id', '=', 'listings_ratings.listings_id')->where('listings_ratings.listings_ratings_categories_id',1);
             
            if($listingTerm){
                $query->where('listings.name', 'LIKE', '%'.$listingTerm.'%')->orWhere('listings.type', 'LIKE', '%'.$listingTerm.'%');
                
                if($destinationId){
                    $query->having('listings.destinations_id','=', $destinationId);
                }
            }
            
            if($listingType){
                $query->where('listings.type', 'LIKE', '%'.$listingType.'%');
            }
            
            // order by
            $query->orderBy("overall_rating", "DESC"); 
            
            foreach ($orderByName as $key => $value) {
                $query->orderBy($key, $value);                     
            }
            
            //$query->select('listings.*','listings_ratings.value as overall_rating');
            
            $results = array();
            $listings = $query->get();
            foreach($results as $listing){
                
            }
            
            return $query->get();
            
            
        }
           
        public static function getTopListingsByType($destinations_id, $type, $num){
            return DB::table('listings')->where('type', '=', $type)->where('destinations_id', '=', $destinations_id)->take($num)->get();
        }
        
        public function images(){
            return $this->belongsToMany('Images', 'listings_images');
        }
        
        public function ratings(){
            return $this->hasMany('ListingsRatings');
        }
        
        public function destination(){
            return $this->belongsTo('Destinations', 'destinations_id');
        }
        
        public function getOverallRating(){
            return $this->ratings()->where('listings_ratings_categories_id',1)->first();
        }
        public function getHealthyRating(){
            return $this->ratings()->where('listings_ratings_categories_id',2)->first();
        }
}
