<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\LegacyProjectController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Project;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Task;

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
            LegacyProjectController::class,
            'mytasks'
        ])->name('mytasks');
        Route::get('/view/{id}', [
            LegacyProjectController::class,
            'viewtask'
        ])->name('viewtask');
        Route::post('/task/addtodo', [
            LegacyProjectController::class,
            'addtasktodo'
        ])->name('addtasktodo');
        Route::post('/task/addtodo/update', [
            LegacyProjectController::class,
            'todostatusupdate'
        ])->name('todostatusupdate');
        Route::get('/task/todo/delete/{id}', [
            LegacyProjectController::class,
            'tasktododelete'
        ])->name('tasktododelete');
        Route::post('/task/addcomment', [
            LegacyProjectController::class,
            'addtaskcomment'
        ])->name('addtaskcomment');
        Route::get('/view/complete/{id}', [
            LegacyProjectController::class,
            'taskcomplete'
        ])->name('taskcomplete');
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
                'todos',
                Task\TodoController::class
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
