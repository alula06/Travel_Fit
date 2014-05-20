<?php

class ListingsController extends BaseController {

    protected $layout = "layouts.default";

    
    public function __construct(){
        
    }
        
    public function listAction($params=NULL){
            // SHOW ALL USERS
            // 1. SQL command
            // $results = DB::select('select * from users');
        
            // 2. Query Builder
            //
        
            // 3. Eloquent ORM
            $results = Listings::all();
            
            $this->layout->content =  View::make('listings.list', array('listings'=>$results));
    }
    
    public function newAction(){
        $data = array();
        $data['listing'] = NULL;
        
        if(!is_null($this->signedInUser)){
           $data['allTypes'] = array(
               'gym'=>'Gym',
               'eatery'=>'Eatery',
               'outdoors'=>'Outdoors',
               'sports'=>'Sports'
               ); 
           
           $data['allStates'] = Listings::$allStates;
           
           $data['allRatingCategories'] = ListingsRatingsCategories::all();
           //Session::flash('flashMessage', 'USER VIEWED');
            $this->layout->content =  View::make('listings.edit', $data);
        } else {
            $this->layout->content =  View::make('default.signin');
        }
         
        
    }
    
    
    
    
    public function getAction($id=NULL){
        
        if($id){
            //get the listing
            $listing = Listings::find($id); //is there a function find in Listings?
            //get all reviews
            $reviews = Reviews::where('listings_id',$id)->get();
            //get user's review
            $userReview = NULL;
            if(!is_null($this->signedInUser)){
                $userReview = Reviews::where('listings_id',$id)->where('user_id', $this->signedInUser->id)->first();
            }
            $count = Reviews::where('listings_id', $id)->count();
            
            //get images
            $images = ListingsImages::where('listings_id', $id)->get();
            
            // HACK
            // if we don't have the 4 basic rating categories for the listing yet, add them on the fly
            $defaultRatingCategories = array(1=>true,2=>true,3=>true,4=>true);
            foreach($listing->ratings as $rating){
                //echo '<h1> checking: '.$rating->listings_ratings_categories_id.'</h1>';
                $defaultRatingCategories[$rating->listings_ratings_categories_id] = false;
                
            }
            // any left standing, get added on the fly
            foreach ($defaultRatingCategories as $category_id=>$add){
                if($add){
                    // create the rating category
                    ListingsRatings::create(
                                    array(
                                        'listings_id'=>$listing->id,
                                        'listings_ratings_categories_id'=>$category_id
                                        )
                                  );
                }
            }
            //echo '<h1>cats to add: '.print_r($defaultRatingCategories,1) . '</h1>';
            
        } else {
            $listing = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make('listings.detail', array('listing' => $listing, 'id'=>$id, 'reviews' => $reviews, 'count' => $count, 'userReview' => $userReview, 'images' =>$images));
    }
    
    public function saveAction($id=NULL){
        
        $inputs = Input::all();
        
        
        // VALIDATION
        $rules = array(
            'name' => array('required', 'max:255'),
            'type' => array('required'),
            'state' => array('required')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        if(is_null($id)){
            
            // if a city was added, use it to create a new Destinations record
            if(isset($inputs['city']) && strlen($inputs['city']) ){
                
                // see if this destination already exists....
                $destination = Destinations::searchByCity($inputs['city'],$inputs['state']);
                if(!$destination){
                    // if this destination doesn't exist yet, create it now on the fly
                    $destination = Destinations::create(array('name'=>$inputs['city'],'state'=>$inputs['state']));
                }
                
                // add destination id to inputs array so we can create listing record with it
                $inputs['destinations_id'] = $destination->id;

            }
            
            
            // INSERT
            $listing = Listings::create($inputs);
            
            
            
            if (!$listing) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving listing')
                        ->withInput();
            } else {
                // listing created successfully
                
                // attach relationships
                // create 2 new listings_ratings, 
                // each associated with the 2 default ratings categories
                
                // overall_rating
                ListingsRatings::create(
                                    array(
                                        'listings_id'=>$listing->id,
                                        'listings_ratings_categories_id'=>1
                                        )
                                  );
                // healthy_rating
                ListingsRatings::create(
                                    array(
                                        'listings_id'=>$listing->id,
                                        'listings_ratings_categories_id'=>2
                                        )
                                  );
                // ambience
                ListingsRatings::create(
                                    array(
                                        'listings_id'=>$listing->id,
                                        'listings_ratings_categories_id'=>3
                                        )
                                  );
                // value
                ListingsRatings::create(
                                    array(
                                        'listings_id'=>$listing->id,
                                        'listings_ratings_categories_id'=>4
                                        )
                                  );
                
                if(isset($inputs['ratingCategories']) && count($inputs['ratingCategories']) ){
                    foreach($inputs['ratingCategories'] as $ratingCategoryId){
                        ListingsRatings::create(
                                    array(
                                        'listings_id'=>$listing->id,
                                        'listings_ratings_categories_id'=>$ratingCategoryId
                                        )
                                  );
                    }
                }
                
                
                // HANDLE PHOTO UPLOAD
                if(Input::hasFile('photo')){
                
                    $photo = Input::file('photo');

                    //save image to database
                    $imageParams = array(
                        'filetype' => $photo->getClientOriginalExtension(),
                        'filepath' => '/listings/',
                        'user_id' => $this->signedInUser->id
                    );

                    $image = Images::create($imageParams);

                    //save image to file system
                    $destinationPath = public_path(). '/images/listings/';
                    $photo->move($destinationPath, $image->id . '.' . $imageParams['filetype']);

    //                $reviewImageParams = array(
    //                    'review_id' => $review->id,
    //                    'image_id' => $image->id
    //                );

                        //Images::create($reviewImageParams);

//                    $reviewImage = $userReview->images()->attach($image->id);

    //                $listingsImageParams = array(
    //                    'listing_id' => $form_values['listings_id'],
    //                    'image_id' => $image->id
    //                );
    //                
                    //$listingImage = ListingsImages::create($listingsImageParams);
                    
                    // associate image with listing
                     $listingImage = $image->listings()->attach($listing->id);


                }
                
                
            }
            
            
        } else {
            // UPDATE
            $listing = Listings::find($id);
            $updated = $listing->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving listing')
                        ->withInput();
            }
        }

        if($listing){
            return Redirect::to(asset('listing/'.$listing->id))//don't change this
                ->with('flashMessage', 'Listing saved.');
        }
    }
    
    public function deleteAction($id){
        // DELETE
        $listing = Listings::find($id);
        if (!$listing->delete()) {
            return Redirect::back()
                    ->with('message', 'Something wrong happened while deleting user')
                    ->withInput();
        }

        return Redirect::to(asset('listings'))
            ->with('flashMessage', 'Listings deleted.');
    }
    
    public function getRatingsAction($listing_id){
        $data = array();
        
        $listing = Listings::find($listing_id);
        
        if(!is_null($this->signedInUser)){
            $allUserRatings = UsersRatings::getListingUserRatings($listing_id, $this->signedInUser->id);
            
            // rekey user ratings off of listings_ratings_id field, so we can easily map it to listings_ratings
            $keyedUserRatings = array();
            foreach($allUserRatings as $userRating){
                $keyedUserRatings[$userRating->listings_ratings_id] = $userRating;
            }
            $data['userRatings'] = $keyedUserRatings;
        }
        
        $data['listing'] = $listing;
        $this->layout->content =  View::make('listings.rate', $data);
    }
    
    public function saveRatingsAction($listing_id){
        
        $listing = Listings::find($listing_id);
        
        $inputs = Input::all();
        
        
        
        if(isset($inputs['listing_ratings']) && is_array($inputs['listing_ratings'])){
            
            foreach($inputs['listing_ratings'] as $listings_ratings_id=>$user_value){
            
                // user entered a rating value
                if($user_value){
                    // save user rating value
                    $listing_rating = ListingsRatings::find($listings_ratings_id);
                    
                    $userRating = UsersRatings::where('users_id',$this->signedInUser->id)->where('listings_id',$listing_id)->where('listings_ratings_id',$listings_ratings_id)->get()->first();
                    
                    if($userRating){
                        // UPDATE EXISTING
                        $old_user_value = $userRating->value;
                        $userRating->update(
                                    array(
                                        'value'=>$user_value
                                        )
                                  );
                        $insert = false;
                        
                    } else {
                        // INSERT NEW
                        UsersRatings::create(
                                    array(
                                        'users_id'=>$this->signedInUser->id,
                                        'listings_id'=>$listing->id,
                                        'listings_ratings_id'=>$listings_ratings_id,
                                        'value'=>$user_value
                                        )
                                  );
                        $insert=true;
                        $old_user_value = 0;
                        
                    }
                    
                    // CALCULATE NEW RATING AVERAGE
                    $count = DB::table('users_ratings')->where('listings_id', '=', $listing_id)->where('listings_ratings_id', '=', $listings_ratings_id)->count();
                    // update total rating
                    if($insert || is_null($listing_rating->num_ratings) || $listing_rating->num_ratings < 1){
                        $count=1;
                        $listing_rating->num_ratings = $count;
                    }
                    
                    /** HERE NEED LOGIC FOR NEW AVERAGE **/
                    
                    $sum = DB::table('users_ratings')->where('listings_id', '=', $listing_id)->where('listings_ratings_id', '=', $listings_ratings_id)->sum('value');
                    
                    $sum = $sum - $old_user_value;
                    $sum = $sum + $user_value;
                    
                    $listing_rating->value = $sum/$count;
                    /** **/
                    $listing_rating->save();
                    
                    switch($listing_rating->listings_ratings_categories_id){
                        case 1:
                            // overall rating, save to listing as well
                            $listing->overall_rating = $sum/$count;
                            $listing_save = TRUE;
                            break;
                        case 2:
                            // healthy rating, save to listing as well
                            $listing->healthy_rating = $sum/$count;
                            $listing_save = TRUE;
                            break;
                        default:
                            $listing_save = FALSE;
                    }
                    // if we change the 2 major ratings on listing, update that record
                    if($listing_save){
                        $listing->save();
                    }
                    
                }
            }
        }
        

        
        return Redirect::to(asset('listing/'.$listing_id))
            ->with('flashMessage', 'Ratings saved.');
    }
    
}