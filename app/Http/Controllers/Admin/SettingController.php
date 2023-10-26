<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $setings = Setting::first();

        return view('settings.settings')->with([
            'settings' => $setings,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ( $request->businessname !== null ) {
            $settings = Setting::find(1);
            $settings->companyname = $request->businessname;

            if ( $request->logo !== null ) {
                $filename    = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('storage/uploads/'), $filename);
                $settings->logo = $filename;
            }

            $settings->save();
        }

        return redirect()->back()->with([
            'success' => 'Software information updated',
        ]);
    }
}
