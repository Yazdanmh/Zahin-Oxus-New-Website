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
use App\Http\Controllers\backend\GalleriesController;
use App\Http\Controllers\backend\NewsController;
use App\Http\Controllers\backend\AcademicCalendarController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\MOUController;
use App\Http\Controllers\backend\NotificationController;
use App\Http\Controllers\backend\ParticipantsController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrainingsController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MOUsController;
use App\Http\Middleware\ShareGlobalData;
use App\Http\Middleware\PassUserDataToViews;
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
    Route::get('/gallery/all', [GalleryController::class, 'index'])->name('gallery.index');

    Route::get('events', [EventsController::class, 'index'])->name('events.index');
    Route::get('/events/{slug}', [EventsController::class, 'show'])->name('events.show');

    Route::get('/academic-calendar', [AcademicController::class, 'index'])->name('calendar.index');
    Route::get('/mous', [MOUsController::class, 'index'])->name('mous.index');
    Route::get('/mous/{slug}', [MOUsController::class, 'show'])->name('mous.show');
});

Route::middleware(['auth', PassUserDataToViews::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
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

    Route::resource('/participants',ParticipantsController::class);
    Route::post('/participants/{id}',[ParticipantsController::class, 'update'])->name('participants.update');

    Route::resource('/certificate', CertificatesControlller::class);
    Route::post('/certificate/{id}', [CertificatesControlller::class, 'update'])->name('certificate.update');

    Route::resource('/galleries', GalleriesController::class);
    Route::post('/galleries/{id}', [GalleriesController::class, 'update'])->name('galleries.update');

    Route::resource('/news', NewsController::class);
    Route::post('/news/{id}', [NewsController::class, 'update'])->name('news.update');

    Route::get('/academic-calendar', [AcademicCalendarController::class, 'index'])->name('calendars.index');
    Route::post('/academic-calendar', [AcademicCalendarController::class, 'store'])->name('calendars.store');
    Route::delete('/academic-calendar/{id}', [AcademicCalendarController::class, 'destroy'])->name('calendars.destroy');

    Route::resource('/mou', MOUController::class);
    Route::post('/mou/{id}', [MOUController::class, 'update'])->name('mou.update');

    route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index'); 
});
Route::middleware(['auth', PassUserDataToViews::class])->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::fallback(function () {
    return Inertia::render('Admin/Error/Error');  
});
