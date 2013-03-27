<?php

class IgnoreController extends BaseController {

  public function index()
  {
    $ignoredSitesIds = DB::table('ignored')->get();
    $ids = array();
    $ids[] = 0;
    foreach ($ignoredSitesIds as $id) {
        $ids[] = intval($id->site_id);
      }

    $sites = MonitoringSite::whereIn('site_id', $ids)->get();

    return View::make('ignore.list', array('sites' => $sites));
  }  

  public function delete()
  {
    $site_id = Input::get('site_id');
    DB::table('ignored')->where('site_id', $site_id)->delete();
    return Redirect::action('IgnoreController@index');
  }

  public function add()
  {
    return View::make('ignore.add');
  }

  public function store()
  {
    $site_id = Input::get('site_id');
    if (is_numeric($site_id))
      {
        DB::table('ignored')->insert(array('site_id' => $site_id));
          return Redirect::action('IgnoreController@index'); 
      }
    else 
      return Redirect::action('IgnoreController@add');

  }
}