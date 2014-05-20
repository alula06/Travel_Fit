<?php

class RegionsController extends BaseController {

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
            $results = Regions::all();
            
            $this->layout->content =  View::make('regions.list', array('regions'=>$results));
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
            $region = Regions::find($id); //is there a function find in Listings?
        } else {
            $region = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make('regions.detail', array('region' => $region, 'id'=>$id));
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
            $region = Regions::create(Input::all());
            if (!$region) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving region')
                        ->withInput();
            }
        } else {
            // UPDATE
            $region = Regions::find($id);
            $updated = $region->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving region')
                        ->withInput();
            }
        }

        return Redirect::to(asset('regions'))//don't change this
                ->with('flashMessage', 'Regions saved.');
    }
    
    public function deleteAction($id){
        // DELETE
        $region = Regions::find($id);
        if (!$region->delete()) {
            return Redirect::back()
                    ->with('message', 'Something wrong happened while deleting region')
                    ->withInput();
        }

        return Redirect::to(asset('regions'))
            ->with('flashMessage', 'Regions deleted.');
    }
}