<?php

class ImagesController extends BaseController {

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
            $results = Images::all();
            
            $this->layout->content =  View::make('images.list', array('images'=>$results));
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
            $image = Images::find($id); //is there a function find in Listings?
        } else {
            $image = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make('images.detail', array('image' => $image, 'id'=>$id));
    }
    
    public function saveAction($id=NULL){
        
        // VALIDATION
        $rules = array(
            'listing_id' => array('required'),
            'review_id' => array('required'),
            'filename' => array('required')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        if(is_null($id)){
            
            // INSERT
            $image = Images::create(Input::all());
            if (!$image) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving image')
                        ->withInput();
            }
        } else {
            // UPDATE
            $image = Images::find($id);
            $updated = $image->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving image')
                        ->withInput();
            }
        }

        return Redirect::to(asset('images'))//don't change this
                ->with('flashMessage', 'Images saved.');
    }
    
    public function deleteAction($id){
        // DELETE
        $image = Images::find($id);
        if (!$image->delete()) {
            return Redirect::back()
                    ->with('message', 'Something wrong happened while deleting image')
                    ->withInput();
        }

        return Redirect::to(asset('images'))
            ->with('flashMessage', 'Images deleted.');
    }
}