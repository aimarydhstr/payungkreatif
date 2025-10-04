<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/', [App\Http\Controllers\HomepageController::class, 'index'])->name('homepage');
Route::get('/article/{slug}', [App\Http\Controllers\HomepageController::class, 'show'])->name('homepage.show');
Route::get('/category/{slug}', [App\Http\Controllers\HomepageController::class, 'category'])->name('homepage.category');
Route::get('/tag/{slug}', [App\Http\Controllers\HomepageController::class, 'tag'])->name('homepage.tag');
Route::get('/search', [App\Http\Controllers\HomepageController::class, 'search'])->name('homepage.search');

Route::view('/about', 'informations.about')->name('about');
Route::view('/contact', 'informations.contact')->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'contact'])->name('contact.submit');
Route::view('/privacy-policy', 'informations.privacy')->name('privacy');
Route::view('/disclaimer', 'informations.disclaimer')->name('disclaimer');
Route::view('/faq', 'informations.faq')->name('faq');

Route::post('/upload-image', [App\Http\Controllers\UploadController::class, 'upload'])->name('ckeditor.upload');

Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.admin');
    
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/create', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::put('/edit/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');
    });
    
    Route::prefix('categories')->group(function () {
        Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::post('/create', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::put('/edit/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.delete');
    });
    
    Route::prefix('tags')->group(function () {
        Route::get('/', [App\Http\Controllers\TagController::class, 'index'])->name('tags.index');
        Route::post('/create', [App\Http\Controllers\TagController::class, 'store'])->name('tags.store');
        Route::put('/edit/{id}', [App\Http\Controllers\TagController::class, 'update'])->name('tags.update');
        Route::delete('/delete/{id}', [App\Http\Controllers\TagController::class, 'destroy'])->name('tags.delete');
    });
    
    Route::prefix('articles')->group(function () {
        Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
        Route::get('/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('articles.create');
        Route::post('/create', [App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
        Route::get('/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/update/{id}', [App\Http\Controllers\ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/delete/{id}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.delete');
    });

    Route::prefix('knowledge-bases')->group(function () {
        Route::get('/', [App\Http\Controllers\KnowledgeBaseController::class, 'index'])->name('knowledge-bases.index');
        Route::post('/', [App\Http\Controllers\KnowledgeBaseController::class, 'store'])->name('knowledge-bases.store');
        Route::put('/{id}', [App\Http\Controllers\KnowledgeBaseController::class, 'update'])->name('knowledge-bases.update');
        Route::delete('/{id}', [App\Http\Controllers\KnowledgeBaseController::class, 'destroy'])->name('knowledge-bases.destroy');
    });

    Route::prefix('history')->group(function () {
        Route::get('/review', [App\Http\Controllers\ReviewController::class, 'history'])->name('history');
    });
});

Route::middleware(['auth', 'role:expert'])->prefix('expert')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'expert'])->name('dashboard.expert');
    
    Route::prefix('knowledge-bases')->group(function () {
        Route::get('/', [App\Http\Controllers\KnowledgeBaseController::class, 'index'])->name('expert.knowledge-bases.index');
        Route::post('/', [App\Http\Controllers\KnowledgeBaseController::class, 'store'])->name('expert.knowledge-bases.store');
        Route::put('/{id}', [App\Http\Controllers\KnowledgeBaseController::class, 'update'])->name('expert.knowledge-bases.update');
        Route::delete('/{id}', [App\Http\Controllers\KnowledgeBaseController::class, 'destroy'])->name('expert.knowledge-bases.destroy');
    });

    Route::prefix('cases')->group(function () {
        Route::get('/', [App\Http\Controllers\CaseController::class, 'index'])->name('expert.cases.index');
        Route::post('/', [App\Http\Controllers\CaseController::class, 'store'])->name('expert.cases.store');

        Route::get('/{case}/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('expert.chats.index');
        Route::post('/{case}/chat', [App\Http\Controllers\ChatController::class, 'store'])->name('expert.chats.store');
    });

    Route::prefix('reviews')->group(function () {
        Route::get('/', [App\Http\Controllers\ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/{id}', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    });

    Route::prefix('history')->group(function () {
        Route::get('/review', [App\Http\Controllers\ReviewController::class, 'history'])->name('history.review');
    });
    
    Route::prefix('consult-chat')->group(function () {
        Route::get('/', [App\Http\Controllers\ConsultChatController::class, 'index'])->name('expert.consult-chat.index');
        Route::get('/chat/{expertId}', [App\Http\Controllers\ConsultChatController::class, 'chat'])->name('expert.consult-chat.chat');
        Route::post('/chat/{expertId}', [App\Http\Controllers\ConsultChatController::class, 'store'])->name('expert.consult-chat.store');
    });
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.user');
    
    Route::prefix('cases')->group(function () {
        Route::get('/', [App\Http\Controllers\CaseController::class, 'index'])->name('cases.index');
        Route::post('/', [App\Http\Controllers\CaseController::class, 'store'])->name('cases.store');
        
        Route::get('/{case}/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chats.index');
        Route::post('/{case}/chat', [App\Http\Controllers\ChatController::class, 'store'])->name('chats.store');
    });
    
    Route::prefix('consult-chat')->group(function () {
        Route::get('/', [App\Http\Controllers\ConsultChatController::class, 'index'])->name('consult-chat.index');
        Route::get('/chat/{expertId}', [App\Http\Controllers\ConsultChatController::class, 'chat'])->name('consult-chat.chat');
        Route::post('/chat/{expertId}', [App\Http\Controllers\ConsultChatController::class, 'store'])->name('consult-chat.store');
    });
    
});