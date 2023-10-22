<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $business = Business::find(1);

        return view('settings.invoicesettings')->with([
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

        $settings->enablelogo =$request->enablelogo;
        $headerimage = $request->headerimage;

        if ( $headerimage !== null ) {
            $filename    = time() . '.' . $request->headerimage->extension();
            $request->headerimage->move(public_path('storage/uploads/'), $filename);
            $settings->headerimage = $filename;
        }

        $footerimage = $request->footerimage;

        if ( $footerimage !== null ) {
            $filename    = time() . '.' . $request->footerimage->extension();
            $request->footerimage->move(public_path('storage/uploads/'), $filename);
            $settings->footerimage = $filename;
        }

        $settings->save();

        return redirect()->back()->with([
            'success' => 'Invoice Settings Updated',
        ]);
    }
}
