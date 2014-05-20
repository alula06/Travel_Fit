<?php


class Destinations extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'destinations';
        
        protected $guarded = array('id','photo');

        public static function search($term = '') {
                return DB::table('destinations')
                        ->where('name', 'LIKE', '%'.$term.'%')
                        ->orWhere('description', 'LIKE', '%'.$term.'%')->get();
        }
        
        public static function searchSpecific($term = ''){
            $query = DB::table('destinations')->where('name','=', $term)->pluck('id');
            return $query;
        }
        
        public static function searchName($term = '') {
                return DB::table('destinations')
                            ->where('name','LIKE','%'.$term.'%')->get();
        }
        
        public static function searchByCity($city,$state){
            $query = DB::table('destinations');
            $query->whereRaw("UPPER(name) = '". strtoupper($city)."'");
            $query->where('state',$state);
            //echo $query->toSQL();
            return $query->first();
        }
}
