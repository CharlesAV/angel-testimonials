<?php

Route::group(array('prefix' => 'testimonials'), function() {

	$controller = 'TestimonialController';

	Route::get('/', $controller . '@index');
});

Route::group(array('prefix' => admin_uri('testimonials'), 'before' => 'admin'), function() {

	$controller = 'AdminTestimonialController';

	Route::get('/', $controller . '@index');
	Route::get('add', $controller . '@add');
	Route::post('add', array(
		'before' => 'csrf',
		'uses' => $controller . '@attempt_add'
	));
	Route::get('edit/{id}', $controller . '@edit');
	Route::post('edit/{id}', array(
		'before' => 'csrf',
		'uses' => $controller . '@attempt_edit'
	));
	Route::post('delete/{id}', array(
		'before' => 'csrf',
		'uses' => $controller . '@delete'
	));
	Route::post('copy', array(
		'before' => 'csrf',
		'uses' => $controller . '@copy'
	));
	Route::post('order', $controller . '@order');
});