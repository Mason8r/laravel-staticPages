<?php
use Carbon\Carbon;

class RepportController extends BaseController {

	public function generate()
	{
		$today = Carbon::today()->toDateString();

		if (!File::exists('downloads/'.$today))
			File::makeDirectory('downloads/'.$today);

		//generateForecast
		$sites = MonitoringSite::getUnPayingAndNotIgnoredSites();

		$forecast = View::make('index', array('sites' => $sites))->render();
		File::put('downloads/'.$today.'/prognoza.html', $forecast);

		//generate stats
		$sites = MonitoringSite::getPayingAndNotIgnoredSites();
		$stats = View::make('stats', array('sites'=>$sites))->render();

		File::put('downloads/'.$today.'/stats.html', $stats);



		return "Generated";
	}
	
	public function test()
	{
		return "Just testing";
	}
}