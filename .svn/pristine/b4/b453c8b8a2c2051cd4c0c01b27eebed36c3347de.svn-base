<?php

class RatingsController extends BaseController {

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
            $results = Ratings::all();
            
            $this->layout->content =  View::make('ratings.list', array('ratings'=>$results));
    }
    
    
    public function getAction($id=NULL){
        
        if($id){
            // SHOW ONE USER
            // 1. SQL command
            // Note: if using this method, you must get result with $listing[0]
            // since $listing will be a collection (array) of results, and you want the 0th element of the array
            //$listing = DB::select('select * from users where id = ?', array($id));
            
            // 2. Query Builder
            //$listing = User::find($id);
            
            // 3. Eloquent ORM
            $rating = Ratings::find($id); //is there a function find in Listings?
        } else {
            $rating = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make('ratings.detail', array('rating' => $rating, 'id'=>$id));
    }
    
    public function saveAction($id=NULL){
        
        // VALIDATION
        $rules = array(
            'rating_category_id' => array('required'),
            'value' => array('required'),
            'user_id' => array('required'),
            'review_id' => array('required'),
            'listing_id' => array('required')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        if(is_null($id)){
            
            // INSERT
            $rating = Ratings::create(Input::all());
            if (!$rating) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving rating')
                        ->withInput();
            }
        } else {
            // UPDATE
            $rating = Ratings::find($id);
            $updated = $rating->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving rating')
                        ->withInput();
            }
        }

        return Redirect::to(asset('ratings'))//don't change this
                ->with('flashMessage', 'Ratings saved.');
    }
    
    public function deleteAction($id){
        // DELETE
        $rating = Ratings::find($id);
        if (!$rating->delete()) {
            return Redirect::back()
                    ->with('message', 'Something wrong happened while deleting rating')
                    ->withInput();
        }

        return Redirect::to(asset('ratings'))
            ->with('flashMessage', 'Ratings deleted.');
    }
}