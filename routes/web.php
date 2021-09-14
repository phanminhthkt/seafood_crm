<?php

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
// Route::group(['as'=>'', 'namespace'=>'App\Http\Controllers\Frontend'], function(){
	// Auth::routes();
// });
Route::group(['as' => 'admin.','namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin'], function(){	

 	Route::get('user/login',['uses' => 'UserController@getLogin','as'=>'user.login']);
 	Route::post('user/login',['uses' => 'UserController@postLogin']);
 	

	Route::group(['middleware' => ['auth:web'] ], function(){	
		Route::put('/ajax/status/{id}', ['uses' => 'AjaxController@updateStatus']);
		Route::put('/ajax/priority/{id}', ['uses' => 'AjaxController@updatePriority']);
		// Route::resource('member', 'MemberController');
		Route::get('',['uses' => 'IndexController@index','as'=>'index']);
		
		
		/*User */
		
		// Route::post('user/login',['uses' => '/UserController@postLogin','as'=>'user.login']);
		Route::get('/user',['uses' => 'UserController@index','as' => 'user.index'])->middleware('can:view-user');
		Route::get('/user/data',['uses' => 'UserController@getData','as' => 'user.data'])->middleware('can:view-user');
		Route::get('/user/add',['uses' => 'UserController@create','as' => 'user.add'])->middleware('can:create-user');
		Route::post('/user/store',['uses' => 'UserController@store','as' => 'user.store']);
		Route::get('/user/edit/{id}',['uses' => 'UserController@edit','as' => 'user.edit'])->middleware('can:update-user');
		Route::put('/user/update/{id}', ['uses' => 'UserController@update','as' => 'user.update']);
		Route::delete('/user/delete/{id}',['uses' => 'UserController@delete','as' => 'user.delete'])->middleware('can:delete-user');
		Route::delete('/user/delete-multiple/{id}',['uses' => 'UserController@deleteMultiple'])->middleware('can:delete-user');
		Route::get('user/logout',['uses' => 'UserController@logout','as'=>'user.logout']);

		/*Role */
		Route::get('/role',['uses' => 'RoleController@index','as' => 'role.index'])->middleware('can:view-role');
		Route::get('/role/data',['uses' => 'RoleController@getData','as' => 'role.data'])->middleware('can:view-role');
		Route::get('/role/add',['uses' => 'RoleController@create','as' => 'role.add'])->middleware('can:create-status');
		Route::post('/role/store',['uses' => 'RoleController@store','as' => 'role.store']);
		Route::get('/role/edit/{id}',['uses' => 'RoleController@edit','as' => 'role.edit'])->middleware('can:update-status');
		Route::put('/role/update/{id}', ['uses' => 'RoleController@update','as' => 'role.update']);
		Route::delete('/role/delete/{id}',['uses' => 'RoleController@delete','as' => 'role.delete'])->middleware('can:delete-role');
		Route::delete('/role/delete-multiple/{id}',['uses' => 'RoleController@deleteMultiple'])->middleware('can:delete-role');

		/*Role */
		Route::get('/permission',['uses' => 'PermissionController@index','as' => 'permission.index'])->middleware('can:view-permission');
		Route::get('/permission/data',['uses' => 'PermissionController@getData','as' => 'permission.data'])->middleware('can:view-permission');
		Route::get('/permission/add',['uses' => 'PermissionController@create','as' => 'permission.add'])->middleware('can:create-permission');
		Route::post('/permission/store',['uses' => 'PermissionController@store','as' => 'permission.store']);
		Route::get('/permission/edit/{id}',['uses' => 'PermissionController@edit','as' => 'permission.edit'])->middleware('can:update-permission');
		Route::put('/permission/update/{id}', ['uses' => 'PermissionController@update','as' => 'permission.update']);
		Route::delete('/permission/delete/{id}',['uses' => 'PermissionController@delete','as' => 'permission.delete'])->middleware('can:delete-permission');
		Route::delete('/permission/delete-multiple/{id}',['uses' => 'PermissionController@deleteMultiple'])->middleware('can:delete-permission');

		/*Member */
		Route::get('/member',['uses' => 'MemberController@index','as' => 'member.index'])->middleware('can:view-member');
		Route::get('/member/add',['uses' => 'MemberController@create','as' => 'member.add'])->middleware('can:create-member');
		Route::post('/member/store',['uses' => 'MemberController@store','as' => 'member.store']);
		Route::get('/member/edit/{id}',['uses' => 'MemberController@edit','as' => 'member.edit'])->middleware('can:update-member');
		Route::put('/member/update/{id}', ['uses' => 'MemberController@update','as' => 'member.update']);
		Route::delete('/member/delete/{id}',['uses' => 'MemberController@delete','as' => 'member.delete'])->middleware('can:delete-member');
		Route::delete('/member/delete-multiple/{id}',['uses' => 'MemberController@deleteMultiple'])->middleware('can:delete-member');
		Route::get('/member/send-mail',['uses' => 'MemberController@sendMail']);

		/*Nhóm thành viên */
		Route::get('/group_member',['uses' => 'GroupMemberController@index','as' => 'group_member.index'])->middleware('can:view-group_member');
		// Route::get('/group_member/add',['uses' => 'GroupMemberController@create','as' => 'group_member.add'])->middleware('can:create-group_member');
		Route::post('/group_member/store',['uses' => 'GroupMemberController@store','as' => 'group_member.store']);
		Route::get('/group_member/edit/{id}',['uses' => 'GroupMemberController@edit','as' => 'group_member.edit'])->middleware('can:update-group_member');
		// Route::put('/group_member/update/{id}', ['uses' => 'GroupMemberController@update','as' => 'group_member.update']);
		// Route::delete('/group_member/delete/{id}',['uses' => 'GroupMemberController@delete','as' => 'group_member.delete'])->middleware('can:delete-group_member');
		// Route::delete('/group_member/delete-multiple/{id}',['uses' => 'GroupMemberController@deleteMultiple'])->middleware('can:delete-group_member');

		/*Nhóm trạng thái */
		Route::get('/unit',['uses' => 'UnitController@index','as' => 'unit.index'])->middleware('can:view-unit');
		Route::get('/unit/data',['uses' => 'UnitController@getData','as' => 'unit.data'])->middleware('can:view-unit');
		Route::get('/unit/add',['uses' => 'UnitController@create','as' => 'unit.add'])->middleware('can:create-unit');
		Route::post('/unit/store',['uses' => 'UnitController@store','as' => 'unit.store'])->middleware('can:create-unit');
		Route::get('/unit/edit/{id}',['uses' => 'UnitController@edit','as' => 'unit.edit'])->middleware('can:update-unit');
		Route::put('/unit/update/{id}', ['uses' => 'UnitController@update','as' => 'unit.update']);
		Route::delete('/unit/delete/{id}',['uses' => 'UnitController@delete','as' => 'unit.delete'])->middleware('can:delete-unit');
		Route::delete('/unit/delete-multiple/{id}',['uses' => 'UnitController@deleteMultiple'])->middleware('can:delete-unit');

		/*Nhóm trạng thái */
		Route::get('/group_status',['uses' => 'GroupStatusController@index','as' => 'group_status.index'])->middleware('can:view-group_status');
		Route::get('/group_status/data',['uses' => 'GroupStatusController@getData','as' => 'group_status.data'])->middleware('can:view-group_status');
		Route::get('/group_status/add',['uses' => 'GroupStatusController@create','as' => 'group_status.add'])->middleware('can:create-group_status');
		Route::post('/group_status/store',['uses' => 'GroupStatusController@store','as' => 'group_status.store']);
		Route::get('/group_status/edit/{id}',['uses' => 'GroupStatusController@edit','as' => 'group_status.edit'])->middleware('can:update-group_status');
		Route::put('/group_status/update/{id}', ['uses' => 'GroupStatusController@update','as' => 'group_status.update']);
		Route::delete('/group_status/delete/{id}',['uses' => 'GroupStatusController@delete','as' => 'group_status.delete'])->middleware('can:delete-group_status');
		Route::delete('/group_status/delete-multiple/{id}',['uses' => 'GroupStatusController@deleteMultiple'])->middleware('can:delete-group_status');

		/*Trạng thái */
		Route::get('/status',['uses' => 'StatusController@index','as' => 'status.index'])->middleware('can:view-status');
		Route::get('/status/data',['uses' => 'StatusController@getData','as' => 'status.data'])->middleware('can:view-status');
		Route::get('/status/add',['uses' => 'StatusController@create','as' => 'status.add'])->middleware('can:create-status');
		Route::post('/status/store',['uses' => 'StatusController@store','as' => 'status.store']);
		Route::get('/status/edit/{id}',['uses' => 'StatusController@edit','as' => 'status.edit'])->middleware('can:update-status');
		Route::put('/status/update/{id}', ['uses' => 'StatusController@update','as' => 'status.update']);
		Route::delete('/status/delete/{id}',['uses' => 'StatusController@delete','as' => 'status.delete'])->middleware('can:delete-status');
		Route::delete('/status/delete-multiple/{id}',['uses' => 'StatusController@deleteMultiple'])->middleware('can:delete-status');

		/*Nhóm thuộc tính */
		Route::get('/group_attribute',['uses' => 'GroupAttributeController@index','as' => 'group_attribute.index'])->middleware('can:view-group_attribute');
		Route::get('/group_attribute/data',['uses' => 'GroupAttributeController@getData','as' => 'group_attribute.data'])->middleware('can:view-group_attribute');
		Route::get('/group_attribute/add',['uses' => 'GroupAttributeController@create','as' => 'group_attribute.add'])->middleware('can:create-group_attribute');
		Route::post('/group_attribute/store',['uses' => 'GroupAttributeController@store','as' => 'group_attribute.store']);
		Route::get('/group_attribute/edit/{id}',['uses' => 'GroupAttributeController@edit','as' => 'group_attribute.edit'])->middleware('can:update-group_attribute');
		Route::put('/group_attribute/update/{id}', ['uses' => 'GroupAttributeController@update','as' => 'group_attribute.update']);
		Route::delete('/group_attribute/delete/{id}',['uses' => 'GroupAttributeController@delete','as' => 'group_attribute.delete'])->middleware('can:delete-group_attribute');
		Route::delete('/group_attribute/delete-multiple/{id}',['uses' => 'GroupAttributeController@deleteMultiple'])->middleware('can:delete-group_attribute');

		/*Thuộc tính */
		Route::get('/attribute',['uses' => 'AttributeController@index','as' => 'attribute.index'])->middleware('can:view-attribute');
		Route::get('/attribute/data',['uses' => 'AttributeController@getData','as' => 'attribute.data'])->middleware('can:view-attribute');
		Route::get('/attribute/add',['uses' => 'AttributeController@create','as' => 'attribute.add'])->middleware('can:create-attribute');
		Route::get('/attribute/add/group/{group_id}',['uses' => 'AttributeController@create','as' => 'attribute.add'])->middleware('can:create-attribute');
		Route::post('/attribute/store',['uses' => 'AttributeController@store','as' => 'attribute.store']);
		Route::get('/attribute/edit/{id}',['uses' => 'AttributeController@edit','as' => 'attribute.edit'])->middleware('can:update-attribute');
		Route::put('/attribute/update/{id}', ['uses' => 'AttributeController@update','as' => 'attribute.update']);
		Route::delete('/attribute/delete/{id}',['uses' => 'AttributeController@delete','as' => 'attribute.delete'])->middleware('can:delete-attribute');
		Route::delete('/attribute/delete-multiple/{id}',['uses' => 'AttributeController@deleteMultiple'])->middleware('can:delete-attribute');

		/*Danh mục */
		Route::get('/category',['uses' => 'CategoryController@index','as' => 'category.index'])->middleware('can:view-category');
		Route::get('/category/data',['uses' => 'CategoryController@getData','as' => 'category.data'])->middleware('can:view-category');
		Route::get('/category/add',['uses' => 'CategoryController@create','as' => 'category.add'])->middleware('can:create-category');
		Route::post('/category/store',['uses' => 'CategoryController@store','as' => 'category.store']);
		Route::get('/category/edit/{id}',['uses' => 'CategoryController@edit','as' => 'category.edit'])->middleware('can:update-category');
		Route::put('/category/update/{id}', ['uses' => 'CategoryController@update','as' => 'category.update']);
		Route::delete('/category/delete/{id}',['uses' => 'CategoryController@delete','as' => 'category.delete'])->middleware('can:delete-category');
		Route::delete('/category/delete-multiple/{id}',['uses' => 'CategoryController@deleteMultiple'])->middleware('can:delete-category');

		/*Hàng Hoá */
		Route::get('/product',['uses' => 'ProductController@index','as' => 'product.index'])->middleware('can:view-product');
		Route::get('/product/data',['uses' => 'ProductController@getData','as' => 'product.data'])->middleware('can:view-product');
		Route::get('/product/data-child/{id}',['uses' => 'ProductController@getDataChild','as' => 'product.data.child'])->middleware('can:view-product');
		Route::get('/product/add',['uses' => 'ProductController@create','as' => 'product.add'])->middleware('can:create-product');
		Route::post('/product/store',['uses' => 'ProductController@store','as' => 'product.store']);
		Route::get('/product/edit/{id}',['uses' => 'ProductController@edit','as' => 'product.edit'])->middleware('can:update-product');
		Route::put('/product/update/{id}', ['uses' => 'ProductController@update','as' => 'product.update']);

		Route::get('/product/child/add/{id}',['uses' => 'ProductController@createChild','as' => 'product.child.add'])->middleware('can:update-product');
		Route::post('/product/child/store/{id}', ['uses' => 'ProductController@storeChild','as' => 'product.child.store']);
		
		Route::get('/product/child/edit/{id}',['uses' => 'ProductController@editChild','as' => 'product.child.edit'])->middleware('can:update-product');
		Route::put('/product/child/update/{id}', ['uses' => 'ProductController@updateChild','as' => 'product.child.update']);

		Route::delete('/product/delete/{id}',['uses' => 'ProductController@delete','as' => 'product.delete'])->middleware('can:delete-product');
		Route::delete('/product/delete-multiple/{id}',['uses' => 'ProductController@deleteMultiple'])->middleware('can:delete-product');

		/*Khách hàng */
		Route::get('/customer',['uses' => 'CustomerController@index','as' => 'customer.index'])->middleware('can:view-status');
		Route::get('/customer/data',['uses' => 'CustomerController@getData','as' => 'customer.data'])->middleware('can:view-status');
		Route::get('/customer/add',['uses' => 'CustomerController@create','as' => 'customer.add'])->middleware('can:create-status');
		Route::post('/customer/store',['uses' => 'CustomerController@store','as' => 'customer.store']);
		Route::get('/customer/edit/{id}',['uses' => 'CustomerController@edit','as' => 'customer.edit'])->middleware('can:update-status');
		Route::put('/customer/update/{id}', ['uses' => 'CustomerController@update','as' => 'customer.update']);
		Route::delete('/customer/delete/{id}',['uses' => 'CustomerController@delete','as' => 'customer.delete'])->middleware('can:delete-status');
		Route::delete('/customer/delete-multiple/{id}',['uses' => 'CustomerController@deleteMultiple'])->middleware('can:delete-status');

		/*Chi nhánh,kho */
		Route::get('/wms',['uses' => 'WmsController@index','as' => 'wms.index'])->middleware('can:view-status');
		Route::get('/wms/data',['uses' => 'WmsController@getData','as' => 'wms.data'])->middleware('can:view-status');
		Route::get('/wms/add',['uses' => 'WmsController@create','as' => 'wms.add'])->middleware('can:create-status');
		Route::post('/wms/store',['uses' => 'WmsController@store','as' => 'wms.store']);
		Route::get('/wms/edit/{id}',['uses' => 'WmsController@edit','as' => 'wms.edit'])->middleware('can:update-status');
		Route::put('/wms/update/{id}', ['uses' => 'WmsController@update','as' => 'wms.update']);
		Route::delete('/wms/delete/{id}',['uses' => 'WmsController@delete','as' => 'wms.delete'])->middleware('can:delete-status');
		Route::delete('/wms/delete-multiple/{id}',['uses' => 'WmsController@deleteMultiple'])->middleware('can:delete-status');

		/*Chi nhánh,kho */
		Route::get('/wms-import',['uses' => 'WmsImportController@index','as' => 'wms.import.index'])->middleware('can:view-status');
		Route::get('/wms-import/data',['uses' => 'WmsImportController@getData','as' => 'wms.import.data'])->middleware('can:view-status');
		Route::get('/wms-import/add',['uses' => 'WmsImportController@create','as' => 'wms.import.add'])->middleware('can:create-status');
		Route::post('/wms-import/store',['uses' => 'WmsImportController@store','as' => 'wms.import.store']);
		Route::get('/wms-import/edit/{id}',['uses' => 'WmsImportController@edit','as' => 'wms.import.edit'])->middleware('can:update-status');
		Route::put('/wms-import/update/{id}', ['uses' => 'WmsImportController@update','as' => 'wms.import.update']);
		Route::delete('/wms-import/delete/{id}',['uses' => 'WmsImportController@delete','as' => 'wms.import.delete'])->middleware('can:delete-status');
		Route::delete('/wms-import/delete-multiple/{id}',['uses' => 'WmsImportController@deleteMultiple'])->middleware('can:delete-status');
	});
});