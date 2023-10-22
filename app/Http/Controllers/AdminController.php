<?php

namespace App\Http\Controllers;

use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminController extends Controller
{
    /// system info and update

    public function updatesystem(Request $request)
    {      
        return view('app.update');
    }

    public function languageswitch(Request $request)
    {   
        app()->setLocale($request->lang);
        session()->put('locale', $request->lang);      
        return redirect('/dashboard');
    }

    public function softwareupdate(Request $request)
    {      
        return view('app.softwareupdate');
    }

    public function runupdate(Request $request)
    {      
       // run migration
       Artisan::call('migrate');
       return view('app.softwareupdatecomplete');
    }
    
}
