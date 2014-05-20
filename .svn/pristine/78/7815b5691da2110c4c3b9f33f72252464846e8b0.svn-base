<?php

class Admin_ReviewsController extends Admin_BaseController {

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
    
    
    public function getAction($id=NULL){
        
        if($id){
            // SHOW ONE USER
            // 1. SQL command
            // Note: if using this method, you must get result with $review[0]
            // since $review will be a collection (array) of results, and you want the 0th element of the array
            //$review = DB::select('select * from users where id = ?', array($id));
            
            // 2. Query Builder
            //$review = User::find($id);
            
            // 3. Eloquent ORM
            $review = Reviews::find($id); //is there a function find in Reviews?
        } else {
            $review = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make('reviews.detail', array('review' => $review, 'id'=>$id));
    }
    
    public function saveAction($id=NULL){
        
        // VALIDATION
        $rules = array(
            'title' => array('required', 'max:255'),
            'review' => array('required', 'max:1000'),
            'rating' => array('required', 'max:5'),
            'photo' => array('required')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        if(is_null($id)){
            
            // INSERT EDIT HERE!!!!
            
            $form_values = Input::all();
            $photo = Input::file('photo');
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
            
            $form_values['photo_id'] = $new_image_max;
            
            $review = Reviews::create($form_values);
            if (!$review) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving review')
                        ->withInput();
            }
        } else {
            // UPDATE
            $review = Reviews::find($id);
            $updated = $review->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving review')
                        ->withInput();
            }
        }

        return Redirect::to(asset('reviews'))//don't change this
                ->with('flashMessage', 'Review saved.');
    }
    
    public function deleteAction($id){
        // DELETE
        $review = Reviews::find($id);
        if (!$review->delete()) {
            return Redirect::back()
                    ->with('message', 'Something wrong happened while deleting review')
                    ->withInput();
        }

        return Redirect::to(asset('reviews'))
            ->with('flashMessage', 'Reviews deleted.');
    }
    
    public function saveReviewAction($id=NULL){
        
        // VALIDATION
        $rules = array(
            'title' => array('required', 'max:255'),
            'review' => array('required', 'max:1000'),
            'rating' => array('required', 'max:5'),
            'photo' => array('required')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
         if(is_null($id)){
            
            // INSERT
            $review = Reviews::create(Input::all());
            if (!$review) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving review')
                        ->withInput();
            }
        } else {
            // UPDATE
            $review = Reviews::find($id);
            $updated = $review->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving review')
                        ->withInput();
            }
        }

    }

            
    
            }
            