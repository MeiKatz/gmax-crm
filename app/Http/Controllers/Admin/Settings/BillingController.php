<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $settings = Setting::first();

        return view('settings.billing')->with([
            'settings' => $settings,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings = Setting::find(1);

        $settings->prefix = $request->prefix;
        $settings->suffix = $request->suffix;
        $settings->taxstatus = $request->taxstatus;
        $settings->taxname = $request->taxname;
        $settings->taxpercent = $request->taxpercent;
        $settings->invoicenote = $request->invoicenote;
        $settings->quotenote = $request->quotenote;

        $settings->save();

        return redirect()->back()->with([
            'success' => 'Billing information updated',
        ]);
    }
}
