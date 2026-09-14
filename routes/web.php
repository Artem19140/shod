<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\EnsureUserVerificated;
use App\Models\Organization;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('login',[LoginController::class,'login'])
    ->middleware('guest');

Route::middleware([
    'auth', 
    EnsureUserVerificated::class
])->group(function () {
    Route::get('reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('reports/create', [ReportController::class, 'create'])
        ->name('reports.create');    

    Route::post('reports', [ReportController::class, 'store'])
        ->name('reports.store');
    
    Route::delete('reports/{report}', [ReportController::class, 'destroy'])
        ->name('reports.destroy');  
    
    Route::get('reports/{report}/download', function(Report $report) {
        return Storage::download(
            $report->path, 
            $report->original_file_name
        );
    })->name('reports.download');

    Route::post('logout', function() {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('login');
    })->name('logout');
});

Route::middleware([
    'auth',
    EnsureUserVerificated::class,
    'can:admin'
])->group(function() {
    Route::get('organizations', function() {
        return view('organizations.index', [
            'organizations' => Organization::all()
        ]);
    })->name('organizations.index');

    Route::post('organizations', [OrganizationController::class, 'store'])
        ->name('organizations.store');
    
    Route::get('organizations/create', function(){
        return view('organizations.create'); 
    })->name('organizations.create');

    Route::get('users',function () {
        return view('users.index', [
            'users' => User::all()
        ]);
    })->name('users.index');

    Route::patch('users/{user}/verification', function (User $user) {
        $user->update([
            'is_verified' => ! $user->is_verified
        ]);
        return back();
    })->name('users.verification');

});