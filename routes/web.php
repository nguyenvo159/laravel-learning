<?php

use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome'); 

    // Query simple

    // fetch all users
    // $users = DB::select("select * from users");

    // create user
    // $user = DB::insert("insert into users (name, email, password) value (?, ?, ?)",
    //     ['Kiet 1', 
    //     'kiet1@gmail.com', 
    //     '123456']
    // );

    // update user
    // $user = DB::update("update users set email =? where id =? ", [
    //     'kiet@gmail.com', 2,
    // ]);

    //delete user
    // $user = DB::delete("delete from users where id=2") ;

    // Query builder

    // fetch user
    // $users = DB::table('users')->get() ;
    // $users = DB::table('users')->find(7) ;

    // insert user
    // $user = DB::table('users')->insert([
    //     'name' => 'Kiet 2',
    //     'email' => 'kiet2@gmail.com',
    //     'password' => '123456',
    // ]);

    // update user
    // $user = DB::table('users')->where('id', 5)->update([
    //     'email' => 'abc@gmail.com'
    // ]);

    // delete user
    // $user = DB::table('users')->where('id', 7)->delete();


    // eloquent ORM
    // $users = User::where('id',10)->first();
    // $users = User::find(15);

    // create user
    // $user = User::create([
    //     'name' => 'Kiet',
    //     'email' => 'kiet123@gmail.com',
    //     'password' => '123456',
    // ]);

    // update user
    // $user = User::where('id', 10)->update([
    //     'email' => 'abc@gmail.com'
    // ]);

    // delete user
    // $user = User::find(10);
    // $user->delete();
    
    // dd($users->name);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
