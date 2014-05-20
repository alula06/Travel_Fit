<?php

class UserController extends BaseController {

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
            $results = User::all();
            
            $this->layout->content =  View::make('user.list', array('users'=>$results));
    }
    
    
    public function getAction($id=NULL){
        
        if (Auth::check()) {
            $id = Auth::user()->id;
        } else {
            $id = NULL;
        }
        
        if($id){
            // SHOW ONE USER
            // 1. SQL command
            // Note: if using this method, you must get result with $user[0]
            // since $user will be a collection (array) of results, and you want the 0th element of the array
            //$user = DB::select('select * from users where id = ?', array($id));
            
            // 2. Query Builder
            //$user = User::find($id);
            
            // 3. Eloquent ORM
            $user = User::find($id);
        } else {
            $user = NULL;
        }  
         
        //Session::flash('flashMessage', 'USER VIEWED');
        $this->layout->content =  View::make(is_null($user)?'user.register':'user.detail', array('user' => $user, 'id'=>$id));
    }
    
    public function saveAction($id=NULL){
        
        // VALIDATION
        //I added validation for firstname, lastname, and email! Rob Moon.
        //is there a way to hide user input for password as the type?
        $rules = array(
            'firstname' => array('required', 'max:255','regex:/^[a-zA-Z]+$/'),
            'lastname' => array('required', 'max:255','regex:/^[a-zA-Z]+$/'),
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|AlphaNum|min:6|max:60'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to(Request::path())->withErrors($validator)->withInput();
        }
        
        // if validation passes, save to DB
        if(is_null($id)){
            // INSERT A NEW USER INTO DB
            $user = User::create(Input::all());
            $formPost = Input::all();
            $unencrypted = $formPost['password'];
            $encrypted = Hash::make($unencrypted);
            $user->password = $encrypted;
            $user->save();
            if (!$user) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving user')
                        ->withInput();
            }
        } else {
            // UPDATE AN EXISTING USER IN DB
            $user = User::find($id);
            $updated = $user->update(Input::all());
            $formPost = Input::all();
            $unencrypted = $formPost['password'];
            $encrypted = Hash::make($unencrypted);
            $user->password = $encrypted;
            $user->save();
            if (!$updated || !$user) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving user')
                        ->withInput();
            }
        }

        return Redirect::to(asset('/'))
                ->with('flashMessage', 'User saved.');
    }
    
    public function deleteAction($id){
        // DELETE
        $user = User::find($id);
        if (!$user->delete()) {
            return Redirect::back()
                    ->with('message', 'Something wrong happened while deleting user')
                    ->withInput();
        }

        return Redirect::to(asset('/'))
            ->with('flashMessage', 'User deleted.');
    }
    
    public function loginAction(){
        $input = Input::all();
        
        $rules = array(
            'email' => array('required', 'max:255', 'email'),
            'password' => array('required', 'max:60')
        );
        
        $validator = Validator::make($input, $rules);
        if ($validator->fails())
        {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }
        
        $credentials = array('email' => $input['email'], 'password' => $input['password']);
        if(Auth::attempt($credentials)){
            return  Redirect::back()
                    ->with('flashMessage', 'Login Successful');
        } else {
            return Redirect::back()
                ->with('flashMessage', 'Login Failed')
                ->withInput();
        }
    }
    
    public function logoutAction(){
        Auth::logout();
        return Redirect::to(asset('/'))
                ->with('flashMessage', 'Logout Successful');;
    }
}