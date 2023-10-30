<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\Invoice;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PayInvoiceController;
use App\Http\Controllers\Project;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Task;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect(
    '.well-known/change-password',
    'forgot-password'
);

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/lang/{lang}', [
    AdminController::class,
    'languageswitch'
])->name('languageswitch');
Route::get('/softwareupdate', [
    AdminController::class,
    'softwareupdate'
])->name('softwareupdate');
Route::get('/runupdate', [
    AdminController::class,
    'runupdate'
])->name('runupdate');
Route::get('/dailycron', [
    InvoiceController::class,
    'recorringinvoicecron'
])->name('recorringinvoicecron');

Route::get(
    'pay/{invoice}',
    PayInvoiceController::class
)->name('invoices.pay');

Route::prefix('/invoices')->group(function () {
    Route::post('/capture/razorpaypayment', [
        GatewayController::class,
        'razorpaypayment'
    ])->name('razorpaypayment');
    Route::post('/capture/stripe', [
        GatewayController::class,
        'stripepayment'
    ])->name('stripepayment');
    Route::post('/capture/paypal', [
        GatewayController::class,
        'paypalhandlePayment'
    ])->name('paypalhandlePayment');
});

Route::get('/quote/public/{id}', [
    InvoiceController::class,
    'viewquotepublic'
])->name('viewquotepublic');
Route::get('/quote/stat/public/{id}/{stat}', [
    InvoiceController::class,
    'quotestatuschangepublic'
])->name('quotestatuschangepublic');

Route::group(['middleware' => ['auth']], function(){
    Route::get(
        '/dashboard',
        DashboardController::class
    )->name('dashboard');

    Route::resource(
        'clients',
        ClientController::class
    );

    Route::resource(
        'expenses',
        ExpenseController::class
    )->except([
        'create',
        'show',
        'edit',
    ]);

    Route::resource(
        'invoices',
        InvoiceController::class,
    )->only([
        'index',
        'show',
        'store',
        'edit',
        'update',
        'destroy',
    ]);

    Route::prefix('invoices/{invoice}')
        ->name('invoices.')
        ->group(function () {
            Route::resource(
                'items',
                Invoice\ItemController::class,
            )->only([
                'store',
                'update',
                'destroy',
            ]);
        });

    Route::prefix('/invoices')->group(function () {
        Route::post('/payments/save', [
            InvoiceController::class,
            'invopaymentsave'
        ])->name('invopaymentsave');
        Route::get('/reversepayment/{id}/{invo}', [
            InvoiceController::class,
            'deletepayment'
        ])->name('deletepayment');
        Route::get('/cancel/{id}', [
            InvoiceController::class,
            'cancelinvoice'
        ])->name('cancelinvoice');
        Route::post('/refund/initiate', [
            InvoiceController::class,
            'refundinvoice'
        ])->name('refundinvoice');
        Route::get('/email/{id}', [
            InvoiceController::class,
            'emailinvoice'
        ])->name('emailinvoice');
        Route::post('/recurring/save', [
            InvoiceController::class,
            'createrecorringinvoice'
        ])->name('createrecorringinvoice');
        Route::get('/cancelrecurring/{id}', [
            InvoiceController::class,
            'cancelrecurring'
        ])->name('cancelrecurring');
    });

    Route::resource(
        'offers',
        OfferController::class
    )->only([
        'index',
        'store',
        'show',
        'edit',
    ]);

    Route::prefix('/quotes')->group(function () {
        Route::get('/stat/{id}/{stat}', [
            InvoiceController::class,
            'quotestatuschange'
        ])->name('quotestatuschange');
        Route::get('/convert/{id}', [
            InvoiceController::class,
            'converttoinvo'
        ])->name('converttoinvo');
        Route::get('/email/{id}', [
            InvoiceController::class,
            'emailquote'
        ])->name('emailquote');
    });

    Route::resource(
        'tasks',
        TaskController::class
    )->only([
        'index',
        'show',
    ]);

    Route::prefix('tasks/{task}')
        ->name('tasks.')
        ->group(function () {
            Route::resource(
                'items',
                Task\ItemController::class
            )->only([
                'store',
                'update',
                'destroy',
            ]);
        });

    Route::resource(
        'projects',
        ProjectController::class
    )->except([
        'create',
        'edit',
    ]);

    Route::prefix('projects/{project}')
        ->name('projects.')
        ->group(function () {
            Route::controller(Project\NoteController::class)
                ->prefix('note')
                ->name('note.')
                ->group(function () {
                    Route::get('', 'show')->name('show');
                    Route::update('', 'update')->name('update');
                });

            Route::resource(
                'tasks',
                Project\TaskController::class
            )->only([
                'index',
                'show',
                'store',
                'update',
                'destroy',
            ]);

            Route::get(
                'expenses',
                Project\ExpenseController::class,
            )->name('expenses.index');

            Route::resource(
                'updates',
                Project\UpdateController::class
            )->only([
                'store',
                'update',
                'destroy',
            ]);
        });

    Route::resource(
        'notifications',
        NotificationController::class
    )->only([
        'destroy',
    ]);

    Route::get('/cashbook', [
        InvoiceController::class,
        'cashbooklist'
    ])->name('cashbooklist');
    Route::get('/filemanager', [
        InvoiceController::class,
        'filemanager'
    ])->name('filemanager');
    Route::get('/update', [
        AdminController::class,
        'updatesystem'
    ])->name('updatesystem');
});	
