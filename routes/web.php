<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\ProjectController;

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

Route::prefix('/invoices')->group(function () {
    Route::get('/pay/{id}', [
        InvoiceController::class,
        'payinvoice'
    ])->name('payinvoice');
    Route::post('/capture/razorpaypayment', [
        gatewaycontroller::class,
        'razorpaypayment'
    ])->name('razorpaypayment');
    Route::post('/capture/stripe', [
        gatewaycontroller::class,
        'stripepayment'
    ])->name('stripepayment');
    Route::post('/capture/paypal', [
        gatewaycontroller::class,
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

    Route::prefix('/invoices')->group(function () {
        Route::get('', [
            InvoiceController::class,
            'listofinvoices'
        ])->name('listofinvoices');
        Route::post('/new/save', [
            InvoiceController::class,
            'createnewinvoice'
        ])->name('createnewinvoice');
        Route::post('/edit/save', [
            InvoiceController::class,
            'editinvoicedata'
        ])->name('editinvoicedata');
        Route::get('/edit/{id}', [
            InvoiceController::class,
            'editinvoice'
        ])->name('editinvoice');
        Route::get('/delete/{id}', [
            InvoiceController::class,
            'deleteinvoice'
        ])->name('deleteinvoice');
        Route::get('/{id}', [
            InvoiceController::class,
            'viewinvoice'
        ])->name('viewinvoice');
        Route::post('/meta/save', [
            InvoiceController::class,
            'newinvoicemeta'
        ])->name('newinvoicemeta');
        Route::post('/meta/edit', [
            InvoiceController::class,
            'editinvoicemeta'
        ])->name('editinvoicemeta');
        Route::get('/deleteinvoicemeta/{id}/{invo}', [
            InvoiceController::class,
            'deleteinvoicemeta'
        ])->name('deleteinvoicemeta');
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
        Route::post('/edit/taxenable', [
            InvoiceController::class,
            'invoicetaxenable'
        ])->name('invoicetaxenable');
        Route::post('/recurring/save', [
            InvoiceController::class,
            'createrecorringinvoice'
        ])->name('createrecorringinvoice');
        Route::get('/cancelrecurring/{id}', [
            InvoiceController::class,
            'cancelrecurring'
        ])->name('cancelrecurring');
    });

    Route::prefix('/quotes')->group(function () {
        Route::get('', [
            InvoiceController::class,
            'listofquotes'
        ])->name('listofquotes');
        Route::post('/new/save', [
            InvoiceController::class,
            'createnewquotes'
        ])->name('createnewquotes');
        Route::get('/edit/{id}', [
            InvoiceController::class,
            'editquote'
        ])->name('editquote');
        Route::get('/{id}', [
            InvoiceController::class,
            'viewquote'
        ])->name('viewquote');
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

    Route::prefix('/mytasks')->group(function () {
        Route::get('', [
            projectcontroller::class,
            'mytasks'
        ])->name('mytasks');
        Route::get('/view/{id}', [
            projectcontroller::class,
            'viewtask'
        ])->name('viewtask');
        Route::post('/task/addtodo', [
            projectcontroller::class,
            'addtasktodo'
        ])->name('addtasktodo');
        Route::post('/task/addtodo/update', [
            projectcontroller::class,
            'todostatusupdate'
        ])->name('todostatusupdate');
        Route::get('/task/todo/delete/{id}', [
            projectcontroller::class,
            'tasktododelete'
        ])->name('tasktododelete');
        Route::post('/task/addcomment', [
            projectcontroller::class,
            'addtaskcomment'
        ])->name('addtaskcomment');
        Route::get('/view/complete/{id}', [
            projectcontroller::class,
            'taskcomplete'
        ])->name('taskcomplete');
    });

    Route::prefix('/projects')->group(function () {
        Route::get('', [
            projectcontroller::class,
            'listofprojects'
        ])->name('listofprojects');
        Route::post('/new/save', [
            projectcontroller::class,
            'createnewproject'
        ])->name('createnewproject');
        Route::post('/update/save', [
            projectcontroller::class,
            'updateproject'
        ])->name('updateproject');
        Route::post('/descrip/save', [
            projectcontroller::class,
            'updateprojectdescript'
        ])->name('updateprojectdescript');
        Route::post('/status/change', [
            projectcontroller::class,
            'projectstatuschange'
        ])->name('projectstatuschange');
        Route::get('/{id}', [
            projectcontroller::class,
            'viewproject'
        ])->name('viewproject');
        Route::get('/delete/{id}', [
            projectcontroller::class,
            'deleteproject'
        ])->name('deleteproject');
        Route::get('/tasks/{id}', [
            projectcontroller::class,
            'viewtasks'
        ])->name('viewtasksprjct');
        Route::post('/tasks/save', [
            projectcontroller::class,
            'createprjcttask'
        ])->name('createprjcttask');
        Route::post('/tasks/update', [
            projectcontroller::class,
            'projecttaskupdate'
        ])->name('projecttaskupdate');
        Route::get('/tasks/delete/{id}', [
            projectcontroller::class,
            'deletetasks'
        ])->name('deletetasks');
        Route::get('/note/{id}', [
            projectcontroller::class,
            'viewnote'
        ])->name('viewnoteprjct');
        Route::post('/note/save', [
            projectcontroller::class,
            'updatenote'
        ])->name('updatenoteprjct');
        Route::post('/updates/new', [
            projectcontroller::class,
            'addprojectupdates'
        ])->name('addprojectupdates');
        Route::post('/updates/edit', [
            projectcontroller::class,
            'editprojectupdates'
        ])->name('editprojectupdates');
        Route::get('/deleteupdates/{id}', [
            projectcontroller::class,
            'deleteupdates'
        ])->name('deleteupdates');
        Route::get('/expenses/{id}', [
            projectcontroller::class,
            'viewprojectexpense'
        ])->name('viewprojectexpense');
    });

    Route::get('/cashbook', [
        InvoiceController::class,
        'cashbooklist'
    ])->name('cashbooklist');
    Route::get('/notification/update/{id}', [
        projectcontroller::class,
        'notificationupdate'
    ])->name('notificationupdate');
    Route::get('/filemanager', [
        InvoiceController::class,
        'filemanager'
    ])->name('filemanager');
    Route::get('/update', [
        AdminController::class,
        'updatesystem'
    ])->name('updatesystem');
});	

Route::group([
    'middleware' => ['auth','admin'],
    'prefix' => '/admin',
],
function() {
    Route::get('/listofusers', [
        AdminController::class,
        'index'
    ])->name('listofadmins');
    Route::post('/createnewadmin', [
        AdminController::class,
        'createnewadmin'
    ])->name('createnewadmin');
    Route::post('/updateadmin', [
        AdminController::class,
        'updateadmin'
    ])->name('updateadmin');
    Route::get('/deleteadmin/{id}', [
        AdminController::class,
        'deleteadmin'
    ])->name('deleteadmin');

    Route::prefix('/settings')->group(function () {
        Route::get('', [
            SettingsController::class,
            'settings'
        ])->name('adminsettings');
        Route::post('/save', [
            SettingsController::class,
            'updatesettings'
        ])->name('updatesettingssave');

        Route::get('/billing', [
            SettingsController::class,
            'billingsetting'
        ])->name('billingsetting');
        Route::post('/billing/save', [
            SettingsController::class,
            'billingsettingsave'
        ])->name('billingsettingsave');

        Route::get('/invoice', [
            SettingsController::class,
            'invoicesettings'
        ])->name('invoicesettings');
        Route::post('/invoice/save', [
            SettingsController::class,
            'invoicesettingssave'
        ])->name('invoicesettingssave');

        Route::get('/paymentgateway', [
            gatewaycontroller::class,
            'paymentgatewaysettings'
        ])->name('paymentgatewaysettings');
        Route::post('/paymentgateway/save', [
            gatewaycontroller::class,
            'paymentgatewaysettingssave'
        ])->name('paymentgatewaysettingssave');
        Route::post('/paymentgateway/enable', [
            gatewaycontroller::class,
            'paymentgatewayenable'
        ])->name('paymentgatewayenable');

        Route::get('/business', [
            SettingsController::class,
            'businesssetting'
        ])->name('businesssetting');
        Route::post('/business/save', [
            SettingsController::class,
            'businesssettingsave'
        ])->name('businesssettingsave');
    });
});
