<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/agents', [AgentController::class, 'getAgents'])->name('getAgents');
Route::post('/agents', [AgentController::class, 'createAgent'])->name('createAgent');
Route::put('/agents/{id}', [AgentController::class, 'updateAgent'])->name('updateAgent');
Route::delete('/agents/{id}', [AgentController::class, 'deleteAgent'])->name('deleteAgent');

Route::get('/properties', [PropertyController::class, 'getProperties'])->name('getProperties');
Route::post('/properties', [PropertyController::class, 'createProperty'])->name('createProperty');
Route::put('/properties/{id}', [PropertyController::class, 'updateProperty'])->name('updateProperty');
Route::delete('/properties/{id}', [PropertyController::class, 'deleteProperty'])->name('deleteProperty');

Route::get('/inquiries', [InquiryController::class, 'getInquiries'])->name('getInquiries');
Route::post('/inquiries', [InquiryController::class, 'createInquiry'])->name('createInquiry');
Route::put('/inquiries/{id}', [InquiryController::class, 'updateInquiry'])->name('updateInquiry');
Route::delete('/inquiries/{id}', [InquiryController::class, 'deleteInquiry'])->name('deleteInquiry');
