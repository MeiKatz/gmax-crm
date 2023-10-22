<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Settings as AdminSettings;
use Illuminate\Support\Facades\Route;

Route::prefix('users')
	->name('users.')
	->controller(Admin\UserController::class)
	->group(function () {
		Route::get('', 'index')->name('index');
		Route::post('', 'store')->name('store');
		Route::put('', 'update')->name('update');
		Route::delete('{user}', 'destroy')->name('destroy');
	});

Route::prefix('settings')
	->name('settings.')
	->group(function () {
		Route::controller(Admin\SettingController::class)
			->group(function () {
				Route::get('', 'show')->name('show');
				Route::put('', 'update')->name('update');
			});

		Route::prefix('billing')
			->name('billing.')
			->controller(AdminSettings\BillingController::class)
			->group(function () {
				Route::get('', 'show')->name('show');
				Route::put('', 'update')->name('update');
			});

		Route::prefix('business')
			->name('business.')
			->controller(AdminSettings\BusinessController::class)
			->group(function () {
				Route::get('', 'show')->name('show');
				Route::put('', 'update')->name('update');
			});

		Route::prefix('invoice')
			->name('invoice.')
			->controller(AdminSettings\InvoiceController::class)
			->group(function () {
				Route::get('', 'show')->name('show');
				Route::put('', 'update')->name('update');
			});

		Route::prefix('payment-gateway')
			->name('payment-gateway.')
			->controller(AdminSettings\PaymentGatewayController::class)
			->group(function () {
				Route::get('', 'show')->name('show');
				Route::put('', 'update')->name('update');
			});

		Route::put(
			'payment-gateway/status',
			AdminSettings\PaymentGatewayStatusController::class
		)->name('payment-gateway.status');
	});
