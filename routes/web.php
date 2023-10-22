<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\Settings as AdminSettings;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Project;

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
            ProjectController::class,
            'mytasks'
        ])->name('mytasks');
        Route::get('/view/{id}', [
            ProjectController::class,
            'viewtask'
        ])->name('viewtask');
        Route::post('/task/addtodo', [
            ProjectController::class,
            'addtasktodo'
        ])->name('addtasktodo');
        Route::post('/task/addtodo/update', [
            ProjectController::class,
            'todostatusupdate'
        ])->name('todostatusupdate');
        Route::get('/task/todo/delete/{id}', [
            ProjectController::class,
            'tasktododelete'
        ])->name('tasktododelete');
        Route::post('/task/addcomment', [
            ProjectController::class,
            'addtaskcomment'
        ])->name('addtaskcomment');
        Route::get('/view/complete/{id}', [
            ProjectController::class,
            'taskcomplete'
        ])->name('taskcomplete');
    });

    Route::prefix('/projects')->group(function () {
        Route::get('', [
            ProjectController::class,
            'listofprojects'
        ])->name('listofprojects');
        Route::post('/new/save', [
            ProjectController::class,
            'createnewproject'
        ])->name('createnewproject');
        Route::post('/update/save', [
            ProjectController::class,
            'updateproject'
        ])->name('updateproject');
        Route::post('/descrip/save', [
            ProjectController::class,
            'updateprojectdescript'
        ])->name('updateprojectdescript');
        Route::post('/status/change', [
            ProjectController::class,
            'projectstatuschange'
        ])->name('projectstatuschange');
        Route::get('/{id}', [
            ProjectController::class,
            'viewproject'
        ])->name('viewproject');
        Route::get('/delete/{id}', [
            ProjectController::class,
            'deleteproject'
        ])->name('deleteproject');
        Route::get('/tasks/{id}', [
            ProjectController::class,
            'viewtasks'
        ])->name('viewtasksprjct');
        Route::post('/tasks/save', [
            ProjectController::class,
            'createprjcttask'
        ])->name('createprjcttask');
        Route::post('/tasks/update', [
            ProjectController::class,
            'projecttaskupdate'
        ])->name('projecttaskupdate');
        Route::get('/tasks/delete/{id}', [
            ProjectController::class,
            'deletetasks'
        ])->name('deletetasks');
        Route::get('/note/{id}', [
            ProjectController::class,
            'viewnote'
        ])->name('viewnoteprjct');
        Route::post('/note/save', [
            ProjectController::class,
            'updatenote'
        ])->name('updatenoteprjct');
        Route::post('/updates/new', [
            ProjectController::class,
            'addprojectupdates'
        ])->name('addprojectupdates');
        Route::post('/updates/edit', [
            ProjectController::class,
            'editprojectupdates'
        ])->name('editprojectupdates');
        Route::get('/deleteupdates/{id}', [
            ProjectController::class,
            'deleteupdates'
        ])->name('deleteupdates');
        Route::get(
            '{project}/expenses',
            Project\ExpenseController::class,
        )->name('projects.expenses');
    });

    Route::get('/cashbook', [
        InvoiceController::class,
        'cashbooklist'
    ])->name('cashbooklist');
    Route::get('/notification/update/{id}', [
        ProjectController::class,
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

        Route::get(
            'billing',
            [AdminSettings\BillingController::class, 'show']
        )->name('billing.show');
        Route::put(
            'billing',
            [AdminSettings\BillingController::class, 'update']
        )->name('billing.update');

        Route::get(
            'business',
            [AdminSettings\BusinessController::class, 'show']
        )->name('business.show');
        Route::put(
            'business',
            [AdminSettings\BusinessController::class, 'update']
        )->name('business.update');

        Route::get(
            'invoice',
            [AdminSettings\InvoiceController::class, 'show']
        )->name('invoice.show');
        Route::put(
            'invoice',
            [AdminSettings\InvoiceController::class, 'update']
        )->name('invoice.update');

        Route::get('/paymentgateway', [
            GatewayController::class,
            'paymentgatewaysettings'
        ])->name('paymentgatewaysettings');
        Route::post('/paymentgateway/save', [
            GatewayController::class,
            'paymentgatewaysettingssave'
        ])->name('paymentgatewaysettingssave');
        Route::post('/paymentgateway/enable', [
            GatewayController::class,
            'paymentgatewayenable'
        ])->name('paymentgatewayenable');
    });
});
