<?php

use App\Http\Controllers\Chatfile\ChatFileController;
use App\Http\Controllers\TestEventController;
use App\Http\Controllers\ToDoController;
use App\Http\Livewire\AccessControl;
use App\Http\Livewire\ChatFile;
use App\Http\Livewire\Chatting;
use App\Http\Livewire\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Invitation;
use App\Http\Livewire\Module;
use App\Http\Livewire\Project;
use App\Http\Livewire\ProjectAdmin;
use App\Http\Livewire\ProjectDetails;
use App\Http\Livewire\Role;
use App\Http\Livewire\TaskGroup;
use App\Http\Livewire\ToDo;
use App\Http\Livewire\User;
use App\Http\Livewire\UserAccess;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('project');
})->name('home');
 
Route::get('invite/{user_id}/{project_id?}', Invitation::class)->name('invite');

Route::get('login', Login::class)->name('login')->middleware('guest');

Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'jp'])) {
        abort(400);
    }
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language.switch');

// Backend routs
Route::group(['middleware' => 'auth'], function () {
    // Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('dashboard', function () {
        return redirect()->back();
    })->name('dashboard');
    Route::get('admin', ProjectAdmin::class)->name('admin')->middleware('super.admin');

    Route::get('module', Module::class)->name('module');
    Route::get('access', AccessControl::class)->name('access');
    Route::get('role', Role::class)->name('role');
    Route::get('project', Project::class)->name('project');

    Route::group(['middleware' => 'project.info', 'prefix' => 'project/{project_id}'], function () {
        Route::get('/', ProjectDetails::class)->name('project.details');
        Route::get('user', User::class)->name('project.user');
        Route::get('todo', ToDo::class)->name('project.todo');
        Route::get('task-group', TaskGroup::class)->name('project.task.group');
        // Route::get('chatting', Chatting::class)->name('project.chatting');
        Route::get('dashboard', Dashboard::class)->name('project.dashboard');
    });
    Route::get('chatting/{id}', Chatting::class)->name('chatting');
    Route::get('provide_access/{m_id}', UserAccess::class)->name('provide_access');
    Route::post('send_chat_file/{to_do_id_chat}', [ChatFileController::class, 'store'])->name('send_chat_file');
    Route::get('chat-file/{id}', ChatFile::class)->name('chat-file');



    // Route::post('add_todo', ToDoController::class, 'store')->name('store')->middleware();
    Route::post('/add_todo', [ToDoController::class, 'store'])->name('add_todo');


Route::get('/test', [TestEventController::class, 'testEvents']);


});
