<?php

class ReviewsController extends BaseController {

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
            $results = Reviews::all();
            
            $this->layout->content =  View::make('reviews.list', array('reviews'=>$results));
    }
    
    
    public function getAction($listing_id=NULL){
        $data['review'] = NULL;
        $data['listing'] = NULL;
        
        $data['input'] = Input::all();
        
        $data['searchbar'] = View::make('partials.searchbar');
        
        if($listing_id){
            $data['listing'] = Listings::find($listing_id);
            if(!is_null($this->signedInUser)){
                $data['review'] = Reviews::where('listings_id',$listing_id)->where('user_id', $this->signedInUser->id)->first();
            }
        }
        
        $this->layout->content =  View::make('reviews.detail', $data);
    }
    
    public function saveAction($listing_id){        
        if(!is_null($this->signedInUser)){
                $userReview = Reviews::where('listings_id',$listing_id)->where('user_id', $this->signedInUser->id)->first();
            } else{
                return Redirect::back()
                        ->with('message', 'Please sign in or register to write a review.')
                        ->withInput();
            }
        // VALIDATION
        $rules = array(
            'title' => array('required', 'max:255'),
            'review' => array('required', 'max:1000'),
            //'overall_rating' => array('required', 'max:5', 'min:1'),
            //'healthy_rating'=> array('required', 'max:5', 'min:1')
            'photo' => array('mimes:jpeg,jpg,bmp,gif,png')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        
            
            // INSERT EDIT HERE!!!!
            
            $form_values = Input::all();
             
            //$photo = Input::get('photo');
          //file = Reviews_Images::create($photo);
            $destinationPath = public_path(). '/images/listings/';

            if(is_null($userReview)){
                //INSERT
                $userReview = Reviews::create($form_values);
                
                $userReview->user_id = $this->signedInUser->id;
                $userReview->save();
            } else {
                //UPDATE
                $updated = $userReview->update($form_values);
            }
            
            
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
                $photo->move($destinationPath, $image->id . '.' . $imageParams['filetype']);
                
//                $reviewImageParams = array(
//                    'review_id' => $review->id,
//                    'image_id' => $image->id
//                );
                
                $reviewImage = $userReview->images()->attach($image->id);

                    //Images::create($reviewImageParams);
                
//                $listingsImageParams = array(
//                    'listing_id' => $form_values['listings_id'],
//                    'image_id' => $image->id
//                );
//                
                 $listingImage = $image->listings()->attach($form_values['listings_id']);
                 
                //$listingImage = ListingsImages::create($listingsImageParams);
                
            }
            
            // $photo is now an object of type : Symfony\Component\HttpFoundation\File\UploadedFile
            // example of how to save this image to the file system
            //$photo->move("/public/images/reviews/123.png");
            // the followign methods are available to you
            // ->getRealPath();
            // /tmp/2948712937192831892b/photo.png
            // ->getClientOriginalName(); not so imp
            // photo.png, tomandcathyswedding.png
            // ->getClientOriginalExtension(); very imp!!
            // png gif jpg
            
            // $current_max_listing_image_id = get this from db // SELECT MAX(image_id_ FROM listings_images) - all sql must be in reviews model
            // $new_image_max = $current_max_listing_image_id + 1;
            // INSERT INTO reviews_images image_id = $new_image_max
            // save image to file system: 
            ////$photo->move("/public/images/reviews/" . $new_image_max . "." . $photo->getClientOriginalExtension());
            
            //$form_values['photo_id'] = $new_image_max;
            
            //$review = Reviews::create($form_values);            
            if (!$userReview) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving review')
                        ->withInput();
            }
        
        //return Redirect::to(asset('reviews'))//don't change this
        return Redirect::to('/listing/'. $form_values["listings_id"])
                ->with('flashMessage', 'Review saved.');
    }
    
    public function deleteAction($id){
        // DELETE
        $review = Reviews::find($id);
        if(!is_null($review) && !is_null($this->signedInUser) && $this->signedInUser->id){
            
            if($this->signedInUser->id != $review->user_id){
                return Redirect::to(asset('/'));
            }
            
            // getlisting id from review
            $listing_id = $review->listings_id;
            // delete review
            $review->delete();
            
            // return to listing page
             return Redirect::to(asset('/listing/'.$listing_id))->with('flashMessage', 'Review deleted.');
        }
     }
}
            