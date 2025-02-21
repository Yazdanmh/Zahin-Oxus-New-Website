<?php

use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\TrainingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\HeroController;
use App\Http\Controllers\backend\FriendsController;
use App\Http\Controllers\backend\ServicesController;
use App\Http\Controllers\backend\ServiceCategoryController;
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
use App\Http\Controllers\backend\MembersController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\TeamsController;
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
    Route::get('/services/category/{slug}', [ServiceController::class, 'category'])->name('service.category');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('service.show');

    Route::get('/projects/all', [ProjectsController::class, 'index'])->name('project.index');
    Route::get('/projects/{slug}', [ProjectsController::class, 'show'])->name('project.show');

    Route::get('/trainings/all', [TrainingsController::class, 'index'])->name('trainings.index');
    Route::get('/trainings/category/{slug}', [TrainingsController::class, 'index'])->name('trainings.category');
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

    Route::get('/team-details/{slug}', [TeamsController::class, 'show'])->name('team.show');

});

Route::middleware(['auth', PassUserDataToViews::class])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Hero
    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::post('/hero', [HeroController::class, 'update'])->name('hero.update');

    // Friends
    Route::get('/friends', [FriendsController::class, 'index'])->name('friends.index');
    Route::post('/friends', [FriendsController::class, 'store'])->name('friends.store');
    Route::post('/friends/update', [FriendsController::class, 'update'])->name('friends.update');
    Route::post('/friends/{id}', [FriendsController::class, 'destroy'])->name('friends.destroy');

    // Services
    Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServicesController::class, 'create'])->name('services.create');
    Route::post('/services', [ServicesController::class, 'store'])->name('services.store');
    Route::get('/services/{id}', [ServicesController::class, 'show'])->name('services.show');
    Route::get('/services/{id}/edit', [ServicesController::class, 'edit'])->name('services.edit');
    Route::post('/services/edit/{id}', [ServicesController::class, 'update'])->name('services.update');
    Route::post('/services/{id}', [ServicesController::class, 'destroy'])->name('services.destroy');

    // Service Categories
    Route::get('/service/categories', [ServiceCategoryController::class, 'index'])->name('service-categories.index');
    Route::get('/service/categories/create', [ServiceCategoryController::class, 'create'])->name('service-categories.create');
    Route::post('/service/categories', [ServiceCategoryController::class, 'store'])->name('service-categories.store');
    Route::get('/service/categories/{id}', [ServiceCategoryController::class, 'show'])->name('service-categories.show');
    Route::get('/service/categories/{id}/edit', [ServiceCategoryController::class, 'edit'])->name('service-categories.edit');
    Route::post('/service/categories/edit/{id}', [ServiceCategoryController::class, 'update'])->name('service-categories.update');
    Route::post('/service/categories/{id}', [ServiceCategoryController::class, 'destroy'])->name('service-categories.destroy');

    // Counter
    Route::get('/counter', [CounterController::class, 'index'])->name('counter.index');
    Route::post('/counter', [CounterController::class, 'update'])->name('counter.update');

    // Testimonails
    Route::get('/testimonails', [TestimonailsController::class, 'index'])->name('testimonails.index');
    Route::get('/testimonails/create', [TestimonailsController::class, 'create'])->name('testimonails.create');
    Route::post('/testimonails', [TestimonailsController::class, 'store'])->name('testimonails.store');
    // Route::get('/testimonails/{id}', [TestimonailsController::class, 'show'])->name('testimonails.show');
    Route::get('/testimonails/{id}/edit', [TestimonailsController::class, 'edit'])->name('testimonails.edit');
    Route::post('/testimonails/edit/{id}', [TestimonailsController::class, 'update'])->name('testimonails.update');
    Route::post('/testimonails/{id}', [TestimonailsController::class, 'destroy'])->name('testimonails.destroy');

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects/edit/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::post('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/edit/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Portfolio
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/details/{id}', [PortfolioController::class, 'show'])->name('portfolio.show');
    Route::get('/portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::post('/portfolio/edit{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::post('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

    // About
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about', [AboutController::class, 'update'])->name('about.update');
    Route::get('/about/ourmission', [AboutController::class, 'mission'])->name('ourmission');
    Route::post('/about/ourmission', [AboutController::class, 'mission_store'])->name('ourmission.store');
    Route::get('/about/ourvission', [AboutController::class, 'vision'])->name('ourvision');
    Route::post('/about/ourvission', [AboutController::class, 'vision_store'])->name('ourvision.store');

    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::post('/history', [HistoryController::class, 'update'])->name('history.update');

    // Training
    Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
    Route::get('/training/create', [TrainingController::class, 'create'])->name('training.create');
    Route::post('/training', [TrainingController::class, 'store'])->name('training.store');
    Route::get('/training/details/{id}', [TrainingController::class, 'show'])->name('training.show');
    Route::get('/training/{id}/edit', [TrainingController::class, 'edit'])->name('training.edit');
    Route::post('/training/edit/{id}', [TrainingController::class, 'update'])->name('training.update');
    Route::post('/training/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');

    // Participants
    Route::get('/participants', [ParticipantsController::class, 'index'])->name('participants.index');
    Route::get('/participants/create', [ParticipantsController::class, 'create'])->name('participants.create');
    Route::post('/participants', [ParticipantsController::class, 'store'])->name('participants.store');
    Route::get('/participants/{id}', [ParticipantsController::class, 'show'])->name('participants.show');

    Route::get('/participants/{id}/edit', [ParticipantsController::class, 'edit'])->name('participants.edit');
    Route::post('/participants/edit/{id}', [ParticipantsController::class, 'update'])->name('participants.update');
    Route::post('/participants/{id}/delete', [ParticipantsController::class, 'destroy'])->name('participants.destroy');


    // Certificates
    Route::get('/certificate', [CertificatesControlller::class, 'index'])->name('certificate.index');
    Route::get('/certificate/create', [CertificatesControlller::class, 'create'])->name('certificate.create');
    Route::post('/certificate', [CertificatesControlller::class, 'store'])->name('certificate.store');
    Route::get('/certificate/details/{id}', [CertificatesControlller::class, 'show'])->name('certificate.show');
    Route::get('/certificate/{id}/edit', [CertificatesControlller::class, 'edit'])->name('certificate.edit');
    Route::post('/certificate/edit/{id}', [CertificatesControlller::class, 'update'])->name('certificate.update');

    Route::post('/certificate/{id}', [CertificatesControlller::class, 'destroy'])->name('certificate.destroy');

    // Galleries
    Route::get('/galleries', [GalleriesController::class, 'index'])->name('galleries.index');
    Route::get('/galleries/create', [GalleriesController::class, 'create'])->name('galleries.create');
    Route::post('/galleries', [GalleriesController::class, 'store'])->name('galleries.store');
    Route::post('/galleries/{id}', [GalleriesController::class, 'destroy'])->name('galleries.destroy');

    // News
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/details/{id}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('/news/edit/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::post('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    // Academic Calendar
    Route::get('/academic-calendar', [AcademicCalendarController::class, 'index'])->name('calendars.index');
    Route::post('/academic-calendar', [AcademicCalendarController::class, 'store'])->name('calendars.store');
    Route::post('/academic-calendar/{id}', [AcademicCalendarController::class, 'destroy'])->name('calendars.destroy');

    // MOU
    Route::get('/mou', [MOUController::class, 'index'])->name('mou.index');
    Route::get('/mou/create', [MOUController::class, 'create'])->name('mou.create');
    Route::post('/mou', [MOUController::class, 'store'])->name('mou.store');
    Route::get('/mou/details/{id}', [MOUController::class, 'show'])->name('mou.show');
    Route::get('/mou/{id}/edit', [MOUController::class, 'edit'])->name('mou.edit');
    Route::post('/mou/edit/{id}', [MOUController::class, 'update'])->name('mou.update');
    Route::post('/mou/{id}/delete', [MOUController::class, 'destroy'])->name('mou.destroy');
    // Members
    Route::get('/members', [MembersController::class, 'index'])->name('members.index');
    Route::get('/members/create', [MembersController::class, 'create'])->name('members.create');
    Route::post('/members', [MembersController::class, 'store'])->name('members.store');
    Route::get('/members/details/{id}', [MembersController::class, 'show'])->name('members.show');
    Route::get('/members/{id}/edit', [MembersController::class, 'edit'])->name('members.edit');
    Route::post('/members/edit/{id}', [MembersController::class, 'update'])->name('members.update');
    Route::post('/members/{id}/delete', [MembersController::class, 'destroy'])->name('members.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

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
