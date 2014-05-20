<?php

class Admin_ListingsController extends Admin_BaseController {

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
            $listing = Listings::find($id); //is there a function find in Listings?
        } else {
            $listing = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make('listings.detail', array('listing' => $listing, 'id'=>$id));
    }
    
    public function saveAction($id=NULL){
        
        // VALIDATION
        $rules = array(
            'name' => array('required', 'max:255', 'regex:/^[a-zA-Z]+\s*[a-zA-Z]*\s*[a-zA-Z]*$/'),
            'description' => array('required', 'max:255')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        if(is_null($id)){
            
            // INSERT
            $listing = Listings::create(Input::all());
            if (!$listing) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving listing')
                        ->withInput();
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

        return Redirect::to(asset('listings'))//don't change this
                ->with('flashMessage', 'Listing saved.');
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
    
  
}