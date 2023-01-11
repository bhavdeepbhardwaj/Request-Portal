<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/client', 'Auth\LoginController@showClientLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/client', 'Auth\RegisterController@showClientRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/client', 'Auth\LoginController@clientLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/client', 'Auth\RegisterController@createClient');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin');
Route::view('/client', 'client');

Route::get('logout', 'Auth\LoginController@logout');


//Tickets Route

Route::group(['middleware' => ['auth:admin,client'] ], function(){

// AVITA START
        Route::get('new_ticket','TicketsController@create');
        Route::post('new_ticket', 'TicketsController@store');


        Route::get('update_ticket', 'TicketsController@update');
       //Route::get('show_ticket', 'TicketsController@show');

        Route::resource('show_ticket', 'ShowTicketController');
        Route::resource('view_ticket', 'ViewTicketController');

        Route::get('/ticket/detail/{slug}', 'TicketsController@showTicketDetail');
        Route::get('/ticket/status/{slug}', 'TicketsController@viewTicketDetail');


        Route::post('/update/{id}', 'TicketsController@update');
      //Route::get('view_ticket', 'TicketsController@view');
        Route::post('/reject_request/{id}', 'TicketsController@rejection');

//revisions
        Route::post('/new_revision/{id}', 'RevisionsController@store');
        Route::get('view_revision', 'RevisionsController@view');
        Route::get('/revision/detail/{slug}', 'RevisionsController@viewRevisionDetail')->name('revision.detail');

//edits
        Route::post('/new_edit/{id}', 'EditsController@store');
        Route::get('view_edit', 'EditsController@view');
        Route::get('/edit/detail/{slug}', 'EditsController@viewEditDetail')->name('edit.detail');

        Route::get('/ticket/delete/{slug}', 'TicketsController@deleteTicketDetail')->name('ticket.delete');
        // Route::get('/ticket/detail/{slug}', 'TicketsController@showTicketDetail')->name('ticket.detail');
        // Route::get('/ticket/status/{slug}', 'TicketsController@viewTicketDetail')->name('ticket.status');


    //creative approve
    Route::post('/approve', 'TicketsController@approve')->name('approve');
    Route::post('/reject', 'TicketsController@reject')->name('reject');

    //Comments and Reply
    Route::post('/comment/store', 'CommentController@store')->name('comment.add');
    Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');

    //Search and Filter
    Route::resource('column-searching', 'ColumnSearchingController');

    //comments

    Route::post('/comments', 'TicketsController@addComment');

//AVITA Ends

});
