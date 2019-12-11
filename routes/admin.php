<?php

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

/* Routing Admin */
Route::group(['namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'check-login'], function () {
        Route::get('/s-login', 'AuthController@login')->name('page-login');
        Route::post('/s-login', 'AuthController@postLogin')->name('post-login');
    });
    Route::group(['prefix' => 's-admin', 'middleware' => 'check-logout'], function () {
        Route::get('/', 'AdminController@index')->name('admin-page');
        Route::get('/logout', 'AuthController@logout')->name('post-logout');

        /* Customers */
        Route::get('/users', 'UserController@users')->name('page-users');

        /* Roles */
        Route::get('/roles', 'RoleController@roles')->name('page-roles');
        Route::get('/role/updateStatus', 'RoleController@updateStatus')->name('update-status');
        Route::get('/role/create', 'RoleController@create')->name('page-create-role');
        Route::post('/role/store', 'RoleController@store')->name('post-store-role');
        Route::get('/role/edit/{id}', 'RoleController@edit')->name('page-edit-role');
        Route::post('/role/update', 'RoleController@update')->name('post-update-role');
        Route::get('/role/show/{id}', 'RoleController@show')->name('page-show-role');
        Route::delete('/role/delete/{id}', 'RoleController@destroy')->name('post-delete-role');

        /* Categories */
        Route::get('/categories', 'CategoryController@index')->name('page-categories');
        Route::get('/category/updateStatus', 'CategoryController@updateStatus')->name('update-status-cat');
        Route::get('/category/create', 'CategoryController@create')->name('page-create-category');
        Route::post('/category/store', 'CategoryController@store')->name('post-store-category');
        Route::get('/category/edit/{id}', 'CategoryController@edit')->name('page-edit-category');
        Route::post('/category/update', 'CategoryController@update')->name('post-update-category');
        Route::delete('/category/delete/{id}', 'CategoryController@destroy')->name('post-delete-category');

        /* Brands */
        Route::get('/brands', 'BrandController@index')->name('page-brands');
        Route::get('/brand/updateStatus', 'BrandController@updateStatus')->name('update-status-brand');
        Route::get('/brand/create', 'BrandController@create')->name('page-create-brand');
        Route::post('/brand/store', 'BrandController@store')->name('post-store-brand');
        Route::get('/brand/edit/{id}', 'BrandController@edit')->name('page-edit-brand');
        Route::post('/brand/update', 'BrandController@update')->name('post-update-brand');
        Route::delete('/brand/delete/{id}', 'BrandController@destroy')->name('post-delete-brand');

        /* Products */
        Route::get('/products', 'ProductController@index')->name('page-products');
        Route::get('/product/create', 'ProductController@create')->name('page-create-product');
        Route::post('/product/store', 'ProductController@store')->name('post-store-product');
        Route::get('/product/edit/{id}', 'ProductController@edit')->name('page-edit-product');
        Route::post('/uploadEditor', 'ProductController@uploadEditor')->name('uploadEditor');
//        Route::get('/product/import-csv', 'ProductController@importCSV')->name('page-import-csv');
//        Route::post('/product/import-csv', 'ProductController@postImportCSV')->name('post-import-csv');
        Route::get('/import-export', 'ProductController@importExport')->name('page-import-csv');
        Route::post('/import', 'ProductController@import')->name('post-import-csv');
        Route::get('/export', 'ProductController@export')->name('post-export-csv');
    });
});
/* End */
