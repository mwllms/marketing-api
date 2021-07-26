<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Auth\PermissionController;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/me', [AuthController::class, 'me']);
Route::post('/auth/assign', [AuthController::class, 'assignRole']);

Route::get('/auth/role', [RoleController::class, 'index']);
Route::post('/auth/role', [RoleController::class, 'create']);

Route::post('/auth/permission', [PermissionController::class, 'create']);

Route::get('/campaigns', [CampaignController::class, 'index']);
Route::post('/campaigns', [CampaignController::class, 'create']);

Route::get('/newsletters/{id}', [NewsletterController::class, 'show']);
Route::put('/newsletters/{id}', [NewsletterController::class, 'update']);