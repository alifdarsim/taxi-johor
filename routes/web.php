<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/api/taxi-locations', function () {
//    $items = [
//        [
//            'id' => 'ABC1234',
//            'latitude' => 1.469040,
//            'longitude' => 103.762355,
//        ],
//        [
//            'id' => 'AFG1234',
//            'latitude' => 1.465045,
//            'longitude' => 103.764377,
//        ],
//        [
//            'id' => 'ABD1233',
//            'latitude' => 1.465145,
//            'longitude' => 103.765255,
//        ],
//
//    ];
//
//    return response()->json($items);
//});
