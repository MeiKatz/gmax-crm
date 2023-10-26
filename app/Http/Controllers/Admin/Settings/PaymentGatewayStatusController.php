<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\PaymentGateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentGatewayStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $gateways = PaymentGateway::findOrFail( $request->id );
        $gateways->status = $request->status;
        $gateways->save();

        return redirect()->back()->with([
            'success' => 'Payment Gateway Updated',
        ]);
    }
}
