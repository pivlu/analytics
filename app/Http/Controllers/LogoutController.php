<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LogoutController extends Controller
{



    /**
     * Show all resources
     */
    public function logout(Request $request)
    {

        $user_id = Auth::user()->id ?? null;

        if ($user_id) {            
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
        }

        return redirect(route('login'));
    }
}
