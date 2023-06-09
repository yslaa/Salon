<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Route::group(['middleware' => 'auth'], function() {
  Route::get('logout',['uses' => 'LoginController@logout','as' => 'user.logout']);
});

Route::group(['middleware' => 'isLogin'], function() {
  Route::get('/login', ['uses' => 'LoginController@getSignIn','as' => 'user.signIns']);
  Route::post('/login', ['uses' => 'LoginController@postSignIn','as' => 'user.signIn']);

  #Admin
  Route::get('/adminRegister', ['uses' => 'AdminController@getRegister','as' => 'admin.registers']);
  Route::post('/adminRegister', ['uses' => 'AdminController@postRegistered','as' => 'admin.register']);
  #Customer
  Route::get('/customerRegister', ['uses' => 'CustomerController@getRegister','as' => 'customer.registers']);
  Route::post('/customerRegister', ['uses' => 'CustomerController@postRegistered','as' => 'customer.register']);
  #Employee
  Route::get('/employeeRegister', ['uses' => 'EmployeeController@getRegister','as' => 'employee.registers']);
  Route::post('/employeeRegister', ['uses' => 'EmployeeController@postRegistered','as' => 'employee.register']);
  #Supplier
  Route::get('/supplierRegister', ['uses' => 'SupplierController@getRegister','as' => 'supplier.registers']);
  Route::post('/supplierRegister', ['uses' => 'SupplierController@postRegistered','as' => 'supplier.register']);
});

Route::group(['middleware' => 'role:admin'], function() {
  #Admin
  Route::get('/adminProfile', ['uses' => 'AdminController@getAdminProfile','as' => 'admin.profile']);
  Route::get('/admin/profile/edit/{id}', ['uses' => 'AdminController@profileEdit','as' => 'admin.profileEdit']);
  Route::post('/admin/profile/edit/{id}', ['uses' => 'AdminController@profileUpdate','as' => 'admin.profileUpdate']); 
  Route::get('/admin', ['uses' => 'AdminController@index','as' => 'admin.index']);
  Route::get('/admin/{id}', ['uses' => 'AdminController@show','as' => 'admin.show']);
  Route::get('/admin/{id}/edit', ['uses' =>'AdminController@edit','as' => 'admin.edit']);
  Route::post('/admin/{id}/update',['uses' =>'AdminController@update','as' => 'admin.update']);
  Route::delete('/admin/destroy/{id}',['uses' =>'AdminController@destroy','as' => 'admin.destroy']);
  Route::get("/admin/restore/{id}", ["uses" => "adminController@restore","as" => "admin.restore"]);
  Route::get("/admin/forceDelete/{id}", ["uses" => "adminController@forceDelete","as" => "admin.forceDelete"]);
  #Customer
  Route::get('/customer', 'CustomerController@index');
  Route::get('customer/{id}', ['uses' => 'CustomerController@show','as' => 'customer.show']);
  Route::get('/customer/{id}/edit', ['uses' =>'CustomerController@edit','as' => 'customer.edit']);
  Route::post('/customer/{id}/update',['uses' =>'CustomerController@update','as' => 'customer.update']);
  Route::delete('/customer/destroy/{id}',['uses' =>'CustomerController@destroy','as' => 'customer.destroy']);
  Route::get("/customer/restore/{id}", ["uses" => "customerController@restore","as" => "customer.restore"]);
  Route::get("/customer/forceDelete/{id}", ["uses" => "customerController@forceDelete","as" => "customer.forceDelete"]);
  #Employee
  Route::get('/employee', 'EmployeeController@index');
  Route::get('employee/{id}', ['uses' => 'EmployeeController@show','as' => 'employee.show']);
  Route::get('/employee/{id}/edit', ['uses' =>'EmployeeController@edit','as' => 'employee.edit']);
  Route::post('/employee/{id}/update',['uses' =>'EmployeeController@update','as' => 'employee.update']);
  Route::delete('/employee/destroy/{id}',['uses' =>'EmployeeController@destroy','as' => 'employee.destroy']);
  Route::get("/employee/restore/{id}", ["uses" => "employeeController@restore","as" => "employee.restore"]);
  Route::get("/employee/forceDelete/{id}", ["uses" => "employeeController@forceDelete","as" => "employee.forceDelete"]);
  #Supplier
  Route::get('/supplier', 'SupplierController@index');
  Route::get('supplier/{id}', ['uses' => 'SupplierController@show','as' => 'supplier.show']);
  Route::get('/supplier/{id}/edit', ['uses' =>'SupplierController@edit','as' => 'supplier.edit']);
  Route::post('/supplier/{id}/update',['uses' =>'SupplierController@update','as' => 'supplier.update']);
  Route::delete('/supplier/destroy/{id}',['uses' =>'SupplierController@destroy','as' => 'supplier.destroy']);
  Route::get("/supplier/restore/{id}", ["uses" => "supplierController@restore","as" => "supplier.restore"]);
  Route::get("/supplier/forceDelete/{id}", ["uses" => "supplierController@forceDelete","as" => "supplier.forceDelete"]);
  #Chart
  Route::get('/dashboard/userRole', ['uses' => 'DashboardController@userRole','as' => 'dashboard.userRole']);
  #Search
  Route::get('user/search', 'SearchController@search')->name('search.userRole');
});

Route::group(['middleware' => 'role:customer'], function() {
  Route::get('/customerProfile', ['uses' => 'CustomerController@getCustomerProfile','as' => 'customer.profile']);
  Route::get('/customer/profile/edit/{id}', ['uses' => 'CustomerController@profileEdit','as' => 'customer.profileEdit']);
  Route::post('/customer/profile/edit/{id}', ['uses' => 'CustomerController@profileUpdate','as' => 'customer.profileUpdate']);

  #transaction
  Route::get('/index', ['uses' => 'TransactionModelController@index','as' => 'customer.index']);
  Route::get('/index/{id}', ['uses' => 'TransactionModelController@serviceDetails','as' => 'customer.details']);
});

Route::group(['middleware' => 'role:employee'], function() {
  Route::get('/employeeProfile', ['uses' => 'EmployeeController@getEmployeeProfile','as' => 'employee.profile']);
  Route::get('/employee/profile/edit/{id}', ['uses' => 'EmployeeController@profileEdit','as' => 'employee.profileEdit']);
  Route::post('/employee/profile/edit/{id}', ['uses' => 'EmployeeController@profileUpdate','as' => 'employee.profileUpdate']);
});

Route::group(['middleware' => 'role:supplier'], function() {
  Route::get('/supplierProfile', ['uses' => 'SupplierController@getSupplierProfile','as' => 'supplier.profile']);
  Route::get('/supplier/profile/edit/{id}', ['uses' => 'SupplierController@profileEdit','as' => 'supplier.profileEdit']);
  Route::post('/supplier/profile/edit/{id}', ['uses' => 'SupplierController@profileUpdate','as' => 'supplier.profileUpdate']);
});

Route::group(['middleware' => 'role:admin,supplier'], function() {
#Products
Route::get('/product', ['uses' => 'ProductModelController@index','as' => 'product.index']);
Route::get('/product/create', ['uses' => 'ProductModelController@create','as' => 'product.create']);
Route::get('/product/{id}/edit', ['uses' =>'ProductModelController@edit','as' => 'product.edit']);
Route::post('/product/{id}/update',['uses' =>'ProductModelController@update','as' => 'product.update']);
Route::delete('/product/destroy/{id}',['uses' =>'ProductModelController@destroy','as' => 'product.destroy']);
Route::post('/product', ['uses' => 'ProductModelController@store','as' => 'product.store']);
});

Route::group(['middleware' => 'role:admin'], function() {
#Services
Route::get('/service', ['uses' => 'ServiceModelController@index','as' => 'service.index']);
Route::get('/service/create', ['uses' => 'ServiceModelController@create','as' => 'service.create']);
Route::get('/service/{id}/edit', ['uses' =>'ServiceModelController@edit','as' => 'service.edit']);
Route::post('/service/{id}/update',['uses' =>'ServiceModelController@update','as' => 'service.update']);
Route::delete('/service/destroy/{id}',['uses' =>'ServiceModelController@destroy','as' => 'service.destroy']);
Route::post('/service', ['uses' => 'ServiceModelController@store','as' => 'service.store']);

#Transaction Details
Route::get('/transac', ['uses' => 'TransactionModelController@transac','as' => 'transactionAll']);
Route::get('/transac/{id}', ['uses' => 'TransactionModelController@serviceProcess','as' => 'transacDetails']);
Route::post('/transac/{id}', ['uses' => 'TransactionModelController@transacUpdate','as' => 'transacUpdate']);
Route::get('/send-email/{id}', ['uses' => 'TransactionModelController@sendEmail','as' => 'sendEmail']);

#Yajra Tables
Route::get('/transac', ['uses' => 'TransactionModelController@transac','as' => 'transactionAll']);
});

Route::group(['middleware' => 'role:admin,customer'], function() {
  #Transaction
  Route::get('/transaction', ['uses' => 'TransactionModelController@getServices','as' => 'getServices']);
  Route::get('/availed-services', ['uses' => 'TransactionModelController@getAvailed','as' => 'getAvailed']);
  Route::get('/add-avail/{id}', ['uses' =>'TransactionModelController@addAvail','as' => 'addAvail']);
  Route::get('/remove/{id}',['uses' =>'TransactionModelController@removeService','as' => 'removeService']);
  Route::get('/payment',['uses' =>'TransactionModelController@payment','as' => 'payment']);
  // Route::get('checkout',[ItemController::class, 'postCheckout'])->name('checkout');
  });
