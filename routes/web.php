<?php

use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\TrainingController;
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
use App\Http\Controllers\backend\CertificatesControlller;
use App\Http\Controllers\backend\HistoryController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrainingsController;
use App\Http\Controllers\CertificateController;
use App\Http\Middleware\ShareGlobalData;
use App\Http\Controllers\EventController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware([ShareGlobalData::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/about-us', [HomeController::class, 'about'])->name('home.about');
    Route::get('/our-mission', [HomeController::class, 'OurMission'])->name('about.mission');
    Route::get('/our-vision', [HomeController::class, 'OurVision'])->name('about.vision');
    Route::get('/services/all', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('service.show');

    Route::get('/projects/all', [ProjectsController::class, 'index'])->name('project.index');
    Route::get('/projects/{slug}', [ProjectsController::class, 'show'])->name('project.show');

    Route::get('/trainings/all', [TrainingsController::class, 'index'])->name('trainings.index');
    Route::get('/trainings/{slug}', [TrainingsController::class, 'show'])->name('trainings.show');
    Route::get('/trainings/apply/{slug}', [TrainingsController::class, 'apply'])->name('trainings.apply');
    Route::post('/trainings/apply/{id}', [TrainingsController::class, 'apply_store'])->name('trainings.apply_store');
    

    Route::get('/certificate/verify', [CertificateController::class, 'verify'])->name('certificate.verify');
    Route::post('/certificate/verify', [CertificateController::class, 'verify_post'])->name('certificate.verify');

    Route::post('/newsletter/subscribe', [HomeController::class, 'subscribe'])->name('newsletter.subscribe');

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
    
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::post('/history', [HistoryController::class, 'update'])->name('history.update');

    Route::get('/about/ourmission', [AboutController::class, 'mission'])->name('ourmission');
    Route::post('/about/ourmission', [AboutController::class, 'mission_store'])->name('ourmission');

    Route::get('/about/ourvission', [AboutController::class, 'vision'])->name('ourvision');
    Route::post('/about/ourvission', [AboutController::class, 'vision_store'])->name('ourvision');

    Route::resource('/training', TrainingController::class);
    Route::post('/training/{id}', [TrainingController::class, 'update'])->name('training.update');

    Route::resource('/certificate', CertificatesControlller::class);

});
Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
