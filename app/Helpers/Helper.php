<?php

namespace App\Helpers;

use App\Guest;
use Carbon\Carbon;

class Helper
{

    public static function getStats()
    {
        $todayDate = Carbon::now()->toDateString();
        $yesterdayDate = Carbon::now()->subDay()->toDateString();
        $todayGuests = Guest::where('created_at', 'like', $todayDate . '%')->get();
        $yesterdayGuestsCount = Guest::where('created_at', 'like', $yesterdayDate . '%')->count();

        return [
            'todayGuests' => $todayGuests,
            'todayGuestsCount' => $todayGuests->count(),
            'yesterdayGuestsCount' => $yesterdayGuestsCount
        ];
    }
}



