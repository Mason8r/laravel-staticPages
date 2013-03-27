<?php
use Carbon\Carbon;
class MonitoringKey extends Eloquent {

    protected $table = 'monitoring_keys';
    protected $primaryKey = 'key_id';
    public $timestamps = false;

    public function monitoringSite()
    {
      return $this->belongsTo('MonitoringSite','site_id');
    }
}