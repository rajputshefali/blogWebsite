<?php

use Illuminate\Support\Facades\Route;
use App\Modules\User\Http\Controllers\UserController;
use App\Modules\User\Http\Controllers\BlogPostController;
use App\Modules\User\Http\Controllers\CommentController;
use App\Modules\User\Http\Controllers\BMSController;

Route::get('user', 'UserController@welcome');

Route::group(['middleware' =>['authCheck','UserMiddleware']], function () {
    // dd("coming");
    Route::get('home', [UserController::class, 'home'])->name('/home');
    //logout
    Route::get('/logout', [UserController::class, 'logout'])->name('/logout');

    //show blog
    Route::get('/blog', [BlogPostController::class, 'index']);
});

// Route::get('home', [UserController::class, 'home'])->name('/home');




    Route::get('registration', [UserController::class, 'register'])->name('registration')->middleware('loggedIn');
    Route::get('login-user', [UserController::class, 'login'])->name('login-user')->middleware('loggedIn');
    Route::post('/save_user', [UserController::class, 'save_user'])->name('save_user');
    Route::post('userlogin', [UserController::class, 'userlogin']);
    
    //blog
    // Route::get('/blog', [BlogPostController::class, 'index']);

    //showing specific id's blog
    Route::get('/blog/{id}', [BlogPostController::class, 'show'])->name('/show');

    //create blog_post
    Route::get('/blog/create/post', [BlogPostController::class, 'create']);
    Route::post('/blog/create/post', [BlogPostController::class, 'store']);


    //edit the blog post
    Route::get('/editpost/{id}', [BlogPostController::class, 'edit']);
    Route::put('/postupdate/{id}', [BlogPostController::class, 'update']);

    //delete post by created user
    Route::get('/deletepost/{id}', [BlogPostController::class, 'destroy']);

    //logout
    Route::get('/logout', [UserController::class, 'logout'])->name('/logout');


    //comment system
    Route::post('comments', [CommentController::class, 'store'])->name('comments');

   Route::post('comments', [CommentController::class, 'store'])->name('comments');

   //deletes  comment who commented
   Route::post('delete-comment', [CommentController::class, 'destroy']);

   //deletes comments who created the post
   Route::post('destroy-comment', [CommentController::class, 'delete']);

   //edit the comment
   Route::get('/editcomment/{id}', [CommentController::class, 'edit']);
   Route::put('/commentupdate/{id}', [CommentController::class, 'updateComment']);



   //FORGOT PASSWORD
   Route::get('/forget', [UserController::class, 'forgetPass'])->name('forget');
   Route::post('/forgot-password', [UserController::class, 'resetPass'])->name('forgot-password');
   Route::get('/password-reset/{token}', [UserController::class, 'passwordReset'])->name('password-reset');
   Route::post('/resetpassword', [UserController::class, 'reset'])->name('reset-password');
  
   

    // Route::get('registration', [UserController::class, 'register'])->name('registration')->middleware('loggedIn');
    // Route::get('login-user', [UserController::class, 'login'])->name('login-user')->middleware('loggedIn');

    


// Route::get('registration', [UserController::class, 'register'])->name('registration');
// Route::post('/save_user', [UserController::class, 'save_user'])->name('save_user');
// // Route::get('login-user', [UserController::class, 'login'])->name('login-user');
// Route::post('userlogin', [UserController::class, 'userlogin']);

// Route::get('home', [UserController::class, 'home'])->name('/home');

// //blog
// Route::get('/blog', [BlogPostController::class, 'index']);

// //showing specific id's blog
// Route::get('/blog/{id}', [BlogPostController::class, 'show'])->name('/show');

// //create blog_post
// Route::get('/blog/create/post', [BlogPostController::class, 'create']);
// Route::post('/blog/create/post', [BlogPostController::class, 'store']);





// //logout
// Route::get('/logout', [UserController::class, 'logout'])->name('/logout');


// //comment system
// Route::post('comments', [CommentController::class, 'store'])->name('comments');

// Route::post('comments', [CommentController::class, 'store'])->name('comments');

// //deletes  comment who commented
// Route::post('delete-comment', [CommentController::class, 'destroy']);

// //deletes comments who created the post
// Route::post('destroy-comment', [CommentController::class, 'delete']);

// //edit the comment
// Route::get('/editcomment/{id}', [CommentController::class, 'edit']);
// Route::put('/commentupdate/{id}', [CommentController::class, 'updateComment']);

//testing
// Route::view('comment-edit', 'User::comment-edit');
// Route::get('get',[CommentController::class, 'commentShow']);

// Route::get('/edit/{id}', [AdminController::class, 'editRole']);
// Route::put('/role-update/{id}', [AdminController::class, 'updateRole']);




//bank management system
Route::get('bmsfront', [BMSController::class, 'bmsFront']);

Route::post('bmsDetails', [BMSController::class, 'saveDetails'])->name('bmsDetails');

