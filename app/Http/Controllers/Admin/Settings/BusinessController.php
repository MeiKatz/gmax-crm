<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $business = Business::find(1);

        return view('settings.business')->with([
            'business' => $business,
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
        $settings = Business::find(1);

        $settings->businessname = $request->businessname;
        $settings->email = $request->email;
        $settings->contactnum = $request->contactnum;
        $settings->taxid = $request->taxid;
        $settings->address = $request->address;
        $settings->address2 = $request->address2;
        $settings->city = $request->city;
        $settings->state = $request->state;
        $settings->country = $request->country;
        $imagefile = $request->logo;

        if ( $imagefile !== null ) {
            $filename    = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('storage/uploads/'), $filename);
            $settings->logo = $filename;
        }

        $settings->status = 1;
        $settings->save();

        return redirect()->back()->with([
            'success' => 'Business information updated',
        ]);
    }
}
