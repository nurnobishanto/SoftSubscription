<?php

use Carbon\Carbon;


function remainingDays($end_date): float|int
{
    $end_date = Carbon::parse($end_date);
    $now = Carbon::now();

    if ($now > $end_date) {
        return -1 * $end_date->diffInDays($now);
    }else{
        return $end_date->diffInDays($now);
    }


}
