<?php
/* This file defines de View Composers 
 * This sets the values to pass to the views.
 */
/*
class ContentComposer {
	 public function compose($view){
	 	View::composer('layout.main', function($view){
	 		$user = Auth::user();
	 		$view->with('user', $user);
	 	});
	 	
	}
}

View::composer('sidebar', function($view) {
    $view->with('links', ['hello','world!']);
});*/

View::composer('layouts.main', function($view){
	 		$user = Auth::user();
	 		$view->with('user', $user);
	 	});