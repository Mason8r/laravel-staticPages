<?php
use Carbon\Carbon;
class MonitoringUser extends Eloquent {

    protected $table = 'monitoring_users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function monitoringSites()
    {
      return $this->hasMany('MonitoringSite', 'site_user_id');
    }
}