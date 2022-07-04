<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PdfPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ELearningController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\PostController as FrontendPostController;
use App\Http\Controllers\Frontend\ResultController as FrontendResultController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Frontend\ProgramController as FrontendProgramController;

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



/*
|-----------------------------------------------------------------------------------------------
|   Start Backend Route
|-----------------------------------------------------------------------------------------------
*/

Route::group([
    'prefix' => '/dashboard',
    'middleware' => ['web', 'auth'],
], function() {

    LaravelLocalization::setLocale('ar');

    Route::group(['controller' => DashboardController::class], function() {
        Route::get('/', 'index')->name('dashboard');
        Route::get('/search', 'search')->name('dashboard.search');
    });

    Route::group(['controller' => PostController::class, 'prefix' => 'posts'], function() {
        Route::get('/breaking_news', 'breakingNews')->name('posts.breaking_news');
        Route::get('/', 'index')->name('posts.index')->middleware(['role_or_permission:مدير النظام|عرض الاحداث و الاخبار']);
        Route::get('/create', 'create')->name('posts.create')->middleware(['role_or_permission:مدير النظام|إضافة حدث او خبر']);
        Route::post('/', 'store')->name('posts.store')->middleware(['role_or_permission:مدير النظام|إضافة حدث او خبر']);
        Route::get('/{post}', 'show')->name('posts.show')->middleware(['role_or_permission:مدير النظام|عرض الاحداث و الاخبار']);
        Route::get('/{post}/edit', 'edit')->name('posts.edit')->middleware(['role_or_permission:مدير النظام|تعديل حدث او خبر']);
        Route::post('/{post}/update', 'update')->name('posts.update')->middleware(['role_or_permission:مدير النظام|تعديل حدث او خبر']);
        Route::post('/{post}', 'destroy')->name('posts.destroy')->middleware(['role_or_permission:مدير النظام|حذف حدث او خبر']);
    });

    Route::group(['controller' => CategoryController::class, 'prefix' => 'categories'], function() {
        Route::get('/', 'index')->name('categories.index')->middleware(['role_or_permission:مدير النظام|عرض التصنيفات']);
        Route::get('/create', 'create')->name('categories.create')->middleware(['role_or_permission:مدير النظام|إضافة تصنيف']);
        Route::post('/', 'store')->name('categories.store')->middleware(['role_or_permission:مدير النظام|إضافة تصنيف']);
        Route::get('/{category}', 'show')->name('categories.show')->middleware(['role_or_permission:مدير النظام|عرض التصنيفات']);
        Route::get('/{category}/edit', 'edit')->name('categories.edit')->middleware(['role_or_permission:مدير النظام|تعديل تصنيف']);
        Route::post('/{category}/update', 'update')->name('categories.update')->middleware(['role_or_permission:مدير النظام|تعديل تصنيف']);
        Route::post('/{category}', 'destroy')->name('categories.destroy')->middleware(['role_or_permission:مدير النظام|حذف تصنيف']);
    });

    Route::group(['controller' => PageController::class, 'prefix' => 'pages'], function() {
        Route::get('/', 'index')->name('pages.index')->middleware(['role_or_permission:مدير النظام|عرض الصفحات']);
        Route::get('/create', 'create')->name('pages.create')->middleware(['role_or_permission:مدير النظام|إضافة صفحة']);
        Route::post('/', 'store')->name('pages.store')->middleware(['role_or_permission:مدير النظام|إضافة صفحة']);
        Route::get('/{page}', 'show')->name('pages.show')->middleware(['role_or_permission:مدير النظام|عرض الصفحات']);
        Route::get('/{page}/edit', 'edit')->name('pages.edit')->middleware(['role_or_permission:مدير النظام|تعديل صفحة']);
        Route::post('/{page}/update', 'update')->name('pages.update')->middleware(['role_or_permission:مدير النظام|تعديل صفحة']);
        Route::post('/{page}', 'destroy')->name('pages.destroy')->middleware(['role_or_permission:مدير النظام|حذف صفحة']);
    });

    Route::group(['controller' => PdfPageController::class, 'prefix' => 'pdf_pages'], function() {
        Route::get('/', 'index')->name('pdf.pages.index')->middleware(['role_or_permission:مدير النظام|عرض صفحات الـ PDF']);
        Route::get('/create', 'create')->name('pdf.pages.create')->middleware(['role_or_permission:مدير النظام|إضافة صفحة PDF']);
        Route::post('/', 'store')->name('pdf.pages.store')->middleware(['role_or_permission:مدير النظام|إضافة صفحة PDF']);
        Route::get('/{pdfPage}', 'show')->name('pdf.pages.show')->middleware(['role_or_permission:مدير النظام|عرض صفحات الـ PDF']);
        Route::get('/{pdfPage}/edit', 'edit')->name('pdf.pages.edit')->middleware(['role_or_permission:مدير النظام|تعديل صفحة PDF']);
        Route::post('/{pdfPage}/update', 'update')->name('pdf.pages.update')->middleware(['role_or_permission:مدير النظام|تعديل صفحة PDF']);
        Route::post('/{pdfPage}', 'destroy')->name('pdf.pages.destroy')->middleware(['role_or_permission:مدير النظام|حذف صفحة PDF']);
    });

    Route::group(['controller' => SlideController::class, 'prefix' => 'slides'], function() {
        Route::get('/', 'index')->name('slides.index')->middleware(['role_or_permission:مدير النظام|عرض الشريط المتحرك']);
        Route::get('/create', 'create')->name('slides.create')->middleware(['role_or_permission:مدير النظام|إضافة شريط متحرك']);
        Route::post('/', 'store')->name('slides.store')->middleware(['role_or_permission:مدير النظام|إضافة شريط متحرك']);
        Route::get('/{slide}', 'show')->name('slides.show')->middleware(['role_or_permission:مدير النظام|عرض الشريط المتحرك']);
        Route::get('/{slide}/edit', 'edit')->name('slides.edit')->middleware(['role_or_permission:مدير النظام|تعديل شريط متحرك']);
        Route::post('/{slide}/update', 'update')->name('slides.update')->middleware(['role_or_permission:مدير النظام|تعديل شريط متحرك']);
        Route::post('/{slide}', 'destroy')->name('slides.destroy')->middleware(['role_or_permission:مدير النظام|حذف شريط متحرك']);
    });

    Route::group(['controller' => ContactController::class, 'prefix' => 'contacts'], function() {
        Route::get('/', 'index')->name('contacts.index')->middleware(['role_or_permission:مدير النظام|عرض المراسلات']);
        Route::get('/{contact}', 'show')->name('contacts.show')->middleware(['role_or_permission:مدير النظام|عرض المراسلات']);
        Route::get('/{contact}/reply', 'reply')->name('contacts.reply')->middleware(['role_or_permission:مدير النظام|الرد على مراسلة']);
        Route::post('/{contact}/reply', 'sendReply')->name('contacts.send.reply')->middleware(['role_or_permission:مدير النظام|الرد على مراسلة']);
        Route::post('/{contact}', 'destroy')->name('contacts.destroy')->middleware(['role_or_permission:مدير النظام|حذف مراسلة']);
    });

    Route::group(['controller' => ProgramController::class, 'prefix' => 'programs'], function() {
        Route::get('/', 'index')->name('programs.index')->middleware(['role_or_permission:مدير النظام|عرض البرامج']);
        Route::get('/create', 'create')->name('programs.create')->middleware(['role_or_permission:مدير النظام|إضافة برنامج']);
        Route::post('/', 'store')->name('programs.store')->middleware(['role_or_permission:مدير النظام|إضافة برنامج']);
        Route::get('/{program}', 'show')->name('programs.show')->middleware(['role_or_permission:مدير النظام|عرض البرامج']);
        Route::get('/{program}/edit', 'edit')->name('programs.edit')->middleware(['role_or_permission:مدير النظام|تعديل برنامج']);
        Route::post('/{program}/update', 'update')->name('programs.update')->middleware(['role_or_permission:مدير النظام|تعديل برنامج']);
        Route::post('/{program}', 'destroy')->name('programs.destroy')->middleware(['role_or_permission:مدير النظام|حذف برنامج']);
    });


    Route::group(['controller' => ClassroomController::class, 'prefix' => 'classrooms'], function() {
        Route::get('/', 'index')->name('classrooms.index')->middleware(['role_or_permission:مدير النظام|عرض الفصول']);
        Route::post('/', 'store')->name('classrooms.store')->middleware(['role_or_permission:مدير النظام|إضافة فصل']);
        Route::post('/{classroom}/update', 'update')->name('classrooms.update')->middleware(['role_or_permission:مدير النظام|تعديل فصل']);
        Route::post('/{classroom}', 'destroy')->name('classrooms.destroy')->middleware(['role_or_permission:مدير النظام|حذف فصل']);
    });

    Route::group(['controller' => ResultController::class, 'prefix' => 'results'], function() {
        Route::get('/', 'index')->name('results.index')->middleware(['role_or_permission:مدير النظام|عرض النتائج']);
        Route::get('/create', 'create')->name('results.create')->middleware(['role_or_permission:مدير النظام|إضافة نتيجة']);
        Route::post('/', 'store')->name('results.store')->middleware(['role_or_permission:مدير النظام|إضافة نتيجة']);
        Route::get('/{result}', 'show')->name('results.show')->middleware(['role_or_permission:مدير النظام|عرض النتائج']);
        Route::get('/{result}/edit', 'edit')->name('results.edit')->middleware(['role_or_permission:مدير النظام|تعديل نتيجة']);
        Route::post('/{result}/update', 'update')->name('results.update')->middleware(['role_or_permission:مدير النظام|تعديل نتيجة']);
        Route::post('/{result}', 'destroy')->name('results.destroy')->middleware(['role_or_permission:مدير النظام|حذف نتيجة']);
    });

    Route::group(['controller' => LinkController::class, 'prefix' => 'links'], function() {
        Route::get('/', 'index')->name('links.index')->middleware(['role_or_permission:مدير النظام|عرض الروابط']);
        Route::post('/', 'store')->name('links.store')->middleware(['role_or_permission:مدير النظام|إضافة رابط']);
        Route::post('/{link}/update', 'update')->name('links.update')->middleware(['role_or_permission:مدير النظام|تعديل رابط']);
        Route::post('/{link}', 'destroy')->name('links.destroy')->middleware(['role_or_permission:مدير النظام|حذف رابط']);
        Route::post('/{link}/add-to-main-menu', 'addToMainMenu')->name('links.add.to.main.menu')->middleware(['role_or_permission:مدير النظام|إضافة رابط']);
        Route::post('/{link}/add-to-under-menu', 'addToUnderMenu')->name('links.add.to.under.menu')->middleware(['role_or_permission:مدير النظام|إضافة رابط']);
        Route::post('/{menu_link}/update-main-menu', 'updateMainMenu')->name('links.update.main.menu')->middleware(['role_or_permission:مدير النظام|تعديل رابط']);
        Route::post('/{menu_link}/update-under-menu', 'updateUnderMenu')->name('links.update.under.menu')->middleware(['role_or_permission:مدير النظام|تعديل رابط']);
        Route::post('/{menu_link}/menu-destroy', 'destroyMenuLink')->name('links.menu.destroy')->middleware(['role_or_permission:مدير النظام|حذف رابط']);
    });

    Route::group(['controller' => UserController::class, 'prefix' => 'users'], function() {
        Route::get('/', 'index')->name('users.index')->middleware(['role_or_permission:مدير النظام|عرض المستخدمين']);
        Route::get('/create', 'create')->name('users.create')->middleware(['role_or_permission:مدير النظام|إضافة مستخدم']);
        Route::post('/', 'store')->name('users.store')->middleware(['role_or_permission:مدير النظام|إضافة مستخدم']);
        Route::get('/{user}/edit', 'edit')->name('users.edit')->middleware(['role_or_permission:مدير النظام|تعديل مستخدم']);
        Route::post('/{user}/update', 'update')->name('users.update')->middleware(['role_or_permission:مدير النظام|تعديل مستخدم']);
        Route::post('/{user}', 'destroy')->name('users.destroy')->middleware(['role_or_permission:مدير النظام|حذف مستخدم']);
    });

    Route::group(['controller' => VisitorController::class, 'prefix' => 'visitors'], function() {
        Route::get('/', 'index')->name('visitors.index')->middleware(['role_or_permission:مدير النظام|عرض الزوار']);
    });

    Route::get('filemanager', function() {
        return view('backend.filemanager.index');
    })->name('filemanager')->middleware(['role_or_permission:مدير النظام|مدير الملفات']);

    Route::group(['controller' => ProfileController::class, 'prefix' => 'profile'], function() {
        Route::get('/', 'index')->name('profile.index');
        Route::post('/edit_info', 'editInfo')->name('profile.edit.info');
        Route::post('/edit_password', 'editPassword')->name('profile.edit.password');
    });

    Route::group(['controller' => SettingController::class, 'prefix' => 'settings'], function() {
        Route::get('/', 'index')->name('settings.index')->middleware(['role_or_permission:مدير النظام|الاعدادات']);
        Route::post('/update', 'update')->name('settings.update')->middleware(['role_or_permission:مدير النظام|الاعدادات']);
        Route::post('/contacts', 'contacts')->name('settings.contacts')->middleware(['role_or_permission:مدير النظام|الاعدادات']);
        Route::post('/statistics', 'statistics')->name('settings.statistics')->middleware(['role_or_permission:مدير النظام|الاعدادات']);
        Route::post('/another', 'another')->name('settings.another')->middleware(['role_or_permission:مدير النظام|الاعدادات']);
    });
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();

Route::get('/get-classrooms-for-program/{program_id}', [ClassroomController::class, 'getClassroomsForProgram'])->name('programs.get.classrooms.for.program');


/*
|-----------------------------------------------------------------------------------------------
|   Start Frontend Route
|-----------------------------------------------------------------------------------------------
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
    Route::group(['middleware' => 'visitor'], function() {

        Route::get('/', [HomeController::class, 'index'])->name('index');
	    Route::get('/search', [HomeController::class, 'search'])->name('search');

        Route::get('/e-learning', [ELearningController::class, 'index'])->name('e.learning');
        Route::get('/programs', [FrontendProgramController::class, 'index'])->name('programs');
        Route::get('/programs/{id}', [FrontendProgramController::class, 'show'])->name('programs.show');

        Route::get('/events-and-news', [FrontendPostController::class, 'index'])->name('news.events');
        Route::get('/events-and-news/{slug}', [FrontendPostController::class, 'show'])->name('news.events.single');

        Route::get('/categories/{slug}', [FrontendPostController::class, 'category'])->name('category');

        Route::get('/results', [FrontendResultController::class, 'show'])->name('results');
        Route::get('/your-result', [FrontendResultController::class, 'get'])->name('your.result');

        Route::get('/{page}', [FrontendPageController::class, 'show'])->name('page');
        Route::get('/pdf/{slug}', [FrontendPageController::class, 'pdf'])->name('pdf.page');

    });

	Route::post('/send-contact', [FrontendContactController::class, 'send'])->name('contact.send');
});


