<?php

class BaseController extends Controller {

        protected $signedInUser;
        protected $value;
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
            $layout_vars['environment'] = App::environment();
            $layout_vars['user'] = NULL;
            $inputs = Input::all();
            
            $layout_vars['searchListing'] = (isset($inputs['listingTerm']))?$inputs['listingTerm']:'';
            $layout_vars['searchDestination'] = (isset($inputs['destinationTerm']))?$inputs['destinationTerm']:'';
            
            if(isset($_SERVER['REDIRECT_USER'])){
                $layout_vars['user'] = $_SERVER['REDIRECT_USER'];
            }
            $layout_vars['flashMessage'] = Session::get('flashMessage', NULL);
            
            // share $signedIn across all views
            if (Auth::check()){
                $signedIn = true;
                $id = Auth::user()->id;
            } else {
                $signedIn = false;
                $id=NULL;
            }
            View::share('signedIn', $signedIn);
            
            if(Session::has('backToSearch')){
                $backToSearch = Session::get('backToSearch');
                View::share('backToSearch', $backToSearch);
            }
            
            
            // share $signedInUser across all views
            $signedInUser = $signedIn ? Auth::user() : NULL;
            if($signedIn){
                // share among all views
                View::share('signedInUser', $signedInUser);
                // share among all child Controllers
                $this->signedInUser = $signedInUser;
            }

            // 
            if ( ! is_null($this->layout)) {
                $this->layout = View::make($this->layout, $layout_vars);

            }
	}

}