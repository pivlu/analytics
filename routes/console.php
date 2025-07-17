<?php

use App\Console\Commands\UpdateStatsRecentCommand;
use Illuminate\Support\Facades\Schedule;

// update recent stats table (used in charts)
Schedule::command(UpdateStatsRecentCommand::class)->everyThreeHours();
