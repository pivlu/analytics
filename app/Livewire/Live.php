<?php

/**
 * Pivlu Analytics - Open source and privacy-friendly web analytics.
 * https://analytics.pivlu.com
 *
 * Copyright (c) Chimilevschi Iosif Gabriel
 * LICENSE:
 * Permissions of this strongest copyleft license are conditioned on making available complete source code 
 * of licensed works and modifications, which include larger works using a licensed work, under the same license. 
 * Copyright and license notices must be preserved. Contributors provide an express grant of patent rights. 
 * When a modified version is used to provide a service over a network, the complete source code of the modified version must be made available.
 *    
 * @copyright   Copyright (c) Chimilevschi Iosif Gabriel
 * @license     https://opensource.org/license/agpl-v3  AGPL-3.0 License.
 * @author      Chimilevschi Iosif Gabriel <office@pivlu.com>
 *  * 
 *  DO NOT edit this file manually. All changes will be lost after software update.
 */

namespace App\Livewire;

use Livewire\Component;
use App\Models\LogSession;
use App\Models\Site;
use Illuminate\Support\Carbon;

class Live extends Component
{

    public $site_code;

    public function render()
    {

        $site = Site::where('code', $this->site_code ?? null)->where('active', 1)->first();

        $live_date_start = Carbon::now()->subMinutes(30)->toDateTimeString();

        if ($site)
            $live_sessions = LogSession::with('page', 'visitor')->where('site_id', $site->id)->where('created_at', '>=', $live_date_start)->orderByDesc('id')->limit(500)->get();
        else
            $live_sessions = [];

        $live_last_5_min = 0;
        $live_last_15_min = 0;
        $live_last_30_min = 0;

        foreach ($live_sessions as $live_session) {
            if (time() - strtotime($live_session->created_at) <= 1800) {
                //$live_last_5_min++;
                //$live_last_15_min++;
                $live_last_30_min++;
            }
            if (time() - strtotime($live_session->created_at) <= 900) {
                //$live_last_5_min++;
                $live_last_15_min++;
            }
            if (time() - strtotime($live_session->created_at) <= 300) {
                $live_last_5_min++;
            }
        }

        return view('account.stats.live-component')->with([
            'live_sessions' => $live_sessions,
            'live_last_5_min' => $live_last_5_min ?? 0,
            'live_last_15_min' => $live_last_15_min ?? 0,
            'live_last_30_min' => $live_last_30_min ?? 0,
        ]);
    }
}
