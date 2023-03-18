<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

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

Route::get('/policy', 'Frontend\HomeController@policy')->name('policy');
Route::get('/book_cab', 'Frontend\HomeController@book_cab')->name('book_cab');
Route::get('/booking_confirm', 'Frontend\HomeController@booking_confirm')->name('booking_confirm');
Route::get('/service', 'Frontend\HomeController@service')->name('service');

Route::post('/captcha-validation', 'Frontend\ContactController@contactdetails')->name('contactdetails');
Route::get('/reload-captcha', 'Frontend\ContactController@reloadCaptcha')->name('reloadCaptcha');

Route::get('session/get','SessionController@accessSessionData');
Route::get('session/set','SessionController@storeSessionData');
Route::get('session/remove','SessionController@deleteSessionData');
Route::get('/', 'Frontend\HomeController@index')->name('home.index');
Route::get('otp/{otp}', 'Frontend\HomeController@otpindex')->name('home.otpindex');
Route::get('/about-us', 'Frontend\UserController@about')->name('about.index');
Route::get('/contact-us', 'Frontend\ContactController@index')->name('contact.index'); 
Route::get('/one-way-cab', 'Frontend\Search_cab@routes')->name('cab_result.routes');
Route::Post('/one-way-cab/{pick_city}-To-{drop_city}', 'Frontend\Search_cab@routes')->name('routs.cab');

Route::get('/one-way-cab/-to-{drop_city}', 'Frontend\OnewaybookcabController@error_oneway');
Route::get('/one-way-cab/{pick_city}-to-', 'Frontend\OnewaybookcabController@error_oneway');
Route::get('/one-way-cab/{pick_city}--{drop_city}', 'Frontend\OnewaybookcabController@error_oneway');
Route::get('/one-way-cab/{pick_city}-to{drop_city}', 'Frontend\OnewaybookcabController@error_oneway');
Route::get('/one-way-cab/{pick_city}to-{drop_city}', 'Frontend\OnewaybookcabController@error_oneway');
Route::get('/one-way-cab/{pick_city}', 'Frontend\Search_cab@special_routes')->name('special_routes');
Route::get('/oneway-routs', 'Frontend\RoutesController@index')->name('routs.index');
Route::get('/search_cab', 'Frontend\Search_cab@index')->name('search_cab.index');
Route::get('/user-register', 'Frontend\UserController@ragister')->name('ragister.index');
Route::get('/onewaybookcab/{onewaydetails_id}', 'Frontend\OnewaybookcabController@index')->name('onewaybookcab.index');
Route::Get('/localbookcab/{localdetails_id}', 'Frontend\OnewaybookcabController@localindex')->name('localbookcab.index');
Route::Post('/multicitybookcab', 'Frontend\OnewaybookcabController@multyindex')->name('multicitybookcab.index');
Route::get('/onewayconfirm', 'Frontend\OnewaybookcabController@onewayconfirm')->name('onewayconfirm');
Route::get('/localconfirm', 'Frontend\OnewaybookcabController@localconfirm')->name('localconfirm');
Route::get('/multyconfirm', 'Frontend\OnewaybookcabController@multyconfirm')->name('multyconfirm');
Route::get('/login','Frontend\UserController@signup')->name('signup'); 
Route::get('/signup','Frontend\RagisterController@signup')->name('signup'); 
Route::get('/cab_result', 'Frontend\Search_cab@index1')->name('cab_result');
Route::get('/oneway', 'Frontend\OnewaybookcabController@oneway')->name('onewaybookcab');
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
Route::get('/logout','Frontend\RagisterController@logout')->name('logout');
Route::get('/otp', 'Frontend\RagisterController@otp')->name('otp.index');
Route::get('/getcitydata', 'Frontend\HomeController@getcitydata')->name('getcitydata');
Route::get('/myaccount','Frontend\MyaccountController@index')->name('myaccount');
Route::get('/complate','Frontend\MyaccountController@complate')->name('complate');
Route::get('/onewaybookcab', 'Frontend\OnewaybookcabController@onewaybookcab')->name('onewaybookcab');
Route::get('/profile/{id}','Frontend\MyaccountController@profile')->name('profile');
Route::get('/feedback','Frontend\MyaccountController@feedback')->name('feedback');
Route::patch('/update/{id}','Frontend\MyaccountController@profile_update')->name('profile_update');
Route::post('/coupon_check','Multy_bookingsController@coupon_check')->name('coupon_check');
Route::post('/modal_id','Frontend\search_cab@modal_show')->name('modal_show');
Route::post('/localmodal_id','Frontend\search_cab@local_modal_show')->name('local_modal_show');
Route::post('/multymodal_id','Frontend\search_cab@multy_modal_show')->name('multy_modal_show');

Route::Post('/faredetails','Frontend\RagisterController@faredetails')->name('faredetails');
Route::Post('/localfaredetails','Frontend\RagisterController@localfaredetails')->name('localfaredetails');
Route::Post('/popup_values','Frontend\MyaccountController@popup_values')->name('popup_values'); 
Route::Post('/local_popup_values','Frontend\MyaccountController@local_popup_values')->name('local_popup_values');
Route::Post('/multy_popup_values','Frontend\MyaccountController@multy_popup_values')->name('multy_popup_values');
Route::post('/contact_inquiry', 'Frontend\RagisterController@contact_inquiry')->name('contact_inquiry.index');
Route::post('/otp_check','Frontend\RagisterController@otp_check')->name('otp_check');
Route::post('/store','Frontend\OnewaybookcabController@store')->name('onewaybookcab.store');
Route::post('/localstore','Frontend\OnewaybookcabController@localstore')->name('localbookcab.store');
Route::post('/multystore','Frontend\OnewaybookcabController@multystore')->name('multybookcab.store');
Route::post('/ragister','Frontend\RagisterController@ragister')->name('ragister.store');
Route::post('/loginstore','Frontend\RagisterController@loginstore')->name('login.store');
Route::post('/homelogin','Frontend\RagisterController@homelogin')->name('homelogin');
Route::post('/homeragister','Frontend\RagisterController@homeragister')->name('homeragister');
Route::Post('/route_cab', 'Frontend\Search_cab@route_cab')->name('route_cab.index'); 
Route::Post('/multi_cab', 'Frontend\Search_cab@multicity')->name('multicity.index'); 
Route::Post('/contactdetails', 'Frontend\ContactController@contactdetails')->name('contact.contactdetails');
Route::Post('/enquiry', 'Frontend\HomeController@enquiry')->name('home.enquiry');
Route::post('/onewaygetDropcity','Frontend\HomeController@onewaygetDropcity')->name('onewayhome.getDropcity');
Route::post('/getlocalPackage','Frontend\HomeController@getlocalPackage')->name('home.getlocalPackage');

Route::Post('/one-way-cab', 'Frontend\Search_cab@index')->name('cab_result.index');

Route::Post('/local-search-cab', 'Frontend\Search_cab@local_index')->name('localcab_result.index');
Route::post('/onewayotp_check','Frontend\RagisterController@onewayotp_check')->name('onewayotp_check');
Route::post('/route_otp','Frontend\RagisterController@route_otp')->name('route_otp');
Route::post('/resend_otp','Frontend\RagisterController@resend_otp')->name('resend_otp');
Route::Post('/routeid','Frontend\Search_cab@routeid')->name('routeid');
Route::Post('/send-captcha','Frontend\ContactController@send_captcha')->name('send_captcha');
Route::Post('/onewaybookcab', 'Frontend\OnewaybookcabController@error_oneway')->name('error_oneway.index');
Route::Post('/localbookcab', 'Frontend\OnewaybookcabController@error_oneway')->name('error_oneway.index');
Route::get('/multi_cab', 'Frontend\OnewaybookcabController@error_oneway')->name('error_oneway.index');


Route::get('admin', 'AuthController@login');
Route::Post('/login-admin', 'AuthController@login_admin')->name('login_admin.index');

Auth::routes();
Route::get('/admin/dashboard', 'HomeController@index')->name('home');
Route::Post('/admin-logout','HomeController@admin_logout')->name('admin.logout');
Route::get('/dashboard-analaystic','HomeController@analaystic')->name('analaystic');
Route::get('/multicity-list','HomeController@multycity')->name('multycity');
Route::group(['middleware' => ['auth']], function() {
Route::get('/admin/change-password', 'ChangePasswordController@index');
Route::post('/admin/change-password', 'ChangePasswordController@store')->name('change-password');
Route::get('/admin/advertisements','CuponController@advertisements')->name('advertisements');

    Route::prefix('/admin/user_details')->group(function () {
        Route::get('/','UserController@index')->name('users.index');
        Route::get('/add','UserController@create')->name('users.create');
        Route::get('/edit/{id}','UserController@edit')->name('users.edit');
        Route::get('/view/{id}','UserController@view_user')->name('users.view');
        Route::get('/destroy/{id}','UserController@destroy')->name('users.destroy');

        Route::post('/store','UserController@store')->name('users.store');
        Route::patch('/update/{id}','UserController@update')->name('users.update');
        Route::post('deleteAll','UserController@deleteAll')->name("users.deleteAll");

    });
    Route::prefix('/admin/common_page')->group(function(){
        Route::get('/','UserController@settings')->name('site_settings');
        Route::Patch('/update/{id}','UserController@setting_update')->name('settings.update');
    });

    Route::prefix('/admin/city')->group(function () {
        Route::get('/','PickupController@index')->name('pickup.index');
        Route::get('/add','PickupController@create')->name('pickup.create');
        Route::get('/destroy/{id}','PickupController@destroy')->name('pickup.destroy');
        Route::get('/edit/{id}','PickupController@edit')->name('pickup.edit');
        Route::post('/store','PickupController@store')->name('pickup.store');
        Route::patch('/update/{id}','PickupController@update')->name('pickup.update');
        Route::get('/changestatus/{nm}/{id}', 'PickupController@changestatus');
        Route::post('deleteAll','PickupController@deleteAll')->name("pickup.deleteAll");


    });
    Route::prefix('/dropcity')->group(function () {
        Route::get('/','DropcityController@index')->name('dropcity.index');
        Route::get('/add','DropcityController@create')->name('dropcity.create');
        Route::post('/store','DropcityController@store')->name('dropcity.store');
        Route::get('/destroy/{id}','DropcityController@destroy')->name('dropcity.destroy');
        Route::get('/edit/{id}','DropcityController@edit')->name('dropcity.edit');
        Route::patch('/update/{id}','DropcityController@update')->name('dropcity.update');
        Route::post('deleteAll','DropcityController@deleteAll')->name("dropcity.deleteAll");
    });
    Route::prefix('/admin/localdetails')->group(function () {
        Route::get('/','LocaldetailsController@index')->name('localdetails.index');
        Route::get('/add','LocaldetailsController@create')->name('localdetails.create');
        Route::post('/store','LocaldetailsController@store')->name('localdetails.store');
        Route::get('/destroy/{id}','LocaldetailsController@destroy')->name('localdetails.destroy');
        // Route::get('/edit/{id}','LocaldetailsController@edit')->name('localdetails.edit');
        Route::get('/edit/{pick_city}-to-{drop_city}','LocaldetailsController@edit')->name('localdetails.edit');
        Route::Post('/update','LocaldetailsController@update')->name('localdetails.update');
        Route::get('/changestatus/{nm}/{id}', 'LocaldetailsController@changestatus');
        Route::post('deleteAll','LocaldetailsController@deleteAll')->name("localdetails.deleteAll");
    });
    Route::prefix('/admin/onewaydetails')->group(function () {
        Route::get('/','OnewaydetailsController@index')->name('onewaydetails.index');
        Route::get('/add','OnewaydetailsController@create')->name('onewaydetails.create');
   Route::post('/check_cab','OnewaydetailsController@check_cab')->name('onewaydetails.check_cab');
        Route::get('/increase_descrease_rate','OnewaydetailsController@increase')->name('onewaydetails.increase');
        Route::Post('/increase_add','OnewaydetailsController@increase_add')->name('increase_add');
        Route::get('/increase_descrease_list','OnewaydetailsController@increase_list')->name('increase.index');
        Route::get('/changestatus/{nm}/{id}', 'OnewaydetailsController@changestatus');

        Route::get('/increse_change/{nm}/{id}', 'OnewaydetailsController@increse_change');
        Route::post('increse_deleteAll','OnewaydetailsController@increse_deleteAll')->name("increse_deleteAll");



        Route::get('/single-add/{pick_city}-to-{drop_city}','OnewaydetailsController@single_create')->name('onewaydetails.single');
        Route::post('/store','OnewaydetailsController@store')->name('onewaydetails.store');
        Route::get('/destroy/{id}','OnewaydetailsController@destroy')->name('onewaydetails.destroy');
        Route::get('/edit/{pick_city}-to-{drop_city}','OnewaydetailsController@edit')->name('onewaydetails.edit');
        Route::Post('/update','OnewaydetailsController@update')->name('onewaydetails.update');
        Route::post('/getDropcity','OnewaydetailsController@getDropcity')->name('onewaydetails.getDropcity');
        Route::post('/updateDropcity','OnewaydetailsController@updateDropcity')->name('onewaydetails.updateDropcity');
        Route::get('/changestatus/{nm}/{id}', 'OnewaydetailsController@changestatus');
        Route::post('deleteAll','OnewaydetailsController@deleteAll')->name("onewaydetails.deleteAll");
        Route::post('/get_estimate','OnewaydetailsController@get_estimate')->name('onewaydetails.estimate');

    });

    Route::prefix('/admin/onewaybookings')->group(function () {
        Route::get('/','OnewaybookingsController@index')->name('onewaybookings.index');
        Route::get('/add','OnewaybookingsController@create')->name('onewaybookings.create');
        Route::post('/store','OnewaybookingsController@store')->name('onewaybookings.store');
        Route::get('/destroy/{id}','OnewaybookingsController@destroy')->name('onewaybookings.destroy');
        Route::get('/edit/{id}','OnewaybookingsController@edit')->name('onewaybookings.edit');
        Route::patch('/update/{id}','OnewaybookingsController@update')->name('onewaybookings.update');
        Route::post('/getDropcity','OnewaybookingsController@getDropcity')->name('onewaybookings.getDropcity');
        Route::post('/updateDropcity','OnewaybookingsController@updateDropcity')->name('onewaybookings.updateDropcity');
        Route::get('/changestatus/{nm}/{id}', 'OnewaybookingsController@changestatus');
        Route::post('deleteAll','OnewaybookingsController@deleteAll')->name("onewaybookings.deleteAll");
        Route::post('/user_check','OnewaybookingsController@user_check')->name("user_check");
        Route::post('/get_cab_type','OnewaybookingsController@get_cab_type')->name('onewaybookings.get_cab_type');
        Route::post('/check_cab','OnewaybookingsController@check_cab')->name('onewaybookings.check_cab');
        Route::post('/get_gross_total','OnewaybookingsController@get_gross_total')->name('onewaybookings.get_gross_total');
        Route::get('/onewayorder/{id}','OnewaybookingsController@onewayorder')->name('onewayorder');


        Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);


 
    });  
    Route::prefix('/admin/cab_booking')->group(function () {
        Route::get('/','Multy_bookingsController@index')->name('multy_bookings.index');
        Route::get('/add','Multy_bookingsController@create')->name('multy_bookings.create');
        Route::post('/store','Multy_bookingsController@store')->name('multy_bookings.store');
        Route::post('/extra_charge','Multy_bookingsController@charge_store')->name('charge.store');

        Route::get('/ganrate_invoice/{id}','Multy_bookingsController@ganrate_invoice')->name('ganrate_invoice');
        Route::get('/send_mail/{id}','Multy_bookingsController@send_mail')->name('send_mail');
 
        Route::get('/invoice','Multy_bookingsController@invoice')->name('multy_bookings.invoice');
        Route::get('/invoice_view','Multy_bookingsController@invoice_view')->name('invoice_view');

        Route::get('/destroy/{id}','Multy_bookingsController@destroy')->name('multy_bookings.destroy');
        Route::get('/edit/{id}','Multy_bookingsController@edit')->name('multy_bookings.edit');
        Route::patch('/update/{id}','Multy_bookingsController@update')->name('multy_bookings.update');
        Route::post('/getDropcity','Multy_bookingsController@getDropcity')->name('multy_bookings.getDropcity');
        Route::post('/updateDropcity','Multy_bookingsController@updateDropcity')->name('multy_bookings.updateDropcity');
        Route::get('/changestatus/{nm}/{id}', 'Multy_bookingsController@changestatus');
        Route::post('deleteAll','Multy_bookingsController@deleteAll')->name("multy_bookings.deleteAll");
        Route::post('/user_check','Multy_bookingsController@user_check')->name("user_check");
        Route::get('/booking_delete/{id}', 'Multy_bookingsController@booking_delete');
        Route::post('/get_cab_type','Multy_bookingsController@get_cab_type')->name('multy_bookings.get_cab_type');
        Route::post('/check_cab','Multy_bookingsController@check_cab')->name('multy_bookings.check_cab');
        Route::post('/get_gross_total','Multy_bookingsController@get_gross_total')->name('multy_bookings.get_gross_total');
        Route::get('/oneway_order/{id}','Multy_bookingsController@oneway_order')->name('oneway_order');
        Route::get('/localway_order/{id}','Multy_bookingsController@localway_order')->name('localway_order');
        Route::get('/multyway_order/{id}','Multy_bookingsController@multyway_order')->name('multyway_order');


        Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);



    });

    Route::prefix('/admin/localbookings')->group(function () {
        Route::get('/','LocalbookingsController@index')->name('localbookings.index');
        Route::get('/add','LocalbookingsController@create')->name('localbookings.create');
        Route::post('/store','LocalbookingsController@store')->name('localbookings.store');
        Route::get('/destroy/{id}','LocalbookingsController@destroy')->name('localbookings.destroy');
        Route::get('/edit/{id}','LocalbookingsController@edit')->name('localbookings.edit');
        Route::patch('/update/{id}','LocalbookingsController@update')->name('localbookings.update');
        Route::post('/getDropcity','LocalbookingsController@getDropcity')->name('localbookings.getDropcity');
        Route::post('/updateDropcity','LocalbookingsController@updateDropcity')->name('localbookings.updateDropcity');
        Route::get('/changestatus/{nm}/{id}', 'LocalbookingsController@changestatus');
        Route::post('deleteAll','LocalbookingsController@deleteAll')->name("localbookings.deleteAll");
        Route::post('/check_cab','LocalbookingsController@check_cab')->name('localbookings.check_cab');
        Route::post('/get_cab_type','LocalbookingsController@get_cab_type')->name('localbookings.get_cab_type');
        Route::post('/user_check','LocalbookingsController@user_check')->name('localbookings.user_check');
        Route::post('/get_gross_total','LocalbookingsController@get_gross_total')->name('localbookings.get_gross_total');
        Route::get('/localwayorder/{id}','LocalbookingsController@localwayorder')->name('localwayorder');


    });
    Route::prefix('/admin/driver_details')->group(function () {
        Route::get('/','DriverController@index')->name('driver.index');
        Route::get('/add','DriverController@create')->name('driver.create');
        Route::post('/store','DriverController@store')->name('driver.store');
        Route::get('/destroy/{id}','DriverController@destroy')->name('driver.destroy');
        Route::get('/edit/{id}','DriverController@edit')->name('driver.edit');

        Route::get('/driver_customer/{id}','DriverController@driver_customer')->name('driver_customer');

        Route::patch('/update/{id}','DriverController@update')->name('driver.update');
        Route::post('deleteAll','DriverController@deleteAll')->name("driver.deleteAll");
        Route::get('/select/{id}','DriverController@select')->name("driver.select");
        Route::post('/dataselect','DriverController@dataselect')->name("dataselect");  
        Route::get('/localselect/{id}','DriverController@localselect')->name("driver.localselect");
        Route::post('/localdataselect','DriverController@localdataselect')->name("localdataselect");
        Route::get('/multyselect/{id}','DriverController@multyselect')->name("driver.multyselect");
        Route::post('/multydataselect','DriverController@multydataselect')->name("multydataselect");
        Route::get('/changestatus/{id}', 'DriverController@changestatus');
        Route::get('/status_change/{id}', 'DriverController@status_change');
        Route::get('/status_active/{id}', 'DriverController@status_active');
        Route::get('/select-oneway-driver/{id}', 'DriverController@driver_assign')->name("driver.assign");
        Route::Post('/driver-oneway', 'DriverController@driver_oneway')->name("driver_oneway");
        Route::get('/select-localway-driver/{id}', 'DriverController@driver_local_assign')->name("driver_local_assign");
        Route::Post('/driver-localway', 'DriverController@driver_localway')->name("driver_localway");
        Route::get('/select-RoundTrip-driver/{id}', 'DriverController@driver_multy_assign')->name("driver_multy_assign");
        Route::Post('/driver-RoundTrip', 'DriverController@driver_multyway')->name("driver_multyway");

       Route::get('/driversma','DriverController@dataselect')->name('driversma');
    });
    Route::prefix('/admin/testimonial')->group(function () {
        Route::get('/','TestimonialController@index')->name('testimonial.index');
        Route::get('/add','TestimonialController@create')->name('testimonial.create');
        Route::post('/store','TestimonialController@store')->name('testimonial.store');
        Route::get('/destroy/{id}','TestimonialController@destroy')->name('testimonial.destroy');
        Route::get('/edit/{id}','TestimonialController@edit')->name('testimonial.edit');
        Route::patch('/update/{id}','TestimonialController@update')->name('testimonial.update');
        Route::get('/view/{id}','TestimonialController@view_testimonial')->name('testimonial.view');

        Route::post('deleteAll','TestimonialController@deleteAll')->name("testimonial.deleteAll");


    });
    Route::prefix('/admin/cab_master')->group(function () {
        Route::get('/','Cab_masterController@index')->name('cab_master.index');
        Route::get('/add','Cab_masterController@create')->name('cab_master.create');
        Route::post('/store','Cab_masterController@store')->name('cab_master.store');
        Route::get('/destroy/{id}','Cab_masterController@destroy')->name('cab_master.destroy');
        Route::get('/edit/{id}','Cab_masterController@edit')->name('cab_master.edit');
        Route::patch('/update/{id}','Cab_masterController@update')->name('cab_master.update');
        Route::get('/view/{id}','Cab_masterController@view_cab_master')->name('cab_master.view');
        Route::get('/changestatus/{nm}/{id}', 'Cab_masterController@changestatus');
        Route::post('deleteAll','Cab_masterController@deleteAll')->name("cab_master.deleteAll");


    });
    Route::prefix('/admin/package')->group(function () {
        Route::get('/','packageController@index')->name('package.index');
        Route::get('/add','packageController@create')->name('package.create');
        Route::post('/store','packageController@store')->name('package.store');
        Route::get('/destroy/{id}','packageController@destroy')->name('package.destroy');
        Route::get('/edit/{id}','packageController@edit')->name('package.edit');
        Route::patch('/update/{id}','packageController@update')->name('package.update');
        Route::get('/view/{id}','packageController@view_package')->name('package.view');
        Route::get('/changestatus/{nm}/{id}', 'packageController@changestatus');
        Route::post('deleteAll','packageController@deleteAll')->name("package.deleteAll");


    });
    Route::prefix('/admin/coupon')->group(function () {
        Route::get('/','CuponController@index')->name('cupon.index');
        Route::get('/add','CuponController@create')->name('cupon.create');
        Route::post('/store','CuponController@store')->name('cupon.store');
        Route::get('/destroy/{id}','CuponController@destroy')->name('cupon.destroy');
        Route::get('/edit/{id}','CuponController@edit')->name('cupon.edit');
        Route::patch('/update/{id}','CuponController@update')->name('cupon.update');
        Route::get('/view/{id}','CuponController@view_cupon')->name('cupon.view');
        Route::post('deleteAll','CuponController@deleteAll')->name("cupon.deleteAll");
        Route::get('/changestatus/{id}', 'CuponController@changestatus');
        Route::get('/status_change/{id}', 'CuponController@status_change');
        Route::patch('/update_ads/{id}','CuponController@update_ads')->name('update_ads');
        Route::Post('/home_coupon','CuponController@home_cupon')->name('home.coupon');

    });
    Route::prefix('/admin/requestcall')->group(function () {
        Route::get('/','requestcallController@index')->name('requestcall.index');
        Route::post('/store','requestcallController@store')->name('requestcall.store');
        Route::get('/destroy/{id}','requestcallController@destroy')->name('requestcall.destroy');
        Route::get('/view/{id}','requestcallController@view_requestcall')->name('requestcall.view');
        Route::post('deleteAll','requestcallController@deleteAll')->name("request.deleteAll");

    });
    Route::prefix('/admin/multicitycabs')->group(function () {
        Route::get('/','MulticitycabsController@index')->name('multicitycabs.index');
        Route::Patch('/updateSuv','MulticitycabsController@updateSuv')->name('multicitycabs.updateSuv');
        Route::Patch('/updateSedan','MulticitycabsController@updateSedan')->name('multicitycabs.updateSedan');
        Route::Patch('/updateInnova','MulticitycabsController@updateInnova')->name('multicitycabs.updateInnova');
        Route::Patch('/updateTempo','MulticitycabsController@updateTempo')->name('multicitycabs.updateTempo');
        Route::Patch('/updateprimesedan','MulticitycabsController@updateprimesedan')->name('multicitycabs.updateprimesedan');
        Route::Patch('/updateprimesuv','MulticitycabsController@updateprimesuv')->name('multicitycabs.updateprimesuv');
        Route::Patch('/updateNote','MulticitycabsController@updateNote')->name('multicitycabs.updateNote');
        Route::Patch('/update','MulticitycabsController@update_onewaynote')->name('multicitycabs.onewaynote');
        Route::Patch('/update-localnote','MulticitycabsController@update_localnote')->name('multicitycabs.localNote');
        // Route::get('/update-Note','MulticitycabsController@oneway_note')->name('updateNote');
        Route::get('/Update_Note/{id}','MulticitycabsController@update_Note')->name('updateNote');
    });

    Route::prefix('/admin/multicityprices')->group(function () {
        Route::get('/','MulticitypricesController@index')->name('multicityprices.index');
        Route::patch('/insertrecord','MulticitypricesController@insertrecord')->name('insertrecord');
    });
    Route::prefix('/admin/inquries')->group(function () {
        Route::get('/','InquriesController@index')->name('inquries.index');
        Route::post('deleteAll','InquriesController@deleteAll')->name("inquries.deleteAll");

    });
    Route::prefix('/admin/visitor')->group(function () {
        Route::get('/','visitorController@index')->name('visitor.index');
        Route::post('/store','visitorController@store')->name('visitor.store');
        Route::get('/destroy/{id}','visitorController@destroy')->name('visitor.destroy');
        Route::get('/view/{id}','visitorController@view_visitor')->name('visitor.view');
        Route::post('deleteAll','visitorController@deleteAll')->name("visitor.deleteAll");

    });
    Route::prefix('/admin/multicitybookings')->group(function () {
        Route::get('/','MulticitybookingsController@index')->name('multicitybookings.index');
        Route::get('/add','MulticitybookingsController@create')->name('Multicitybookings.create');
        Route::post('/store','MulticitybookingsController@store')->name('Multicitybookings.store');
        Route::get('/destroy/{id}','MulticitybookingsController@destroy')->name('multicitybookings.destroy');
        Route::get('/edit/{id}','MulticitybookingsController@edit')->name('Multicitybookings.edit');
        Route::patch('/update/{id}','MulticitybookingsController@update')->name('Multicitybookings.update');
        Route::post('/getDropcity','MulticitybookingsController@getDropcity')->name('Multicitybookings.getDropcity');
        Route::post('/updateDropcity','MulticitybookingsController@updateDropcity')->name('Multicitybookings.updateDropcity');
        Route::get('/changestatus/{nm}/{id}', 'MulticitybookingsController@changestatus');

        Route::post('deleteAll','MulticitybookingsController@deleteAll')->name("multicitybookings.deleteAll");
        Route::post('/user_check','MulticitybookingsController@user_check')->name("multicitybookings.user_check");
        Route::post('/get_cab_type','MulticitybookingsController@get_cab_type')->name('Multicitybookings.get_cab_type');
        Route::post('/check_cab','MulticitybookingsController@check_cab')->name('Multicitybookings.check_cab');
        Route::post('/get_gross_total','MulticitybookingsController@get_gross_total')->name('Multicitybookings.get_gross_total');
        Route::post('/get_estimate','MulticitybookingsController@get_estimate')->name('get_estimate');
        Route::get('/onewayorder/{id}','Multy_bookingsController@onewayorder')->name('onewayorder');
        Route::get('/multywayorder/{id}','MulticitybookingsController@multywayorder')->name('multywayorder');

        Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
    });

});

