<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Include the auth routes
require __DIR__ . '/auth.php';

// Include the log routes
require __DIR__ . '/log.php';

// Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect()->route('home');
});

// Google console platform routes
Route::get('google/oauth/redirect', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('google/oauth/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('google.callback');

// Event Details information
Route::get('event-details/{event}', [EventController::class, 'getEventDetails']);


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'profile_edit'])->name('profile_edit');
    Route::post('/profile/update', [ProfileController::class, 'profile_update'])->name('profile_update');


    Route::get('/role-management', [RolePermissionController::class, 'index'])->name('role_management');
    Route::post('/role-management/add', [RolePermissionController::class, 'role_add'])->name('role_add');
    Route::get('/role-management/delete/{id}', [RolePermissionController::class, 'role_delete'])->name('role_delete');
    Route::post('/role-management/update', [RolePermissionController::class, 'role_update'])->name('role_update');
    Route::get('/get-role/{id}', [RolePermissionController::class, 'get_role'])->name('get_role');


    Route::post('/permission-management/add', [RolePermissionController::class, 'permission_add'])->name('permission_add');
    Route::get('/permission-management/delete/{id}', [RolePermissionController::class, 'permission_delete'])->name('permission_delete');
    Route::post('/permission-management/update', [RolePermissionController::class, 'permission_update'])->name('permission_update');
    Route::get('/get-permission/{id}', [RolePermissionController::class, 'get_permission'])->name('get_permission');
    Route::get('/fetch-permissions-by-role/{id}', [RolePermissionController::class, 'fetch_permissions'])->name('fetch_permissions_by_role');


    Route::post('/role-permission-assign', [RolePermissionController::class, 'role_permission_assign'])->name('role_permission_assign');
    Route::get('/role-permission-revoke/{id}', [RolePermissionController::class, 'role_permission_revoke'])->name('role_permission_revoke');

    Route::resource('users', UserController::class);
    Route::resource('integration', IntegrationController::class);
    Route::resource('ticket', TicketController::class);
    Route::resource('payment', PaymentController::class);

    // Event Routes
    Route::resource('event', EventController::class);
    Route::get('event/approve/{event}/{value?}', [EventController::class, 'approve'])->name('event.approve');
    
    // Stripe Routes
    Route::get('/stripe/success/{ticketID}', [\App\Http\Controllers\Stripe\StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel/{ticketID}', [\App\Http\Controllers\Stripe\StripeController::class, 'cancel'])->name('stripe.cancel');

    // Banner Routes
    Route::resource('banner', BannerController::class);
    Route::put('/banners/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])
    ->name('banner.toggle-status');

    // About Us Routes
    Route::resource('about-us', AboutUsController::class);
    Route::delete('about-us/advantages/{id}', [AboutUsController::class, 'destroyAdvantage'])->name('about-us.advantages');

    // Blog Routes
    Route::resource('blog', BlogController::class);
    Route::put('/blog/{blog}/toggle-status', [BlogController::class, 'toggleStatus']);

    // FAQ Routes
    Route::resource('faq', FAQController::class);
    Route::put('/faq/{faq}/toggle-status', [FAQController::class, 'toggleStatus']);

    // Settings routes
    Route::resource('settings', SettingsController::class);
});


Route::get('/home', [\App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('home');
Route::get('/events/paginate', [\App\Http\Controllers\Frontend\FrontendController::class, 'paginate'])->name('events.paginate');
Route::get('/about-us', [\App\Http\Controllers\Frontend\FrontendController::class, 'aboutUs'])->name('about-us');
Route::get('/events', [\App\Http\Controllers\Frontend\FrontendController::class, 'events'])->name('events');
Route::get('/events/search', [\App\Http\Controllers\Frontend\FrontendController::class, 'search'])->name('events.search');
Route::get('/events/{event}/details', [\App\Http\Controllers\Frontend\FrontendController::class, 'event_details'])->name('event.details');
Route::get('/blogs', [\App\Http\Controllers\Frontend\FrontendController::class, 'blogs'])->name('blogs');
Route::get('/blog/{blog}/details', [\App\Http\Controllers\Frontend\FrontendController::class, 'blog_details'])->name('blog.details');
Route::get('/contact', [\App\Http\Controllers\Frontend\FrontendController::class, 'contact'])->name('contact');






