<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->hasRole('super_admin'))    return redirect()->route('admin.dashboard');
        if ($user->hasRole('business_admin')) return redirect()->route('business.dashboard');
        if ($user->hasRole('cashier'))        return redirect()->route('cashier.terminal');
        if ($user->hasRole('customer'))       return redirect()->route('customer.account');
    }
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Guest Routes (NOT LOGGED IN)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/forgot-password',        [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password',       [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password',        [AuthController::class, 'resetPassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Shared Authenticated Routes (ALL LOGGED-IN USERS)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Generic fallback dashboard (redirects by role)
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->hasRole('super_admin'))    return redirect()->route('admin.dashboard');
        if ($user->hasRole('business_admin')) return redirect()->route('business.dashboard');
        if ($user->hasRole('cashier'))        return redirect()->route('cashier.terminal');
        if ($user->hasRole('customer'))       return redirect()->route('customer.account');
        return view('dashboard');
    })->name('dashboard');

    // Theme preferences (all roles can change their own theme)
    Route::post('users/preferences', [UserPreferenceController::class, 'update'])
         ->name('users.preference');

    // Reports (permission-gated inside the controller)
    Route::get('users/reports', [UserController::class, 'reports'])
         ->name('users.reports');
});

/*
|--------------------------------------------------------------------------
| Super Admin Routes
| Role: super_admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard',         [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/businesses',        fn() => view('admin.businesses'))->name('businesses');
    Route::get('/register-business', fn() => view('admin.register-business'))->name('register-business');
    Route::get('/cards',             fn() => view('admin.cards'))->name('cards');
    Route::get('/plans',             fn() => view('admin.plans'))->name('plans');
    Route::get('/billing',           fn() => view('admin.billing'))->name('billing');
    Route::get('/api-settings',      fn() => view('admin.api-settings'))->name('api-settings');
    Route::get('/audit-logs',        fn() => view('admin.audit-logs'))->name('audit-logs');

    // User / Role / Permission management (already permission-gated in controllers)
    Route::resource('users',       UserController::class);
    Route::resource('roles',       RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

/*
|--------------------------------------------------------------------------
| Business Admin Routes
| Role: business_admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:business_admin'])->prefix('business')->name('business.')->group(function () {

    Route::get('/dashboard',       fn() => view('business.dashboard'))->name('dashboard');
    Route::get('/branches',        fn() => view('business.branches'))->name('branches');
    Route::get('/point-rules',     fn() => view('business.point-rules'))->name('point-rules');
    Route::get('/rewards',         fn() => view('business.rewards'))->name('rewards');
    Route::get('/approval-queue',  fn() => view('business.approval-queue'))->name('approval-queue');
    Route::get('/coupons',         fn() => view('business.coupons'))->name('coupons');
    Route::get('/staff',           fn() => view('business.staff'))->name('staff');
    Route::get('/ledger',          fn() => view('business.ledger'))->name('ledger');
    Route::get('/customer-lookup', fn() => view('business.customer-lookup'))->name('customer-lookup');
});

/*
|--------------------------------------------------------------------------
| Cashier Routes
| Role: cashier
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:cashier'])->prefix('cashier')->name('cashier.')->group(function () {

    Route::get('/terminal',     fn() => view('cashier.terminal'))->name('terminal');
    Route::get('/transactions', fn() => view('cashier.transactions'))->name('transactions');
    Route::get('/shift',        fn() => view('cashier.shift'))->name('shift');
    Route::get('/void-refund',  fn() => view('cashier.void-refund'))->name('void-refund');
});

/*
|--------------------------------------------------------------------------
| Customer Routes
| Role: customer
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {

    Route::get('/account',      fn() => view('customer.account'))->name('account');
    Route::get('/transactions', fn() => view('customer.transactions'))->name('transactions');
    Route::get('/rewards',      fn() => view('customer.rewards'))->name('rewards');
    Route::get('/coupons',      fn() => view('customer.coupons'))->name('coupons');
    Route::get('/profile',      fn() => view('customer.profile'))->name('profile');
});

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
*/

Broadcast::channel('admin.notifications', function ($user) {
    return $user->hasRole('super_admin');
});

/*
|--------------------------------------------------------------------------
| Test Route (remove in production)
|--------------------------------------------------------------------------
*/

Route::get('/test-pusher', function () {
    event(new App\Events\SystemNotification('Pusher is working!'));
    return 'Event fired';
});






















 //<//?//php

// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Broadcast;

// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\PermissionController;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\UserPreferenceController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     // If already logged in, send to their dashboard
//     if (auth()->check()) {
//         $user = auth()->user();
//         if ($user->hasRole('super_admin'))    return redirect()->route('admin.dashboard');
//         if ($user->hasRole('business_admin')) return redirect()->route('business.dashboard');
//         if ($user->hasRole('cashier'))        return redirect()->route('cashier.terminal');
//         if ($user->hasRole('customer'))       return redirect()->route('customer.account');
//     }
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Guest Routes (NOT LOGGED IN)
|--------------------------------------------------------------------------
*/

// Route::middleware('guest')->group(function () {

//     Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

//     Route::get('/forgot-password',         [AuthController::class, 'showForgotForm'])->name('password.request');
//     Route::post('/forgot-password',        [AuthController::class, 'sendResetLink'])->name('password.email');
//     Route::get('/reset-password/{token}',  [AuthController::class, 'showResetForm'])->name('password.reset');
//     Route::post('/reset-password',         [AuthController::class, 'resetPassword'])->name('password.update');
// });

/*
|--------------------------------------------------------------------------
| Shared Authenticated Routes (ALL LOGGED-IN USERS)
|--------------------------------------------------------------------------
*/

// Route::middleware('auth')->group(function () {

//     Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Generic fallback dashboard (redirects by role)
    // Route::get('/dashboard', function () {
    //     $user = auth()->user();
    //     if ($user->hasRole('super_admin'))    return redirect()->route('admin.dashboard');
    //     if ($user->hasRole('business_admin')) return redirect()->route('business.dashboard');
    //     if ($user->hasRole('cashier'))        return redirect()->route('cashier.terminal');
    //     if ($user->hasRole('customer'))       return redirect()->route('customer.account');
    //     return view('dashboard');
    // })->name('dashboard');

    // Theme preferences (all roles can change their own theme)
    // Route::post('users/preferences', [UserPreferenceController::class, 'update'])
    //      ->name('users.preference');

    // Reports (permission-gated inside the controller)
//     Route::get('users/reports', [UserController::class, 'reports'])
//          ->name('users.reports');
// });

/*
|--------------------------------------------------------------------------
| Super Admin Routes
| Role: super_admin
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {

//     Route::get('/dashboard',         fn() => view('admin.dashboard'))->name('dashboard');
//     Route::get('/businesses',        fn() => view('admin.businesses'))->name('businesses');
//     Route::get('/register-business', fn() => view('admin.register-business'))->name('register-business');
//     Route::get('/cards',             fn() => view('admin.cards'))->name('cards');
//     Route::get('/plans',             fn() => view('admin.plans'))->name('plans');
//     Route::get('/billing',           fn() => view('admin.billing'))->name('billing');
//     Route::get('/api-settings',      fn() => view('admin.api-settings'))->name('api-settings');
//     Route::get('/audit-logs',        fn() => view('admin.audit-logs'))->name('audit-logs');

    // User / Role / Permission management (already permission-gated in controllers)
//     Route::resource('users',       UserController::class);
//     Route::resource('roles',       RoleController::class);
//     Route::resource('permissions', PermissionController::class);
// });

/*
|--------------------------------------------------------------------------
| Business Admin Routes
| Role: business_admin
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth', 'role:business_admin'])->prefix('business')->name('business.')->group(function () {

//     Route::get('/dashboard',       fn() => view('business.dashboard'))->name('dashboard');
//     Route::get('/branches',        fn() => view('business.branches'))->name('branches');
//     Route::get('/point-rules',     fn() => view('business.point-rules'))->name('point-rules');
//     Route::get('/rewards',         fn() => view('business.rewards'))->name('rewards');
//     Route::get('/approval-queue',  fn() => view('business.approval-queue'))->name('approval-queue');
//     Route::get('/coupons',         fn() => view('business.coupons'))->name('coupons');
//     Route::get('/staff',           fn() => view('business.staff'))->name('staff');
//     Route::get('/ledger',          fn() => view('business.ledger'))->name('ledger');
//     Route::get('/customer-lookup', fn() => view('business.customer-lookup'))->name('customer-lookup');
// });

/*
|--------------------------------------------------------------------------
| Cashier Routes
| Role: cashier
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth', 'role:cashier'])->prefix('cashier')->name('cashier.')->group(function () {

//     Route::get('/terminal',    fn() => view('cashier.terminal'))->name('terminal');
//     Route::get('/transactions',fn() => view('cashier.transactions'))->name('transactions');
//     Route::get('/shift',       fn() => view('cashier.shift'))->name('shift');
//     Route::get('/void-refund', fn() => view('cashier.void-refund'))->name('void-refund');
// });

/*
|--------------------------------------------------------------------------
| Customer Routes
| Role: customer
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {

//     Route::get('/account',      fn() => view('customer.account'))->name('account');
//     Route::get('/transactions', fn() => view('customer.transactions'))->name('transactions');
//     Route::get('/rewards',      fn() => view('customer.rewards'))->name('rewards');
//     Route::get('/coupons',      fn() => view('customer.coupons'))->name('coupons');
//     Route::get('/profile',      fn() => view('customer.profile'))->name('profile');
// });

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
*/

// Broadcast::channel('admin.notifications', function ($user) {
//     return $user->hasRole('super_admin');
// });

/*
|--------------------------------------------------------------------------
| Test Route (remove in production)
|--------------------------------------------------------------------------
*/

// Route::get('/test-pusher', function () {
//     event(new App\Events\SystemNotification('Pusher is working!'));
//     return 'Event fired';
// });


// Route::middleware(['auth', 'role:cashier'])->group(function () {
//     Route::get('/cashier/terminal', function () {
//         return view('cashier.terminal');
//     })->name('cashier.terminal');
// });















//?php 
//use App\Events\SystemNotification;
//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\LoginController;
//use App\Http\Controllers\PermissionController;
//use App\Http\Controllers\RoleController;
//use App\Http\Controllers\UserController;
//use App\Http\Controllers\UserPreferenceController;
//use Illuminate\Support\Facades\Broadcast;
//use Illuminate\Support\Facades\Mail;
//use Illuminate\Support\Facades\Route; 

// Route::get('/', function () {
//     return view('welcome');
// }); 

// Route::get('/test-pusher', function () {
//     event(new App\Events\SystemNotification('Pusher is working!'));
//     return 'Event fired';
// });
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
// Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
// Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
// Broadcast::channel('admin.notifications',function($user){
// return $user->hasRole('admin');
// });
// Route::middleware(['auth'])->group(function () {

// Route::get('users/reports',[UserController::class,'reports'])->name('users.reports');
// Route::post('users/preferences',[UserPreferenceController::class,'update'])->name('users.preference');

// Route::resource('users',UserController::class);
// Route::resource('roles',RoleController::class);
// Route::resource('permissions',PermissionController::class);

// Route::get('/dashboard', function () {
//     //    return view('dashboard');
//   //  })->name('dashboard');
// //
// //});   -->
