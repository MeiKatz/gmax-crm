<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paymentgateways')->insert(
        [
            'gatewayname' => 'Paypal',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 13l2.5 0c2.5 0 5 -2.5 5 -5c0 -3 -1.9 -5 -5 -5h-5.5c-.5 0 -1 .5 -1 1l-2 14c0 .5 .5 1 1 1h2.8l1.2 -5c.1 -.6 .4 -1 1 -1zm7.5 -5.8c1.7 1 2.5 2.8 2.5 4.8c0 2.5 -2.5 4.5 -5 4.5h-2.6l-.6 3.6a1 1 0 0 1 -1 .8l-2.7 0a0.5 .5 0 0 1 -.5 -.6l.2 -1.4" /></svg>',
            'paytitle' =>'Pay With Paypal',
            'status' => '0'
        ]);

        DB::table('paymentgateways')->insert(
            [
                'gatewayname' => 'Stripe',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.453 8.056c0 -.623 .518 -.979 1.442 -.979c1.69 0 3.41 .343 4.605 .923l.5 -4c-.948 -.449 -2.82 -1 -5.5 -1c-1.895 0 -3.373 .087 -4.5 1c-1.172 .956 -2 2.33 -2 4c0 3.03 1.958 4.906 5 6c1.961 .69 3 .743 3 1.5c0 .735 -.851 1.5 -2 1.5c-1.423 0 -3.963 -.609 -5.5 -1.5l-.5 4c1.321 .734 3.474 1.5 6 1.5c2.004 0 3.957 -.468 5.084 -1.36c1.263 -.979 1.916 -2.268 1.916 -4.14c0 -3.096 -1.915 -4.547 -5.003 -5.637c-1.646 -.605 -2.544 -1.07 -2.544 -1.807z" /></svg>',
                'paytitle' =>'Pay With Stripe',
                'status' => '0'
        ]);

        DB::table('paymentgateways')->insert(
            [
                'gatewayname' => 'Razorpay',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="3" /><line x1="3" y1="10" x2="21" y2="10" /><line x1="7" y1="15" x2="7.01" y2="15" /><line x1="11" y1="15" x2="13" y2="15" /></svg>',
                'paytitle' =>'Pay With Razorpay',
                'status' => '0'
        ]);

        // settings data

        DB::table('settings')->insert(
            [
                'id' => '1',
                'companyname' => 'My Business Name Name',
                'logo' => 'logo.png',
                'prefix' =>'$',
                'suffix' =>'USD',
                'taxstatus' => '1',
                'taxname' => 'GST',
                'taxpercent' => '18',
                'invoicenote' => 'Thank you very much for doing business with us. We look forward to working with you again!',
                'quotenote' => 'Thank you very much for the opportunity. We look forward to working with you!',
                'created_at' => '2021-06-27 08:12:22' 
        ]);

        // business

        DB::table('businesses')->insert(
            [
                'businessname' => 'My Business Name',
                'logo' => 'invoicelogo.png',                
                'status' => '1',
                'headerimage' => 'header.png',
                'footerimage' => 'header.png',
                'enablelogo' => '1'
        ]);

          // admin user

          DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',                
                'password' => '$2y$10$FQIsaqwJ4hbc5bqxtf7Xq.Fv06bG6bVCKc5Dccbr18OoJaPbq9dNO', // 123456
                'usertype' => '1',
                'created_at' => '2021-06-27 08:12:22' 
                
        ]);

    }
}
