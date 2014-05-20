<?php
    
class DefaultController extends BaseController {
    protected $layout = "layouts.default";
    
    public function __construct(){
        
    }
    
    public function homeAction($params=NULL){
            $view_data['searchbar'] = View::make('partials.searchbar');
            $this->layout->content =  View::make('default.home',$view_data);
    }
    
    public function searchAction($params=NULL){
        $input = Input::all();
        $searchtext = $input["searchtext"];
        $destinationArray = Destinations::search($searchtext);
        $listingArray = Listings::search($searchtext);
        
        // send combined results to view
        $view_data['results'] = array();
        foreach($destinationArray as $item){
            $view_data['results'][] = array('type'=>'destination', 'value'=>$item);
        }
        foreach($listingArray as $item){
            $view_data['results'][] = array('type'=>'listing', 'value'=>$item);
        }
        // seand search pab partial to view
        $view_data['searchbar'] = View::make('partials.searchbar',array('input'=>$input));
        $this->layout->content = View::make('default.search', $view_data);
    }
    
    public function topSearchAction($params=NULL){
        $listingTerm = NULL;
        $destinationId = NULL;
        $listingType = NULL;
        $input = Input::all();
        if(isset($input ["listingTerm"])){
            $listingTerm = $input ["listingTerm"];
        }   
        if(isset($input ["destinationTerm"])){
           $destinationTerm = $input["destinationTerm"]; 
           $destinationId = Destinations::searchSpecific($destinationTerm);
        }
        if(isset($input["listingType"])){
          $listingType = $input["listingType"];  
        }
        
        $searchQuery = asset(Request::path()).'?'. http_build_query(Input::all());
        Session::flash('backToSearch', $searchQuery);
        
        $result = Listings::searchListingAndDestination($listingTerm, $destinationId, $listingType);
        
//        echo '<pre>'. print_r($result,1) . '</pre>';
//        exit;
                
        
        $view_data['results'] = array();
        
        if($listingTerm || $listingType){
            foreach($result as $item){
                
                $reviewsCount = DB::table('reviews')->where('listings_id', $item->id)->count();
                
                $view_data['results'][] = array('type'=>'listing', 'value'=>$item, 'reviewsCount'=>$reviewsCount);
            }
        }
        else if($destinationId != NULL) {
            return Redirect::to('/destination/'.$destinationId);
        } 
        else {
            return Redirect::back();
        }
        $view_data['searchbar'] = View::make('partials.searchbar',array('input'=>$input));
        $this->layout->content = View::make('default.search', $view_data);
        
    }
    
    public function typeSearch($params=NULL){
        
    }
}

