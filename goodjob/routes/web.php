<?php

use App\Http\Controllers\ACL\PermissionController;
use App\Http\Controllers\ACL\RoleController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\JobListController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\Payments\PaypalController;
use App\Http\Controllers\Admin\Payments\PlanController;
use App\Http\Controllers\Admin\Payments\StripeController;
use App\Http\Controllers\Admin\Payments\SubscriptionsController;
use App\Http\Controllers\Admin\Payments\WebhookController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\SchedulerController;
use App\Http\Controllers\Admin\SkillsController;
use App\Http\Controllers\Admin\StaffMemberController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialController;
use App\Models\User;
use App\Http\Controllers\Website\PaypalController as webPaypalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::user()) {
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    return view('admin.signin');
})->name('home.index');

Route::get('login/{provider}', [SocialController::class, 'redirect']);
Route::get('login/{provider}/callback', [SocialController::class, 'Callback']);

require __DIR__ . '/auth.php';

Route::get('home', function () {
    return view('admin.dashboard');
});

Route::middleware(['auth', 'check_payment_status'])->prefix('admin')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::post('upload-profile-image', function(){
        create_image_from_base_64();
    })->name('upload.profile.image');
    Route::get('user-profile',[UserProfileController::class,'index'])->name('admin.users.profile');
    Route::resource('teams',TeamController::class);
    Route::post('teams/delete', [TeamController::class, 'delete'])->name('delete.teams');
    Route::resource('packages',PackageController::class);
    Route::post('packages/delete', [PackageController::class, 'delete'])->name('delete.packages');
    Route::resource('clients',ClientController::class);
    Route::post('clients/delete', [ClientController::class, 'delete'])->name('delete.clients');
    Route::resource('joblists',JobListController::class);
    Route::post('joblists/delete', [JobListController::class, 'delete'])->name('delete.joblists');
    Route::resource('places',PlaceController::class);
    Route::post('places/delete', [PlaceController::class, 'delete'])->name('delete.places');
    Route::resource('staff-members', StaffMemberController::class);
    Route::post('staff-members/delete', [StaffMemberController::class, 'delete'])->name('delete.staff.members');
    
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::get('export', [ExportController::class, 'export'])->name('export.export');
    
    Route::post('import', [ImportController::class, 'import'])->name('upload.import.csv');

    Route::get('export-pdf',[ExportController::class, 'export_pdf'])->name('export.pdf');

    Route::get('create-pdf-file', [PDFController::class, 'index'])->name('create.pdf');

    Route::resource('schedulers', SchedulerController::class);

    Route::resource('skills', SkillsController::class);
    Route::post('skills/delete', [SkillsController::class, 'delete'])->name('delete.skills');
    

    

});

Route::middleware(['auth', 'check_payment'])->group(function () {
    Route::get('payments/{id?}',[PaymentsController::class, 'index'])->name('admin.payments.index');
    Route::get('packages',[PackagesController::class, 'index'])->name('admin.packages.index');
});

Route::get('privacy-policy', function(){
    return view('pages.privacy-policy');
})->name('users.privacy.policy');
Route::get('terms-service', function(){
    return view('pages.terms-of-service');
})->name('users.terms.of.service');


Route::get('user-delete', function(){
    $email = request()->email;
    $user = User::where('email',$email)->first();
    dd($user);
});

Route::get('info', function(){
    phpinfo();
});



//payments routes

Route::get('paypal', function(){
    return view('partials.payments');
});


Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('add-product', [PayPalController::class, 'add_product'])->name('add.product');


// stripe laravel cashiers 
// Route::get('/subscribe', 'SubscriptionsController@showSubscription');
// Route::post('/subscribe', 'SubscriptionsController@processSubscription');
// welcome page only for subscribed users
// Route::get('/welcome', 'SubscriptionsController@showWelcome')->middleware('subscribed');


Route::get('subscription/create', [StripeController::class,'index'])->name('subscription.create');
Route::post('order-post', [StripeController::class,'orderPost'])->name('order-post');

// stripe create plan and subscriptions 
Route::get('/plans', [PlanController::class,'index'])->name('plans.index');
Route::get('/plan/{plan}', [PlanController::class,'show'])->name('plans.show');
Route::post('/subscription', [SubscriptionsController::class,'create'])->name('subscription.creates');

//Routes for create Plan
Route::get('create/plan', [SubscriptionsController::class,'createPlan'])->name('create.plan');
Route::post('store/plan', [SubscriptionsController::class,'storePlan'])->name('store.plan');

Route::post('stripe/webhook',[WebhookController::class,'handleWebhook']);

Route::get('checkout/{id}', [SubscriptionsController::class, 'checkout']);

Route::get('success', [SubscriptionsController::class, 'success']);

Route::get('cancels', function (){
    $oneWeekLater = date('Y-m-d', strtotime('+7 days'));
    dd(strtotime($oneWeekLater));
     print_r("<pre> dfgsdfgsdfg ". shell_exec ('composer dump-autoload')."</pre>");
     dd();
    dd('cancel');
});


Route::post('stripe-checkout-payment/{id?}', [StripeController::class, 'stripe_checkout'])->name('stripe.checkout.payment');
Route::get('success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

Route::get('paywithpaypal' ,[webPaypalController::class,'payWithPaypal'])->name('paywithpaypal');
Route::post('paypal/{id?}', [webPaypalController::class, 'postPaymentWithpaypal'])->name('paypal');
Route::get('paypal',[webPaypalController::class, 'getPaymentStatus'])->name('status');