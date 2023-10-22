<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use App\Models\Business;
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

    public function invoicesettings(Request $request)
    {
       $business = Business::find(1);
       return view('settings.invoicesettings')->with(['business' =>$business]);
    }

    public function invoicesettingssave(Request $request)
    {
     
            $settings =Business::find(1);
            $settings->enablelogo =$request->enablelogo;       
            $headerimage = $request->headerimage;
            if($headerimage!=NULL) {               
                $filename    = time().'.'.$request->headerimage->extension();  
                $request->headerimage->move(public_path('storage/uploads/'), $filename);                        
                $settings->headerimage =$filename;       
            }  
            $footerimage = $request->footerimage;
            if($footerimage!=NULL) {               
                $filename    = time().'.'.$request->footerimage->extension();  
                $request->footerimage->move(public_path('storage/uploads/'), $filename);                        
                $settings->footerimage =$filename;       
            }  
                
            $settings->save();        
            return redirect()->back()->with('success', 'Invoice Settings Updated');  
    }

    
    
}
