<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\PaymentGateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $gateways = PaymentGateway::get();

        return view('admin.settings.paymentgateways')->with([
            'gateways' => $gateways,
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
        $gateways = PaymentGateway::findOrFail( $request->id );

        $gateways->paytitle = $request->paytitle;
        $gateways->apikey = $request->apikey;
        $gateways->apisecret = $request->apisecret;
        $gateways->apiextra = $request->apiextra;
        $gateways->save();

        return redirect()->back()->with([
            'success' => 'Payment Gateway Updated',
        ]);
    }
}
