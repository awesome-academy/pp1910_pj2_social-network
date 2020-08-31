<?php

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
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth','verified', 'language']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::get('/settings', 'UserController@getProfile')->name('user.getProfile');
    Route::post('/settings/update', 'UserController@updateProfile')->name('user.updateProfile');
    Route::get('/settings/password', 'UserController@getChangePassword')->name('user.getChangePassword');
    Route::post('/settings/password/update', 'UserController@changePassword')->name('user.changePassword');
    Route::get('/search', 'UserController@getSearchPeoplelist')->name('search');
    Route::get('/{username}', 'ProfileController@showProfile')->name('user.profile');
    Route::post('/{username}/update-avatar', 'ProfileController@updateAvatar')->name('user.updateAvatar');
    Route::post('follow', 'HomeController@followUserRequest')->name('user.follow');
    Route::resource('comments', 'CommentController');
    Route::resource('likes', 'LikeController');
    Route::get('posts/{post}/get-images', 'PostController@getImageEditPost');
    Route::get('/notifications/show-notifications', 'NotificationController@getNotificationList')->name('getNotificationList');
    Route::get('/notifications/show-all', 'NotificationController@showAllNotification')->name('notifications.show_all');
    Route::post('/notifications/mark-all', 'NotificationController@markAllAsRead')->name('notifications.mark_all');
    Route::get('comment/load-more', 'CommentController@viewMoreComment')->name('comments.viewMoreComment');
    Route::post('/language', 'UserController@language')->name('language');
});

