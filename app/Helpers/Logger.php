<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

final class Logger
{

    /**
     * log
     *
     * @param  string $message
     * @param bool $save
     * @return void
     */
    public static function info(string $message, bool $save = false): void
    {
        $now = Carbon::now();
        $pid = getmypid();
        if ($save) Log::info($message);
        echo "\33[35m[SYSTEM]\33[36m[$pid]\33[32m[$now]\033[33m - $message \033[0m \n";
        return;
    }
}
