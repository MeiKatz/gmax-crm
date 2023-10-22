<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClientController;
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

Route::get('/lang/{lang}', [AdminController::class, 'languageswitch'])->name('languageswitch');

Route::get('/softwareupdate', [AdminController::class, 'softwareupdate'])->name('softwareupdate');
Route::get('/runupdate', [AdminController::class, 'runupdate'])->name('runupdate');

Route::get('/dailycron', [InvoiceController::class, 'recorringinvoicecron'])->name('recorringinvoicecron');

Route::get('/invoice/pay/{id}', [InvoiceController::class, 'payinvoice'])->name('payinvoice');
Route::get('/quote/public/{id}', [InvoiceController::class, 'viewquotepublic'])->name('viewquotepublic');
Route::get('/quote/stat/public/{id}/{stat}', [InvoiceController::class, 'quotestatuschangepublic'])->name('quotestatuschangepublic');


Route::post('/invoices/capture/razorpaypayment', [GatewayController::class, 'razorpaypayment'])->name('razorpaypayment');
Route::post('/invoices/capture/stripe', [GatewayController::class, 'stripepayment'])->name('stripepayment');
Route::post('/invoices/capture/paypal', [GatewayController::class, 'paypalhandlePayment'])->name('paypalhandlePayment');




Route::group(['middleware' => ['auth']], function(){
    Route::get('/dashboard', [InvoiceController::class, 'dashboard'])->name('dashboard');


    Route::get('/client/add', [ClientController::class, 'addclient'])->name('addclient');
    Route::post('/client/add/save', [ClientController::class, 'addclientsave'])->name('addclientsave');
    Route::get('/clients', [ClientController::class, 'listofclients'])->name('listofclients');
    Route::get('/client/{id}', [ClientController::class, 'viewclient'])->name('viewclient');
    Route::get('/client/delete/{id}', [ClientController::class, 'deleteclient'])->name('deleteclient');
    Route::get('/client/edit/{id}', [ClientController::class, 'editclient'])->name('editclient');
    Route::post('/client/edit/save', [ClientController::class, 'editclientsave'])->name('editclientsave');


    Route::get('/invoices', [InvoiceController::class, 'listofinvoices'])->name('listofinvoices');
    Route::post('/invoices/new/save', [InvoiceController::class, 'createnewinvoice'])->name('createnewinvoice');
    Route::post('/invoices/edit/save', [InvoiceController::class, 'editinvoicedata'])->name('editinvoicedata');    
    Route::get('/invoice/edit/{id}', [InvoiceController::class, 'editinvoice'])->name('editinvoice');
    Route::get('/invoice/delete/{id}', [InvoiceController::class, 'deleteinvoice'])->name('deleteinvoice');
    Route::get('/invoice/{id}', [InvoiceController::class, 'viewinvoice'])->name('viewinvoice');
    Route::post('/invoices/meta/save', [InvoiceController::class, 'newinvoicemeta'])->name('newinvoicemeta');
    Route::post('/invoices/meta/edit', [InvoiceController::class, 'editinvoicemeta'])->name('editinvoicemeta');
    Route::get('/invoices/deleteinvoicemeta/{id}/{invo}', [InvoiceController::class, 'deleteinvoicemeta'])->name('deleteinvoicemeta');
    Route::post('/invoices/payments/save', [InvoiceController::class, 'invopaymentsave'])->name('invopaymentsave');
    Route::get('/invoices/reversepayment/{id}/{invo}', [InvoiceController::class, 'deletepayment'])->name('deletepayment');
    Route::get('/invoice/cancel/{id}', [InvoiceController::class, 'cancelinvoice'])->name('cancelinvoice');
    Route::post('/invoice/refund/initiate', [InvoiceController::class, 'refundinvoice'])->name('refundinvoice');  
    Route::get('/invoice/email/{id}', [InvoiceController::class, 'emailinvoice'])->name('emailinvoice'); 
    Route::post('/invoice/edit/taxenable', [InvoiceController::class, 'invoicetaxenable'])->name('invoicetaxenable'); 
    Route::post('/invoices/recurring/save', [InvoiceController::class, 'createrecorringinvoice'])->name('createrecorringinvoice'); 
    Route::get('/invoice/cancelrecurring/{id}', [InvoiceController::class, 'cancelrecurring'])->name('cancelrecurring'); 
    
    
    
    Route::get('/quotes', [InvoiceController::class, 'listofquotes'])->name('listofquotes');
    Route::post('/quotes/new/save', [InvoiceController::class, 'createnewquotes'])->name('createnewquotes');
    Route::get('/quote/edit/{id}', [InvoiceController::class, 'editquote'])->name('editquote');
    Route::get('/quote/{id}', [InvoiceController::class, 'viewquote'])->name('viewquote');
    Route::get('/quote/stat/{id}/{stat}', [InvoiceController::class, 'quotestatuschange'])->name('quotestatuschange');
    Route::get('/quote/convert/{id}', [InvoiceController::class, 'converttoinvo'])->name('converttoinvo');
    Route::get('/quote/email/{id}', [InvoiceController::class, 'emailquote'])->name('emailquote'); 


    Route::get('/expenses', [InvoiceController::class, 'expensemanagerlist'])->name('expensemanagerlist');
    Route::post('/expenses/new/save', [InvoiceController::class, 'createnewexpense'])->name('createnewexpense');
    Route::post('/expenses/edit/save', [InvoiceController::class, 'editexpense'])->name('editexpense');
    Route::get('/project/expenses/{id}', [ProjectController::class, 'viewprojectexpense'])->name('viewprojectexpense');
    Route::get('/expenses/delete/{id}', [ProjectController::class, 'deleteexpense'])->name('deleteexpense');

    Route::get('/cashbook', [InvoiceController::class, 'cashbooklist'])->name('cashbooklist');
    

    Route::get('/mytasks', [ProjectController::class, 'mytasks'])->name('mytasks');
    Route::get('/mytasks/view/{id}', [ProjectController::class, 'viewtask'])->name('viewtask');
    Route::post('/mytasks/task/addtodo', [ProjectController::class, 'addtasktodo'])->name('addtasktodo');
    Route::post('/mytasks/task/addtodo/update', [ProjectController::class, 'todostatusupdate'])->name('todostatusupdate');
    Route::get('/mytasks/task/todo/delete/{id}', [ProjectController::class, 'tasktododelete'])->name('tasktododelete');
    Route::post('/mytasks/task/addcomment', [ProjectController::class, 'addtaskcomment'])->name('addtaskcomment');
    Route::get('/mytasks/view/complete/{id}', [ProjectController::class, 'taskcomplete'])->name('taskcomplete');

    Route::get('/notification/update/{id}', [ProjectController::class, 'notificationupdate'])->name('notificationupdate');
 

    Route::get('/filemanager', [InvoiceController::class, 'filemanager'])->name('filemanager');
    
    Route::get('/projects', [ProjectController::class, 'listofprojects'])->name('listofprojects');
    Route::post('/projects/new/save', [ProjectController::class, 'createnewproject'])->name('createnewproject');
    Route::post('/projects/update/save', [ProjectController::class, 'updateproject'])->name('updateproject');
    Route::post('/projects/descrip/save', [ProjectController::class, 'updateprojectdescript'])->name('updateprojectdescript');
    Route::post('/projects/status/change', [ProjectController::class, 'projectstatuschange'])->name('projectstatuschange');
    Route::get('/project/{id}', [ProjectController::class, 'viewproject'])->name('viewproject');
    Route::get('/project/delete/{id}', [ProjectController::class, 'deleteproject'])->name('deleteproject');
    Route::get('/project/tasks/{id}', [ProjectController::class, 'viewtasks'])->name('viewtasksprjct');
    Route::post('/project/tasks/save', [ProjectController::class, 'createprjcttask'])->name('createprjcttask');
    Route::post('/project/tasks/update', [ProjectController::class, 'projecttaskupdate'])->name('projecttaskupdate');
    Route::get('/project/tasks/delete/{id}', [ProjectController::class, 'deletetasks'])->name('deletetasks');
    Route::get('/project/note/{id}', [ProjectController::class, 'viewnote'])->name('viewnoteprjct');
    Route::post('/project/note/save', [ProjectController::class, 'updatenote'])->name('updatenoteprjct');
    Route::post('/projects/updates/new', [ProjectController::class, 'addprojectupdates'])->name('addprojectupdates');
    Route::post('/projects/updates/edit', [ProjectController::class, 'editprojectupdates'])->name('editprojectupdates');
    
    Route::get('/project/deleteupdates/{id}', [ProjectController::class, 'deleteupdates'])->name('deleteupdates');
    
    

    Route::get('/update', [AdminController::class, 'updatesystem'])->name('updatesystem');
    
  

});	


Route::group([
    'middleware' => ['auth','admin'],
    'prefix' => '/admin',
],
function() {
    Route::get('/listofusers', [AdminController::class, 'index'])->name('listofadmins');
    Route::post('/createnewadmin', [AdminController::class, 'createnewadmin'])->name('createnewadmin');
    Route::post('/updateadmin', [AdminController::class, 'updateadmin'])->name('updateadmin');
    Route::get('/deleteadmin/{id}', [AdminController::class, 'deleteadmin'])->name('deleteadmin');
    
    Route::get('/settings', [SettingsController::class, 'settings'])->name('adminsettings');
    Route::post('/settings/save', [SettingsController::class, 'updatesettings'])->name('updatesettingssave');

    Route::get('/settings/billing', [SettingsController::class, 'billingsetting'])->name('billingsetting');
    Route::post('/settings/billing/save', [SettingsController::class, 'billingsettingsave'])->name('billingsettingsave');

    Route::get('/settings/invoice', [SettingsController::class, 'invoicesettings'])->name('invoicesettings');
    Route::post('/settings/invoice/save', [SettingsController::class, 'invoicesettingssave'])->name('invoicesettingssave');


    Route::get('/admin/settings/paymentgateway', [GatewayController::class, 'paymentgatewaysettings'])->name('paymentgatewaysettings');
    Route::post('/admin/settings/paymentgateway/save', [GatewayController::class, 'paymentgatewaysettingssave'])->name('paymentgatewaysettingssave');
    Route::post('/admin/settings/paymentgateway/enable', [GatewayController::class, 'paymentgatewayenable'])->name('paymentgatewayenable');
    
    Route::get('/admin/settings/business', [SettingsController::class, 'businesssetting'])->name('businesssetting');
    Route::post('/admin/settings/business/save', [SettingsController::class, 'businesssettingsave'])->name('businesssettingsave');
    
  
});	
