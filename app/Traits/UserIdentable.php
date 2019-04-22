<?php

namespace App\Traits;
use Log;

trait UserIdentable {
  public function identityUser()
  {
    $identity = session()->get('authuser.id').session()->get('authuser.kd_loket').session()->get('authuser.username');
    return crypt($identity, 'youknownothingjonsnow!!!!!!!!!');
  }

  public function logtime($func)
  {
    $micro_date = microtime();
    $date_array = explode(" ",$micro_date);
    $date = date("Y-m-d H:i:s",$date_array[1]);
    Log::info($func.' =>' .$date.':' . $date_array[0]);
  }
}