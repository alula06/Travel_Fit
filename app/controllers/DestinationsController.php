<?php

class DestinationsController extends BaseController {

    protected $layout = "layouts.default";

    public function __construct(){
        
    }
    
    public function getAction($id){
        
        // get destination from db
        $destination = Destinations::find($id);
        $listings = Listings::where('destinations_id', $destination->id)->get();
        
        $view_data = array(
            'destination' => $destination, 
            'id'=>$id, 
            'listings'=>$listings
                );
        
        //get images
        $view_data['images'] = DestinationsImages::where('destinations_id', $id)->get();
        
        
        $view_data['top_gyms'] = Listings::getTopListingsByType($destination->id, 'gym', 3);
        $view_data['top_foods'] = Listings::getTopListingsByType($destination->id, 'eatery', 3);
        $view_data['top_outdoors'] = Listings::getTopListingsByType($destination->id, 'outdoor', 3);
        $view_data['top_sports'] = Listings::getTopListingsByType($destination->id, 'sports', 3);
        
        $this->layout->content =  View::make('destinations.detail', $view_data);
    }
    
    public function searchAction()
    {
        $input = Input::all();
        $term = $input["destinationTerm"];
        $destinations = Destinations::searchName($term);
        $results = array();
        foreach($destinations as $destination)
        {
            $results[] = array('name' => $destination->name, 'id' => $destination->id);
        }
        $returnArray = array('results' => $results);
        return json_encode($returnArray);
    }
    
    
    public function saveAction($id=NULL){
        
        $inputs = Input::all();
        
        
        // VALIDATION
        $rules = array(
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
            $destination = Destinations::create($inputs);    
            
        } else {
            
            // UPDATE
            $destination = Destinations::find($id);
            $updated = $destination->update(Input::all());
            if (!$updated) {
                return Redirect::back()
                        ->with('message', 'Something wrong happened while saving listing')
                        ->withInput();
            }
        }
        
        
        
        // HANDLE PHOTO UPLOAD
        if($destination && Input::hasFile('photo')){

            $photo = Input::file('photo');

            //save image to database
            $imageParams = array(
                'filetype' => $photo->getClientOriginalExtension(),
                'filepath' => '/destinations/',
                'user_id' => $this->signedInUser->id
            );

            $image = Images::create($imageParams);

            //save image to file system
            $destinationPath = public_path(). '/images/destinations/';
            $photo->move($destinationPath, $image->id . '.' . $imageParams['filetype']);

            // associate image with destination
            $destinationImage = $image->destinations()->attach($destination->id);


        }
                

        if($destination){
            return Redirect::to(asset('destination/'.$destination->id))
                ->with('flashMessage', 'Destination saved.');
        }
    }
    
    
}