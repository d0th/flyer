<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

use Spatie\Sitemap\SitemapGenerator;

Route::post('/contact_request', 'frontend\ContactsController@contactRequestForm')->name('contactRequest');
Route::post('/request_instructors', 'frontend\ContactsController@requestInstructorsForm');
Route::post('/request_parties', 'frontend\ContactsController@requestPartiesForm');
Route::post('/claim_voucher_code', 'frontend\HomeController@claimVoucherCodeForm');
Route::post('/request_athlete', 'frontend\ContactsController@requestAthleteForm');
Route::post('/request_corporate', 'frontend\ContactsController@requestCorporateForm');
Route::post('/request_business', 'frontend\ContactsController@requestBusinessForm');
Route::post('/request_birthday', 'frontend\ContactsController@requestBirthdayForm');

Route::get('/lang/{lang}','frontend\HomeController@lang');

// Генерация карты сайта
Route::get('sitemap', function() {

    SitemapGenerator::create('http://ifly/')->writeToFile('sitemap.xml');

    return 'sitemap created';
});

///PAGES ROUTES
//Home
Route::get('/', 'frontend\HomeController@index');
//News
Route::get('/news', 'frontend\NewsController@index')->name('news');
Route::get('/news/{alias}', 'frontend\NewsController@item')->name('article');
Route::get('/akcii/{alias}', 'frontend\NewsController@akciiItem');
//Instructors
Route::get('/instructors', 'frontend\InstructorsController@index');
Route::get('/instructors/{alias}', 'frontend\InstructorsController@instructor');
//History
Route::get('/history', 'frontend\HistoryController@index');
//Contacts
Route::get('/contacts', 'frontend\ContactsController@index');
//Faq
Route::get('/faq', 'frontend\FaqController@index');
//Vacancies
Route::get('/vacancies', 'frontend\VacanciesController@index');
//Order fly
Route::get('/zakaz-poleta', 'frontend\PagesController@zakazPoleta');
//How it works
Route::get('/kak-eto-rabotaet', 'frontend\PagesController@howItWorks');
//About Us
Route::get('/about-us', 'frontend\PagesController@aboutUs');
//What awaits you
Route::get('/chto-vas-jdet', 'frontend\PagesController@whatAwaitsYou');
//Gift Cards
Route::get('/podarochnii-sertifikat', 'frontend\PagesController@giftCards');
// Sportsman tariff
Route::get('sportsman/sportsman-tariff', 'frontend\PagesController@sportsmanTariff');
// Sportsman couching
Route::get('sportsman/couching', 'frontend\InstructorsController@index');
// Sportsman couching
Route::get('sportsman/aerotube-sports', 'frontend\PagesController@aerotubeSports');
// Sportsman
Route::get('/sportsman/{alias}', 'frontend\PagesController@sportsmanPage');
//Programs page
Route::get('/programs-poletov', 'frontend\PagesController@programsIfly');
Route::get('/korporativi', 'frontend\PagesController@partiesPage');
Route::get('/dni-rojdeniya', 'frontend\PagesController@birthdayPage');
Route::get('/business', 'frontend\PagesController@businessPage');
Route::get('/stat-sportsmenom', 'frontend\PagesController@statSportsmenomPage');
//media
Route::get('/media', 'frontend\PagesController@mediaGallery');
Route::get('/media/{slug}', 'frontend\PagesController@mediaGalleryAlbum');

//Voyager
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Booking
Route::get('/typ/{status}', 'frontend\OrderController@thankYouPage');
Route::get('/booking', 'frontend\PagesController@bookingPage');
Route::get('/cart', 'frontend\PagesController@cartPage');
Route::get('/getFlying', 'frontend\PagesController@getFlying');

Route::post('/chooseDate', 'frontend\PagesController@getChooseDate');
Route::post('/chooseDay', 'frontend\PagesController@getChooseDay');
Route::post('/getChooseTime', 'frontend\PagesController@getChooseTime');


//Login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@checkLogin');


Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/create-account', 'Auth\RegisterController@showRegisterForm');
Route::post('/create-account', 'Auth\RegisterController@registerForm');


Route::group(['middleware' => ['auth:web'], 'prefix' => 'cabinet'], function () {
    Route::get('/customer-account', 'frontend\CabinetController@customerAccountPage')->name('customer-account');
    Route::get('/edit-customer', 'frontend\CabinetController@editCustomerPage');
    Route::get('/booking-voucher', 'frontend\CabinetController@bookingVoucherPage'); //календарь с активацией сертификата
    Route::post('/booking-voucher-confirm', 'frontend\CabinetController@bookingVoucherConfirmPage'); //календарь с активацией сертификата
});
