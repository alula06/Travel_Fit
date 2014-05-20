<?php

class RolesController extends BaseController {

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
            $results = Roles::all();
            
            $this->layout->content =  View::make('roles.list', array('roles'=>$results));
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
            $role = Roles::find($id); //is there a function find in Listings?
        } else {
            $role = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make('roles.detail', array('role' => $role, 'id'=>$id));
    }
    
    public function saveAction($id=NULL){
        
        // VALIDATION
        $rules = array(
            'name' => array('required', 'max:255')
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        if(is_null($id)){
            
            // INSERT
            $role = Roles::create(Input::all());
            if (!$role) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving role')
                        ->withInput();
            }
        } else {
            // UPDATE
            $role = Roles::find($id);
            $updated = $role->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving roles')
                        ->withInput();
            }
        }

        return Redirect::to(asset('roles'))//don't change this
                ->with('flashMessage', 'Roles saved.');
    }
    
    public function deleteAction($id){
        // DELETE
        $role = Roles::find($id);
        if (!$role->delete()) {
            return Redirect::back()
                    ->with('message', 'Something wrong happened while deleting role')
                    ->withInput();
        }

        return Redirect::to(asset('roles'))
            ->with('flashMessage', 'Roles deleted.');
    }
}