<?php

use App\Http\Controllers\TicketsController;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BusinessHoursController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;

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

Route::get('/_t', function () {
    $telegram_channel = Notification::route('telegram', 999720736);
    $notification['content'] = 'who are you?';
    $telegram_channel->notify(new \App\Notifications\TelegramNotification($notification));
})->name('test');;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('users',[UserController::class,'index'])->name('users');

Route::get('store', function () { return Inertia::render('Store/Show'); })->name('store');
Route::get('store/products', [ProductController::class,'index'])->name('store.index');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $users = User::withCount('roles')->get();
        $roles = Role::withCount('users')->get();
        $permissions = Permission::all();
        $teams = Team::all();

    return Inertia::render('Dashboard')->with(['users' => $users, 'roles' => $roles, 'permissions' => $permissions, 'teams' => $teams]);
})->name('dashboard');

Route::middleware(['auth', 'permission:view posts'])->get('notes', function () { return Inertia::render('Notes'); })->name('notes');
Route::middleware(['auth', 'permission:view posts'])->get('notes/notes', [CardController::class,'index'])->name('notes.index');
Route::middleware(['auth', 'permission:create posts'])->post('notes', [CardController::class,'store'])->name('notes.store');
Route::middleware(['auth', 'permission:update posts'])->put('notes/{id}', [CardController::class,'update'])->name('notes.update');

Route::get('store', function () { return Inertia::render('Store/Show'); })->name('store');
Route::get('store/products', [ProductController::class,'index'])->name('store.index');
Route::post('store', [ProductController::class,'store'])->name('store.store');
Route::post('store/buy/{id}', [ProductController::class,'buy'])->name('store.buy');

Route::post('cart/add-item-to-cart/{productId}', [CartController::class,'addItem'])->name('cart.addItem');
Route::get('cart', [CartController::class,'getCartItems'])->name('cart');
Route::post('cart/print', [CartController::class,'print'])->name('cart.print');


Route::get('calendar', [CalendarController::class,'index'])->name('calendar');
Route::post('appointment', [AppointmentController::class,'store'])->name('appointments.store');
Route::post('calendar', [AppointmentController::class,'update'])->name('appointments.update');

Route::post('business-hours', [BusinessHoursController::class,'store'])->name('business-hours.store');


Route::middleware(['auth', 'role:Super-Admin|admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [AdminController::class,'index'])->name('');
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::delete('/users/{userId}/{roleId}', [UserController::class, 'removeRoleFromUser'])->name('users.removeRoleFromUser');
    Route::delete('/roles/{roleId}/{permissionId}', [RoleController::class, 'removePermissionFromRole'])->name('roles.removePermissionFromRole');
});


/*
Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::post('/chat/send-message', [ChatController::class, 'sendMessage']);
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/about-me', function (){
    return Inertia::render('AboutMe');
})->name('about-me');

Route::get('/tickets', [TicketsController::class, 'show'])->name('tickets-page');
Route::get('/getTickets', [TicketsController::class, 'get'])->name('tickets.get');
Route::post('/storeTicket', [TicketsController::class, 'store'])->name('ticket.store');
Route::post('/closeTicket', [TicketsController::class, 'close'])->name('ticket.close');
Route::post('/reopenTicket', [TicketsController::class, 'reopen'])->name('ticket.reopen');
Route::post('/closeTicketAsResolved', [TicketsController::class, 'closeAsResolved'])->name('ticket.closeAsResolved');
Route::post('/closeTicketAsUnresolved', [TicketsController::class, 'closeAsUnresolved'])->name('ticket.closeAsUnresolved');
Route::post('/reopenTicketAsUnresolved', [TicketsController::class, 'reopenAsUnresolved'])->name('ticket.reopenAsUnresolved');
Route::post('/archiveTicket', [TicketsController::class, 'archive'])->name('ticket.archive');
Route::post('/lockTicket', [TicketsController::class, 'lock'])->name('ticket.lock');
Route::post('/unlockTicket', [TicketsController::class, 'unlock'])->name('ticket.unlock');
Route::post('/markTicketAsResolved', [TicketsController::class, 'markAsResolved'])->name('ticket.markAsResolved');
Route::get('/getUsers', [UserController::class, 'getAll'])->name('users.get');



Route::middleware('auth:sanctum')->get('/chat/rooms', [ChatController::class, 'rooms']);
Route::middleware('auth:sanctum')->get('/chat/users', [ChatController::class, 'users']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomId}/messages', [ChatController::class, 'messages']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomId}/message', [ChatController::class, 'newMessage']);
Route::middleware('auth:sanctum')->post('/chat/new-room', [ChatController::class, 'newRoom']);


});
