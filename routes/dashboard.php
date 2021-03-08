<?php

use Illuminate\Support\Facades\Route;
use App\Models\userLog;
use App\Models\companyCar;
use Illuminate\Http\Request;
use App\Models\State;

Route::group(['prefix' => 'admin-panel','as' => 'dashboard.'], function () {

    // Admin Login
    Route::get('/login','HomeController@login')->name('login');
    Route::post('/login','HomeController@login_post')->name('login.post');

    // Admin Change Lang
    Route::get('/lang/{lang}','HomeController@lang')->name('lang');

    // Admin Home
    Route::group(['middleware' => 'dashboard.auth'],function () {
    // Home Page
    Route::get('/', 'HomeController@home')->name('home');
    // Admin Logout
    Route::get('/logout', 'HomeController@logout')->name('logout');

        // Config Home
        Route::get('/configs','ConfigController@edit')->name('configs.edit');
        Route::post('/configs','ConfigController@update')->name('configs.update');

        // Users with all options
        Route::resource('/users','UserController');
        Route::post('/users/related-country-cities','UserController@relatedCountryCities')->name('users.related.country-cities');
        Route::post('/users/related-city-states','UserController@relatedCityStates')->name('users.related.city-states');


        // Countries with all options
        Route::resource('/countries','CountryController');

        // Cities with all options
        Route::resource('/cities','CityController');

        // States with all options
        Route::resource('/states','StateController');
        Route::post('/states/related-country-cities','StateController@relatedCountryCities')->name('states.related.country-cities');

        // Services with all options includes ( costs )
        Route::resource('/services','ServiceController');
        Route::get('/service-costs','ServiceCostController@index')->name('service-costs.index');
        Route::post('/service-costs','ServiceCostController@update')->name('service-costs.update');
        // Services Ajax Requests
        Route::post('/service/related-country-cities','ServiceCostController@relatedCountryCities')->name('service-costs.related.country-cities');
        Route::post('/service/related-city-states','ServiceCostController@relatedCityStates')->name('service-costs.related.city-states');

        // Terms Controller Resource Type (Crud)
         Route::resource('/terms','TermController');

        //Roles and Permissions part
        Route::resource('/permissions', 'PermissionsController', ['as' => 'laratrust'])
        ->only(['index', 'edit', 'update']);
        Route::resource('/roles', 'RolesController', ['as' => 'laratrust']);
        Route::resource('/roles-assignment', 'RolesAssignmentController', ['as' => 'laratrust'])
        ->only(['index', 'edit', 'update']);

        //Company Assets part
        Route::resource('/company-assets','CompanyAssetsController');

        //Company Cars part
        Route::resource('/company-cars','companyCarController');
        Route::resource('/documents','documentController');
        route::get('user-logs',function(){
            $userLogs = userLog::get();
            return view('dashboard.user-logs.index',compact('userLogs'));
        });
        Route::resource('/company-cars','CompanyCarController');

        // Documents crud
        Route::resource('/documents','DocumentController');

        // Custodies crud
        Route::resource('custodies','CustodyController');

        // Custodies cars crud
        Route::get('traffic-violations/index','trafficViolationController@index')->name('violations.index');
        Route::get('traffic-violations/create/{id}/{user_id?}','trafficViolationController@create')->name('violations.create');
        Route::get('traffic-violations/edit/{id}','trafficViolationController@edit')->name('violations.edit');
        Route::post('traffic-violations/store/{id}/{user_id?}','trafficViolationController@store')->name('violations.store');
        Route::put('traffic-violations/update/{id}','trafficViolationController@update')->name('violations.update');
        // add-drivers crud
        Route::get('add-drivers/{id}','CompanyCarController@Add_driver')->name('add.driver');
        Route::put('add-drivers/{id}','CompanyCarController@Add_driver_update')->name('add.driver.update');
        Route::get('remove_drivers{id}','CompanyCarController@remove_driver')->name('remove.driver');

        // Admin Logs
        Route::get('/logs','LogController@logs')->name('logs.index');
        // Users with all options
        Route::resource('/users','UserController');
        Route::post('/users/add-new-person','UserController@addNewPersonForDelivery')->name('users.add-new-person');
        Route::post('/users/related-country-cities','UserController@relatedCountryCities')->name('users.related.country-cities');
        Route::post('/users/related-city-states','UserController@relatedCityStates')->name('users.related.city-states');

        // orders
        Route::resource('/deliveries','DeliveryController');
        route::get('tracking-timeline/{id}','DeliveryController@tracking_timeline')->name('deliveries.tacking.timeline');
        Route::post('/deliveries/users','DeliveryController@deliveryUsers')->name('deliveries.users.index');
        Route::post('/deliveries/cancel-deliveries','DeliveryController@deliveriesRemoveDeliveries')->name('deliveries.remove-deliveries');
        Route::post('/deliveries/services/get','DeliveryController@deliveriesServiceGet')->name('deliveries.service.get');
        Route::post('/deliveries/user-details','DeliveryController@userDetails')->name('deliveries.user.details');
        Route::post('/deliveries/add-order-delegate','DeliveryController@addOrderDelegate')->name('deliveries.users.add_order_delegate');
        Route::post('/deliveries/add-order-delegate-to-deliver','DeliveryController@addOrderDelegateDeliver')->name('deliveries.users.add_order_delegate_to_deliver');
        Route::post('/deliveries/confirm-orders-to-office','DeliveryController@confirmOrdersToOffice')->name('deliveries.users.confirm_orders_to_office');
        Route::post('/deliveries/verify-order-in-office-status','DeliveryController@verifyOrderInOfficeStatus')->name('deliveries.users.verify_order_in_office_status');
        Route::any('/deliveries/delete-order-delegate/{id?}','DeliveryController@DeleteOrderDelegate')->name('deliveries.delete-order.delegate');
        Route::get('/deliveries/delegate-orders/{id}','DeliveryController@DelegateOrders')->name('delegate.orders');
        Route::get('/deliveries/filter','DeliveryController@filter_orders')->name('orders.filter');
        Route::get('/deliveries/filter/trader','DeliveryController@filter_trader')->name('orders.trader');
        Route::get('/deliveries/canceled','DeliveryController@canceled_orders')->name('orders.canceled');
        Route::post('/deliveries/delay','DeliveryController@DelayOrder')->name('deliveries.order.daley');
        Route::post('/deliveries/cancel','DeliveryController@cancelOrder')->name('deliveries.order.cancel');

        // order invoice
        Route::get('/deliveries-invoices/{id}','DeliveryController@invoice')->name('deliveries.invoice');


        // Delivery Notes
        Route::resource('/delivery_notes','DeliveryNoteController');

    Route::get('/city-region', function () {
        $city_id = request()->get('city_id');
        $regions = State::where('city_id', '=', $city_id)->get();
        return Response::json($regions);
    });

        // Users Commissions
        Route::get('/user-commissions','CommissionController@index')->name('commissions.index');
        Route::put('/user-commissions/{id}','CommissionController@paid')->name('commissions.paid');
        Route::get('/date-commissions','CommissionController@filterByDate')->name('commissions.by-date');
        Route::get('/date-commissions-filter', 'CommissionController@ByDate');
    });

});
