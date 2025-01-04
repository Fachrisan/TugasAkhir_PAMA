<?php

use App\Http\Controllers\AmbilMatkulController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BeritaMatkulController;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\tables\Basic as TablesBasic;

//
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\NilaiController;

use function Symfony\Component\String\b;

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
  'pages-account-settings-account'
);
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
  'pages-account-settings-notifications'
);
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
  'pages-account-settings-connections'
);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
  'pages-misc-under-maintenance'
);

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

// // Main Page Route
// Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');
//login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/lgn', [LoginController::class, 'index']);
Route::post('/proses-login', [LoginController::class, 'login_proses'])->name('proses-login');
Route::get('/register', [RegisterBasic::class, 'index'])->name('register');
Route::post('/proses-reg', [RegisterBasic::class, 'reg'])->name('proses-reg');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
  //dashboard
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
});
Route::middleware(['auth', 'checklevel:admin,mahasiswa,dosen'])->group(function () {
  //datauser
  Route::get('/datauser', [DataUserController::class, 'index'])->name('datauser.index');
  Route::get('/user', [LoginController::class, 'user'])->name('user.index');
  Route::post('/user-store', [LoginController::class, 'store'])->name('user.store');
  Route::get('/user/{id_user}/edit', [LoginController::class, 'edit'])->name('user.edit');
  Route::put('/user/{id_user}', [LoginController::class, 'update'])->name('user.update');
  Route::delete('/user/{id_user}', [LoginController::class, 'destroy'])->name('user.destroy');

  //dosen
  // Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
  Route::resource('dosen', DosenController::class);
  Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
  Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');

  //Mahasiswa
  // Route::get('/profil', [MahasiswaController::class, 'profil'])->name('profil.index');
  Route::resource('mahasiswa', MahasiswaController::class);
  Route::get('profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile');
  //matkul
  Route::resource('matkul', MatkulController::class);

  //jadwal
  Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

  //nilai
  Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');

  //ambilmatkul
  Route::get('/ambilmatkul', [AmbilMatkulController::class, 'index'])->name('ambilmatkul.index');

  //berita
  Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
  Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
  Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
  Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
  Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
  Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

  Route::resource('mahasiswa', MahasiswaController::class);
});
