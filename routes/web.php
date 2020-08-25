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

Route::get('/', function () {
    return view('welcome');
});

*/

Route::get('/','PagesController@index')->name('index');
Route::get('/contact','PagesController@contact')->name('contact');
Route::get('/about-us','PagesController@aboutus')->name('aboutus');
Route::get('/newhome','PagesController@newhome')->name('newhome');
Route::get('/newabout','PagesController@newabout')->name('newabout');
Route::get('/newoffers',  'PagesController@newoffers')->name('newoffers');
Route::get('/newtestimonial',  'PagesController@newtestimonial')->name('newtestimonial');
Route::get('/newquality',  'PagesController@newquality')->name('newquality');
Route::get('/newreview',  'PagesController@newreview')->name('newreview');
Route::get('/newcontact','PagesController@newcontact')->name('newcontact');

// Route::get('changepassword', function() {
//     $user = App\User::where('email', 'jalpesh@anibyte.net')->first();
//     $user->password = Hash::make('123456');
//     $user->save();
 
//     echo 'Password changed successfully.';
// });
	
Route::get('/quality', function () { 
	return view('pages.quality');
});

Route::get('/faq', function () { 
	return view('pages.faq');
});
Route::get('/support', function () { 
	return view('pages.support'); 
});
Route::get('/special-offers', function () { 
	return view('pages.specialoffers'); 
});
Route::get('/terms-conditions', function () { 
	return view('pages.termsconditions'); 
});
Route::get('/privacy-policy', function () { 
	return view('pages.privacypolicy'); 
});
Route::get('/return-policy', function () { 
	return view('pages.returnpolicy'); 
});

Route::get('/searchpackage', 'PackageController@searchpackage');
Route::post('/searchpackage', 'PackageController@searchpackage');


Route::get('/newsearchtours', 'ToursController@newsearchtours');
Route::post('/newsearchtours', 'ToursController@newsearchtours');

// New Tour Checkout
Route::get('/newtourdetail/{tid}', 'ToursController@newtourdetail');
Route::get('/newtour-checkout', 'ToursController@newcheckout');
Route::get('/newpayment-success', 'ToursController@newsuccess');

// New Hotel Checkout
Route::get('/newhotel-checkout', 'HotelsController@newhotelcheckout');
Route::get('/newpayment-success', 'HotelsController@newhotelsuccess');


Route::get('/tourlocations', 'ToursController@tourlocations');

Route::post('/newsletter','NewsletterController@index');
Route::post('/contact','ContactsController@index');
Route::post('/newcontact','ContactsController@index');
Route::post('/newhome','ContactsController@index');

Auth::routes();
Route::get('/user-profile', 'HomeController@userprofile');
Route::post('/user-profile', 'HomeController@userprofilesave');
Route::get('/agentuser-profile', 'HomeController@agentuserprofile');
Route::post('/agentuser-profile', 'HomeController@agentuserprofilesave');


Route::get('/user-register', 'Auth\AgentController@userregister');
Route::post('/user-register', 'Auth\AgentController@usersave'); 
Route::get('/thankyouregistration', 'Auth\AgentController@userregister');
//Route::post('/agent/login', 'AgentController@login');

Route::get('/agency-register', 'Auth\AgencyController@register');
Route::post('/agency-register', 'Auth\AgencyController@save'); 
Route::get('agency-register/get-state-list','Auth\AgencyController@getStateList');
Route::get('agency-register/get-city-list','Auth\AgencyController@getCityList');
//Route::post('/agent/login', 'AgentController@login');

Route::get('/agent-register', 'Auth\AgentController@register');
Route::post('/agent-register', 'Auth\AgentController@save'); 
//Route::post('/agent/login', 'AgentController@login');

Route::get('/travelagent-register', 'Auth\AgentController@travelregister');
Route::post('/travelagent-register', 'Auth\AgentController@traveagentlsave'); 
//Route::post('/agent/login', 'AgentController@login');

Route::get('/hotelagent-register', 'Auth\AgentController@hotelregister');
Route::post('/hotelagent-register', 'Auth\AgentController@hotelagentlsave'); 
//Route::post('/agent/login', 'AgentController@login');

//add category
//Route::get('/addcategory', 'Auth\AdminController@addcategory');
//Route::post('/addcategory', 'Auth\AdminController@addcategorysave'); 

//Route::get('/allcategory', 'Auth\AdminController@allcategory');

//add Hotel Aminities
Route::get('/hotelaminities', 'HotelsController@hotelaminities');
Route::post('/hotelaminities', 'HotelsController@hotelaminitiessave'); 

//add Hotel Types
Route::get('/hoteltype', 'HotelsController@hoteltype');
Route::post('/hoteltype', 'HotelsController@hoteltypesave'); 


Route::get('/search', 'SearchController@generalsearch');



Route::get('/dashboard', 'HomeController@index')->name('home');

// add Packages for Umrah

Route::get('/packages-list', 'PackageController@packageslist');
Route::get('/addpackage', 'PackageController@index')->name('addpackage');
Route::post('/addpackage','PackageController@savepackage');
Route::get('/addpackagehotel','PackageController@addpackage_hotel');
Route::post('/addpackagehotel','PackageController@savepackage_hotel');
Route::get('/addpackageprice','PackageController@addpackage_price');
Route::post('/addpackageprice','PackageController@savepackage_price');

// CMS Module Admin Site
Route::get('/addcms', 'Auth\CmsController@index')->name('addcms');
Route::post('/addcms', 'Auth\CmsController@postCmsAdd');
Route::post('/update-cms', 'Auth\CmsController@postCmsUpdate');
Route::get('/delete-cms/{cmsId}', 'Auth\CmsController@getCmsDelete');
Route::get('/cms-list', 'Auth\CmsController@getAllCms');
Route::get('/cms-detail-for-update/{cmsId}', 'Auth\CmsController@getCmsDetailForUpdate');
Route::get('/update-cms-status/{cmsId}/{status}', 'Auth\CmsController@changeCmsStatus');



Route::post('/searchtours', 'ToursController@searchtours');
Route::get('/searchtours', 'ToursController@searchtours');
Route::post('/listsearchtours', 'ToursController@listsearchtours');
Route::get('/listsearchtours', 'ToursController@listsearchtours');
Route::get('/tourdetail/{tid}', 'ToursController@tourdetail');
Route::post('/checkoutorder','ToursController@checkoutorder');
Route::get('/insertorder','ToursController@insertorder');
Route::post('/insertorder','ToursController@insertorder');
Route::get('/newinsertorder','ToursController@newinsertorder');
Route::post('/newinsertorder','ToursController@newinsertorder');
Route::post('/applycoupon','ToursController@applycoupon');
Route::get('/tour-checkout', 'ToursController@checkout');
Route::get('/payment-success', 'ToursController@success');

Route::get('/addtour', 'ToursController@index')->name('addtour');
Route::post('/addtour','ToursController@savetour');

Route::get('/addtourprice','ToursController@addtour_price');
Route::post('/addtourprice','ToursController@savetour_price');

Route::get('/addtour-daywise','ToursController@addtour_daywise');
Route::post('/addtour-daywise','ToursController@savetour_daywise');
Route::get('/addtour-sightseeing','ToursController@addtour_sightseeing');
Route::post('/addtour-sightseeing','ToursController@savetour_sightseeing');
Route::get('/addtour-placevisit','ToursController@addtour_placevisit');
Route::post('/addtour-placevisit','ToursController@savetour_placevisit');

Route::get('/mybooking', 'BookingController@mybooking')->name('mybooking');
Route::get('/detailview/{tid}', 'BookingController@detailview');

Route::get('/hotelbooking', 'BookingController@hotelbooking')->name('hotelbooking');
Route::get('/hoteldetailview/{hid}', 'BookingController@hoteldetailview');



Route::get('/offers',  'ToursController@offers')->name('offers');



Route::post('/getacall',  'ToursController@getacall');
Route::get('/coupons', 'CouponsController@index');
Route::get('/coupons-add', 'CouponsController@coupon_add');
Route::post('/coupons-add', 'CouponsController@coupons_save');
Route::get('/coupons/edit/{cid}', 'CouponsController@coupon_edit');
Route::post('/coupons/edit/{cid}', 'CouponsController@coupons_update');
Route::get('/coupons/delete/{cid}', 'CouponsController@coupons_delete');
Route::post('/coupons-generate', 'CouponsController@generatecoupon');

Route::get('/tour/{tid}', 'ToursController@edittour');
Route::post('/tour/{tid}', 'ToursController@updatetour');
Route::get('/tour-price/{tid}','ToursController@edittour_price');
Route::post('/tour-price/{tid}','ToursController@updatetour_price');

Route::get('/tour-daywise/{tid}','ToursController@edittour_daywise');
Route::post('/tour-daywise/{tid}','ToursController@updatetour_daywise');
Route::get('/tour-sightseeing/{tid}','ToursController@edittour_sightseeing');
Route::post('/tour-sightseeing/{tid}','ToursController@updatetour_sightseeing');
Route::get('/tour-placevisit/{tid}','ToursController@edittour_placevisit');
Route::post('/tour-placevisit/{tid}','ToursController@updatetour_placevisit');

Route::get('/tours-list', 'ToursController@tourslist');
Route::get('/tourbooked', 'ToursController@tourbooked');
Route::get('/tour/deleteorder/{oid}', 'ToursController@deleteorder');
Route::get('/tour/delete/{tid}', 'ToursController@deletetour');
Route::get('/tourprice/delete/{tpid}', 'ToursController@deletetourprice');
Route::get('/tours-list/{tid}', 'ToursController@activetour');
Route::get('/tours-list/{tid}', 'ToursController@inActivetour');

//Checkout
//Route::post('/checkout','CheckoutController@insert')->name('frontend.checkout');
// Route::group(['middleware' => 'Admin'], function () {

// });
Route::get('/bookings', 'Auth\AdminController@bookings');
Route::get('/users', 'Auth\AdminController@users');

Route::get('/users/{uid}','HomeController@activeuser');
Route::post('/users/{uid}','HomeController@updateusers');

Route::get('/admins', ['uses'=>'Auth\AdminController@admins'])->middleware('auth');
Route::get('/admins/getadmins', ['as'=>'admins.getadmins','uses'=>'Auth\AdminController@getAdmins']);
Route::get('/agents', 'Auth\AdminController@agents');
Route::get('/agents/{uid}', 'HomeController@activeagent');
Route::get('/inactiveagents/{uid}', 'HomeController@inactiveagent');
Route::get('/editagents/{uid}', 'HomeController@editagent');
Route::post('/editagents/{uid}', 'HomeController@editagentsave');
Route::get('/agency', 'Auth\AdminController@agency');
Route::get('/agency/{uid}', 'HomeController@activeagency');

// Route::get('/travelar', 'Auth\AdminController@travelar');
// Route::get('/travelar/{uid}', 'HomeController@activetravelagent');
// Route::get('/inactivetravelar/{uid}', 'HomeController@inactivetravel');
// Route::get('/edittravel/{uid}', 'HomeController@edittravel');
// Route::post('/edittravel/{uid}', 'HomeController@edittravelsave');

Route::get('/hotelagent', 'Auth\AdminController@hotelagents');
Route::get('/hotelagent/{uid}', 'HomeController@activehotelagent');
Route::get('/allpackages', 'Auth\AdminController@allpackages')->name('allpackages');
Route::get('/alltours', 'Auth\AdminController@alltours')->name('alltours');
Route::get('/allhotels', 'Auth\AdminController@allhotels')->name('allhotels');
Route::get('/allactivities', 'Auth\AdminController@allactivities')->name('allactivities');

Route::get('/hotel/{hid}', 'HotelsController@edithotel');
Route::post('/hotel/{hid}', 'HotelsController@updatehotel');
Route::get('/deletehotel/{hid}', 'HotelsController@deletehotel');

Route::get('/hotel-roomdata/{rid}', 'HotelsController@edithotelroomdata');
Route::post('/hotel-roomdata/{rid}', 'HotelsController@updatehotelroomdata');

Route::get('/activity/{aid}', 'ActivitiesController@editactivity');
Route::post('/activity/{aid}', 'ActivitiesController@updateactivity');
Route::get('/deleteactivity/{aid}', 'ActivitiesController@deleteactivity');

Route::get('/testimonial',  'TestimonialController@testimonial_list');
Route::get('/testimonial-add',  'TestimonialController@testimonial_add');
Route::post('/testimonial-add',  'TestimonialController@testimonial_save');
Route::get('/mytestimonials',  'TestimonialController@mytestimonials');

Route::get('/review',  'ReviewController@review_list');
Route::get('/reviewall',  'ReviewController@review_alllist');
Route::get('/review-add',  'ReviewController@review_add');
Route::post('/review-add',  'ReviewController@review_save');
Route::get('/myreviews',  'ReviewController@myreviews');


Route::post('/searchactivities', 'ActivitiesController@searchactivities');
Route::post('/listsearchactivities', 'ActivitiesController@listsearchactivities');
Route::get('/getactivities', 'ActivitiesController@getactivities');
Route::get('/activitydetail/{aid}', 'ActivitiesController@activitydetail');
Route::get('/activity-checkout', 'ActivitiesController@activitycheckout');
Route::post('/checkoutactivityorder','ActivitiesController@checkoutactivityorder');
Route::post('/applyactivitycoupon','ActivitiesController@applycoupon');
Route::get('/insertactivityorder','ActivitiesController@insertactivityorder');
Route::post('/insertactivityorder','ActivitiesController@insertactivityorder');
Route::get('/activity-payment-success', 'ActivitiesController@activitysuccess');
Route::get('/activity-payment-failure', 'ActivitiesController@activityfailure');
Route::get('/activity-add',  'ActivitiesController@activity_add')->name('activity.add');
Route::post('/activity-add',  'ActivitiesController@activity_save');
Route::get('/activity-list',  'ActivitiesController@activity_list');
Route::post('/getahotelcall', 'HotelsController@getahotelcall');
Route::get('/gethotels', 'HotelsController@gethotels');

Route::post('/searchhotels', 'HotelsController@searchhotels');
Route::post('/listsearchhotels', 'HotelsController@listsearchhotels');
Route::get('/hoteldetail/{hid}', 'HotelsController@hoteldetail');
Route::post('/checkouthotelorder','HotelsController@checkouthotelorder');
Route::get('/hotel-checkout', 'HotelsController@hotelcheckout');
Route::get('/inserthotelorder','HotelsController@inserthotelorder');
Route::post('/inserthotelorder','HotelsController@inserthotelorder');
Route::get('/newinserthotelorder','HotelsController@newinserthotelorder');
Route::post('/newinserthotelorder','HotelsController@newinserthotelorder');
Route::post('/applyhotelcoupon','HotelsController@applycoupon');
Route::get('/hotel-payment-success', 'HotelsController@hotelsuccess');
Route::get('/hotel-payment-failure', 'HotelsController@hotelfailure');
Route::get('/hotels-list', 'HotelsController@hotelslist');
Route::get('/room-list/{hid}', 'HotelsController@roomlist');
Route::get('/amenities-list/{hid}', 'HotelsController@amenitieslist');
Route::get('/hotels-list/{hid}', 'HotelsController@activehotel');

Route::get('/hotel-checkoutselect', 'HotelsController@hotelcheckoutselect');
Route::post('/hoteldatefilter', 'HotelsController@hoteldatefilter');
Route::post('/hoteladultchildfilter', 'HotelsController@hoteladultchildfilter');

Route::get('/hotel-add',  'HotelsController@hotel_add');
Route::post('/hotel-add',  'HotelsController@hotel_save');
Route::get('/hotel_add_price','HotelsController@addhotel_price');
Route::post('/hotel_add_price','HotelsController@savehotel_price');
Route::get('/hotel-add-roomdata',  'HotelsController@hotel_add_roomdata');
Route::post('/hotel-add-roomdata',  'HotelsController@hotel_save_roomdata');

Route::get('/hotel-new-roomdata',  'HotelsController@hotel_new_roomdata');
Route::post('/hotel-new-roomdata',  'HotelsController@hotel_new_roomdata');

Route::get('users/{type}', 'Auth\AdminController@export_users');
Route::get('agents/{type}', 'Auth\AdminController@export_agents');
Route::get('admins/{type}', 'Auth\AdminController@export_admins');
Route::get('admins/bookings/{type}', 'Auth\AdminController@export_bookings');
Route::get('allactivities/{type}', 'Auth\AdminController@export_allactivities');
Route::get('alltours/{type}', 'Auth\AdminController@export_alltours');
Route::get('allhotels/{type}', 'Auth\AdminController@export_allhotels');
Route::get('coupons/{type}', 'CouponsController@export_coupons');
Route::get('admins/bookings/{type}', 'Auth\AdminController@export_bookings');
Route::get('activities/{type}', 'Auth\ActivitiesController@export_activities');
Route::get('tours/{type}', 'Auth\TourController@export_tours');
Route::get('hotels/{type}', 'Auth\HotelsController@export_hotels');
Route::get('bookings/{type}', 'Auth\AdminController@export_bookings');


Route::get('mybookings/{type}', 'HotelsController@export_bookings');
Route::get('myactivities/{type}', 'ActivitiesController@export_activities');
Route::get('mytours/{type}', 'ToursController@export_tours');
Route::get('myhotels/{type}', 'HotelsController@export_hotels');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

