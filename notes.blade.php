use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);
Route::view('/', 'welcome');
Route::view('/', 'welcome', ['title' => 'My Laravel App']);


<div class="auth-buttons">
    <a href="{{ route('login') }}" class="btn btn-secondary">Log In</a>
    <a href="{{ route('register') }}" class="btn btn-primary">Create an Account</a>
</div>

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// The ->name() part is what {{ route('login') }} is looking for!
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::get('/register', [RegisterController::class, 'create'])->name('register');

