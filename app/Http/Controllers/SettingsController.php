<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function settings(Request $request)
    {
       $setings = Setting::first();
       return view('settings.settings')->with(['settings' =>$setings]);
    }
    public function updatesettings(Request $request)
    {
        if($request->businessname!=NULL){
            $settings =Setting::find(1);
            $settings->companyname =$request->businessname;  
            if($request->logo!=NULL) {               
                $filename    = time().'.'.$request->logo->extension();  
                $request->logo->move(public_path('storage/uploads/'), $filename);                        
                $settings->logo =$filename;       
            }                  
            $settings->save();        
            }
            return redirect()->back()->with('success', 'Software information updated'); 
    }
}
