<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        if(Auth::user()->hasRole('Admin'))
        {
            return redirect()->route('admin.dashboard');
        }
        elseif(Auth::user()->hasRole('Manager'))
        {
            return redirect()->route('manager.dashboard');

        }
        else
        {
            return redirect()->route('user.dashboard');
        }
    }
}
