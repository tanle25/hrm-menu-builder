<?php

use Hrm\MenuBuilder\Controllers\HrmMenuBuilderController;
use Illuminate\Support\Facades\Route;

Route::get('menu',[HrmMenuBuilderController::class,'index']);

Route::post('hrm-menu/add', [HrmMenuBuilderController::class,'storeMenu']);

Route::group(['middleware'=>['web']], function(){
    Route::post('hrm-menu/select-menu',[HrmMenuBuilderController::class,'selectMenu']);
    Route::post('hrm-menu/add-item/{menu}',[HrmMenuBuilderController::class,'addItem']);
    Route::post('hrm-menu/update',[HrmMenuBuilderController::class,'update']);
    Route::post('hrm-menu/update-item/{item}',[HrmMenuBuilderController::class,'updateItem']);
});
