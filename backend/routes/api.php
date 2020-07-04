<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Route::apiResources() automatically creates the necessary routes that are
 * required by an API controller. Although typically it makes sense to write
 * out the routes manually, this makes routing much simpler, and corresponds
 * perfectly to the RESTful API controller.
 * 
 * Source: https://laravel.com/docs/7.x/controllers#restful-partial-resource-routes
 * 
 * Available API routes:
 * 
 * Photographers:
 * /api/photographers [GET]
 * /api/photographers [POST]
 * /api/photographers/{photographer} [GET]
 * /api/photographers/{photographer} [PUT]
 * /api/photographers/{photographer} [DELETE]
 * 
 * Galleries:
 * /api/galleries [GET]
 * /api/galleries/{gallery} [GET]
 * 
 * Photos:
 * /api/photos [GET]
 * /api/photos [POST]
 * /api/photos/{photo} [GET]
 * /api/photos/{photo} [PUT]
 * /api/photos/{photo} [DELETE]
 */

Route::apiResources([
    'photographers' => 'Api\PhotographerController',
    'photos' => 'Api\PhotoController',
]);

Route::get('/galleries', 'Api\GalleryController@index');
Route::get('/galleries/{gallery}', 'Api\GalleryController@show');
