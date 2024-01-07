<?php

use Illuminate\Http\Request;
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
 
Route::get('/', function () {
    return view('listings',[
        'heading'=> 'Latest Listings',
        'listings'=> [
            [
                'id'=> 1,
                'title'=> 'Listing One',
                'description'=> 'Listing OneListing OneListing OneListing OneListing One',
            ], 
            [
                'id'=> 2,
                'title'=> 'Listing Two',
                'description'=> '2Listing OneListing OneListing OneListing OneListing One',
            ]
        ]
    ]);
});
