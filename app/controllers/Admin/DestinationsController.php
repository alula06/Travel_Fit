<?php

class Admin_DestinationsController extends Admin_BaseController {

    protected $layout = "layouts.default";

    public function __construct(){
        
    }
        
    public function listAction($params=NULL){
        $this->checkLogin();
            // SHOW ALL USERS
            // 1. SQL command
            // $results = DB::select('select * from users');
        
            // 2. Query Builder
            //
        
            // 3. Eloquent ORM
            $results = Destinations::all();
            
            $this->layout->content =  View::make('admin.destinations.list', array('destinations'=>$results));
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
            $destination = Destinations::find($id); //is there a function find in Listings?
        } else {
            $destination = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make('admin.destinations.detail', array('destination' => $destination, 'id'=>$id));
    }
    
    public function saveAction($id=NULL){
        
        // VALIDATION
        $rules = array(
            'name' => array('required'),
            'parent_id' => array('required'),
            'lat' => array('required'),
            'lng' => array('required'),
            'description' => array('required')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        if(is_null($id)){
            
            // INSERT
            $destination = Destinations::create(Input::all());
            if (!$destination) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving destination')
                        ->withInput();
            }
        } else {
            // UPDATE
            $destination = Destinations::find($id);
            $updated = $destination->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving destination')
                        ->withInput();
            }
        }

        return Redirect::to(asset('admin/destinations'))//don't change this
                ->with('flashMessage', 'Destinations saved.');
    }
    
    public function deleteAction($id){
        // DELETE
        $destination = Destinations::find($id);
        if (!$destination->delete()) {
            return Redirect::back()
                    ->with('message', 'Something wrong happened while deleting destination')
                    ->withInput();
        }

        return Redirect::to(asset('admin/destinations'))
            ->with('flashMessage', 'Destinations deleted.');
    }
}