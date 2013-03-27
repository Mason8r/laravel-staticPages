<?php
use Carbon\Carbon;
class MonitoringSite extends Eloquent {

    protected $table = 'monitoring_sites';
    protected $primaryKey = 'site_id';
    public $timestamps = false;


    public function monitoringUser()
    {
      return $this->belongsTo('MonitoringUser', 'site_user_id');
    }

    public function monitoringKeys()
    {
      return $this->hasMany('MonitoringKey','site_id');
    }

    public static function getUnPayingAndNotIgnoredSites()
    {
    	$ignored = DB::table('ignored')
    		->select('site_id')
    		->get();
    	
    	$ignored_ids = array(0);
    	foreach ($ignored as $e)
    		$ignored_ids[] = $e->site_id;
    	
    	$today = Carbon::today()->toDateString();
    	
		$sites = MonitoringSite::join('monitoring_users', 'monitoring_sites.site_user_id', 
				'=', 'monitoring_users.user_id')
		->where('monitoring_users.start_payment', '>', $today)
		->whereNotIn('site_id', $ignored_ids)
		->get();
		return $sites;
    }
    

    public static function getPayingAndNotIgnoredSites()
    {
    	$today = Carbon::today()->toDateString();
    
    	$ignoredSitesIds = DB::table('ignored')->select('site_id')->get();
    	$iids = array(0);
    	foreach ($ignoredSitesIds as $id) {
    		$iids[] = $id->site_id;
    	}
    	$sites = MonitoringSite::join('monitoring_users', 'monitoring_sites.site_user_id', '=', 'monitoring_users.user_id')
    	->where('monitoring_users.start_payment', '<', $today)
    	->whereNotIn('site_id', $iids)
    	->get();
    
    	return $sites;
    
    }
    
    /*
     * If @$monthly is true - return money from last 31 days
     * else - return money since 1st of current month
     *
     */
    public function getForecast($monthly=false)
    {
      $totalCost = 0;

      $today = Carbon::today()->toDateString();
      if(!$monthly)
        $since =  Carbon::createFromDate(null, null, 1)->toDateString();
      else
        $since = Carbon::now()->subMonth()->toDateString();
	
      $siteId = $this->site_id;
      
      $results = DB::select("SELECT h.position, c.cost, h.year, h.month
		FROM monitoring_history h
		LEFT JOIN monitoring_cost c ON h.key_id = c.key_id
      	WHERE h.site_id = '$siteId'
      	AND	
      	h.position
		BETWEEN c.from
		AND c.to
		AND
      	h.data BETWEEN '$since' AND '$today'
      	");
      
	  foreach ($results as $res)
	  {
			$daysInMonth = cal_days_in_month(CAL_GREGORIAN, intval($res->month), intval($res->year));
			$totalCost = $totalCost + intval($res->cost)/$daysInMonth;
	  }
		
      return round($totalCost,2);
    }

    
    public function getTopTenResult()
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $keywordsInTopTen = 0;

        
        $siteId = $this->site_id;
        $results = DB::select("
        	SELECT COUNT(*) AS count FROM monitoring_history AS h
        	WHERE 
        		h.site_id = '$siteId'
        	AND 
        		data = '$yesterday'
        	AND 
        		h.position BETWEEN 1 AND 10
        		");
        $keywordsInTopTen = intval($results[0]->count);
        
        return array('intt' => $keywordsInTopTen,'all' => $this->monitoringKeys()->count());
    }

}