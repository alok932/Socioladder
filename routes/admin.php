<?php

Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Auth\LoginController@login');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
	Route::post('register', 'Auth\RegisterController@register');
	Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin'], 'namespace'=>'Admin'], function() {
	Route::resource('products', 'ProductController');
	Route::post('products/update-status/{product}', 'ProductController@toggleStatus');
});

Route::get('admin', 'Admin\Auth\LoginController@showLoginForm');