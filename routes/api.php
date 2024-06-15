<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RobotController;

Route::post('/robot/move', [RobotController::class, 'move']);