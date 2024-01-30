<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/blogs/post', [BlogController::class, 'create'])->name('blogs.store');
    Route::post('/blogs/create', [BlogController::class, 'postBlog'])->name('blogs.create');

    Route::get('blogs/viewBlogs',[BlogController::class,'getAllBlogs'])->name('blogs.viewAll');
    Route::get('blogs/viewMyBlogs',[BlogController::class,'viewMyBlog'])->name('blogs.viewMy');
    Route::get('blogs/search/{queryy?}',[BlogController::class,'searchBlog'])->name('blogs.searchBlog');

    Route::get('blogs/{id}',[BlogController::class,'viewBlog'])->name('blogs.viewOne');
    Route::put('blogs/editBlog/{id}',[BlogController::class,'editBlog'])->name('blogs.editBlog');
    Route::delete('blogs/deleteBlog/{id}',[BlogController::class,'deleteBlog'])->name('blogs.deleteBlog');

});


require __DIR__.'/auth.php';
