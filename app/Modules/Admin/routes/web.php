<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Http\Controllers\AdminController;
use App\Modules\Admin\Http\Controllers\ManagePostController;
use App\Modules\Admin\Http\Controllers\ManageCommentController;
 


 Route::group(['middleware' => 'customAuth'], function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // //logout
    // Route::get('/logout-user', [AdminController::class, 'logout']);
   

 });

Route::get('admin', 'AdminController@welcome');

//register
Route::get('/admin/register', [AdminController::class, 'registerAdmin']);
Route::post('admin-register', [AdminController::class, 'save'])->name('admin-register');

Route::get('/alogin', [AdminController::class, 'adminLogin'])->name('alogin')->middleware('adminAuth'); 
Route::post('/admin_login', [AdminController::class, 'adminAuth'])->name('admin_login');

//usermanagenent
Route::get('userlist', [AdminController::class, 'manageUser'])->name('user-list');
Route::view('usermanage', 'Admin::manageUsers');

//delete user records
Route::get('delete/{id}', [AdminController::class, 'userDelete'])->name('user.delete');

//user banned & unbanned
// Route::get('edit/{id}', [AdminController::class, 'isBan'])->name('user.edit');

//userBanned
Route::get('/ban/{id}', [AdminController::class, 'isBan']);



//postsmanagement
Route::get('/postlist', [ManagePostController::class, 'managePost'])->name('post-list');
Route::view('/managepost', 'Admin::managepost');

//delete the posts
Route::get('/postdelete/{id}', [ManagePostController::class, 'deletePost'])->name('post.delete');

//COMMENT MANAGEMENT
Route::get('/commentlist', [ManageCommentController::class, 'manageComments'])->name('comment-list');
Route::view('/managecomment', 'Admin::managecomment');

//delete the comments
Route::get('commentdelete/{id}', [ManageCommentController::class, 'commentDelete'])->name('comment.delete');


//logout
 Route::get('/logout-user', [AdminController::class, 'logout'])->name('logout-user');


//FRONT
Route::get('/', [AdminController::class, 'front'])->name('/');




//usermanagement testing
Route::view('/userban', 'Admin::userManagement');

Route::get('/manage', [AdminController::class, 'userManage']);

//ban/unabn edit
Route::get('/edit/{id}', [AdminController::class, 'editRole']);
Route::put('/role-update/{id}', [AdminController::class, 'updateRole']);



//testing blogpost
Route::view('/showpost', 'Admin::postManagement');

Route::get('/postmanagement', [AdminController::class, 'showPost']);

//restric & unrestrict users
Route::get('/editpostUsers/{id}', [AdminController::class, 'restricUser']);
Route::put('/restrictUser-update/{id}', [AdminController::class, 'updatePostuser']);



//forget-password
Route::get('/pwforget', [AdminController::class, 'pwforget'])->name('pwforget');

Route::post('/showform', [AdminController::class, 'showform'])->name('showform');

Route::get('/reset/{token}', [AdminController::class, 'reseting'])->name('reset');

Route::post('/resetpw', [AdminController::class, 'resetpw'])->name('resetpw');