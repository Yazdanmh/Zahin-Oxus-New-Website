<?php

use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\HeroController;
use App\Http\Controllers\backend\FriendsController;
use App\Http\Controllers\backend\ServicesController;
use App\Http\Controllers\backend\CounterController;
use App\Http\Controllers\backend\TestimonailsController;
use App\Http\Controllers\backend\ProjectController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\ShareGlobalData;
use App\Http\Controllers\EventController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([ShareGlobalData::class])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/about-us', [HomeController::class, 'about'])->name('home.about');
    Route::get('/services/all', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('service.show');
    Route::get('/projects/all',[ProjectsController::class, 'index'])->name('project.index');
    Route::get('/projects/{slug}',[ProjectsController::class, 'show'])->name('project.show');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard.index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::post('/hero', [HeroController::class, 'update'])->name('hero.update');

    Route::get('/friends', [FriendsController::class, 'index'])->name('friends.index');
    Route::post('/friends', [FriendsController::class, 'update'])->name('friends.update');
    Route::post('/friends', [FriendsController::class, 'store'])->name('friends.store');
    Route::delete('/friends/{id}', [FriendsController::class, 'destroy'])->name('friends.destroy');

    Route::resource('/services', ServicesController::class);
    Route::post('/services/edit/{id}', [ServicesController::class, 'update'])->name('services.update');

    Route::get('/counter', [CounterController::class, 'index'])->name('counter.index');
    Route::post('/counter', [CounterController::class, 'update'])->name('counter.update');

    Route::resource('/testimonails', TestimonailsController::class);
    Route::post('/testimonails/{id}', [TestimonailsController::class, 'update'])->name('testimonails.update');

    Route::resource('/projects', ProjectController::class);
    Route::post('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');

    Route::resource('/categories', CategoryController::class);

    Route::resource('/portfolio', PortfolioController::class);
    Route::post('/portfolio/{id}', [ProjectController::class, 'update'])->name('portfolio.update');

    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about', [AboutController::class, 'update'])->name('about.update');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
