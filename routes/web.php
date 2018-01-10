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

Route::get('/', function () {
  return view('welcome');
});

/******************** Agency Routes ***************************/
Route::group(['prefix' => 'agency','namespace'=>'agency'], function () {
   Route::get('/',['uses'=>'LoginController@index']);
   Route::post('/agency-register',['as'=>'agency.register','uses'=>'RegisterController@store']);
   Route::post('/agency-login',['as'=>'agency.login','uses'=>'LoginController@store']);
   Route::post('/agency-forgetPasswordMail',['as'=>'agency.forgetPasswordMail','uses'=>'LoginController@forgetPasswordMail']);
   Route::get('/verification-pending',['uses'=>'LoginController@verificationPending']);
   Route::get('/verification-completed',['uses'=>'LoginController@verificationCompleted']);
   Route::get('/verify/{token}',['uses'=>'VerificationController@confirmEmail']);
   Route::get('/password/reset/{token}',['uses'=>'PasswordController@checkToken']);
   Route::post('/check-email',['as'=>'/check-email','uses'=>'RegisterController@checkEmail']);
   Route::post('/change-password1',['as'=>'change-password1','uses'=>'PasswordController@changePassword']);
   Route::post('/check-email-exists',['as'=>'check-email-exists','uses'=>'RegisterController@checkEmailExists']);
   
      Route::group(['middleware' => 'agency'], function () {
         
      Route::get('/agency-dashboard',['as'=>'agency.dashboard','uses'=>'DashboardController@index']);
      Route::get('/notifications',['as'=>'notifications','uses'=>'DashboardController@notifications']);
      Route::get('/agency-logout',['as'=>'agency.logout','uses'=>'LoginController@logout']);
      
      /*** Profile routes ***/
      Route::get('/profile',['as'=>'profile','uses'=>'ProfileController@index']);
      Route::get('/view-profile',['as'=>'view-profile','uses'=>'ProfileController@viewProfile']);
      Route::patch('/profile',['as'=>'profile','uses'=>'ProfileController@update']);
      /*** Profile routes ***/

      /*** Change Password ***/
      Route::get('/password',['as'=>'password','uses'=>'ProfileController@password']);
      Route::post('/change-password',['as'=>'change-password','uses'=>'ProfileController@changePassword']);
      /*** Change Password ***/


      Route::get('add-activity',['as'=>'agency.add-activity','uses'=>'ActivityController@addActivity']);
      Route::post('save-activity-basic-info',['as'=>'agency.save-activity-basic-info','uses'=>'ActivityController@saveActivityBasicInfo']);
      Route::post('save-activity-images',['as'=>'agency.save-activity-images','uses'=>'ActivityController@saveActivityImages']);
      Route::post('save-activity-videos',['as'=>'agency.save-activity-videos','uses'=>'ActivityController@saveActivityVideos']);
      Route::post('save-activity-terms',['as'=>'agency.save-activity-terms','uses'=>'ActivityController@saveActivityTerms']);
      Route::post('save-activity-notes',['as'=>'agency.save-activity-notes','uses'=>'ActivityController@saveActivityNotes']);
      Route::get('list-activity', ['as' => 'agency.list-activity', 'uses' => 'ActivityController@index']);
      Route::get('delete-activity', ['as' => 'agency.delete-activity', 'uses' => 'ActivityController@deleteActivity']);
      Route::get('view-activity/{id}', ['as' => 'agency.view-activity', 'uses' => 'ActivityController@viewActivity']);
      Route::get('edit-activity/{page}/{id}', ['as' => 'agency.edit-activity', 'uses' => 'ActivityController@editActivity']);
      
      Route::post('update-activity-basic-info',['as'=>'agency.update-activity-basic-info','uses'=>'ActivityController@updateActivityBasicInfo']);
      Route::post('update-activity-images',['as'=>'agency.update-activity-images','uses'=>'ActivityController@updateActivityImages']);
      Route::post('update-activity-videos',['as'=>'agency.update-activity-videos','uses'=>'ActivityController@updateActivityVideos']);
      Route::post('update-activity-terms',['as'=>'agency.update-activity-terms','uses'=>'ActivityController@updateActivityTerms']);
      Route::post('update-activity-notes',['as'=>'agency.update-activity-notes','uses'=>'ActivityController@updateActivityNotes']);
      Route::get('delete-activity-image/{id}/{activityId}', ['as' => 'agency.delete-activity-image', 'uses' => 'ActivityController@deleteActivityImage']);
      Route::get('delete-activity-video/{id}/{activityId}', ['as' => 'agency.delete-activity-video', 'uses' => 'ActivityController@deleteActivityVideo']);

      Route::get('add-combo-packages',['as'=>'agency.add-combo-packages','uses'=>'ComboPackagesController@addComboPackages']);
      Route::get('list-combo-packages',['as'=>'agency.list-combo-packages','uses'=>'ComboPackagesController@index']);
      
      Route::get('add-camping-packages',['as'=>'agency.add-camping-packages','uses'=>'CampingPackagesController@addCampingPackages']);
      Route::get('list-camping-packages',['as'=>'agency.list-camping-packages','uses'=>'CampingPackagesController@index']);
      Route::get('save-camping-package',['as'=>'agency.save-camping-package','uses'=>'CampingPackagesController@saveCampingPackage']);
   });
   
});






/******************** Admin Routes ***************************/
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
  /*   * * admin login routes ** */
  Route::get('/', ['uses' => 'LoginController@index']);
  Route::post('/admin-login', ['as' => 'admin.login', 'uses' => 'LoginController@store']);
  Route::group(['middleware' => 'admin'], function () {
    /*** admin dashboard routes ***/
    Route::get('/admin-dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
    /*** admin logout routes ***/
    Route::get('/admin-logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);
    /*** List Agency routes ***/
    Route::get('/list-agency',['as'=>'admin.list-agency','uses'=>'AgencyController@index']);
    Route::get('/agency-profile', ['as' => 'admin.agency-profile', 'uses' => 'AgencyController@agencyProfile']);
    Route::post('/update-agency', ['as' => 'admin.update-agency', 'uses' => 'AgencyController@updateAgency']);
    Route::post('/upload-image', ['as' => 'admin.upload-image', 'uses' => 'AgencyController@uploadAgencyImage']);
    Route::post('/agency-accept-reject', ['as' => 'admin.agency-accept', 'uses' => 'AgencyController@agencyAcceptReject']);
    Route::get('/block-agency', ['as' => 'admin.block-agency', 'uses' => 'AgencyController@blockAgency']);
    Route::get('/unblock-agency', ['as' => 'admin.unblock-agency', 'uses' => 'AgencyController@unBlockAgency']);
    
    Route::get('list-activity', ['as' => 'admin.list-activity', 'uses' => 'ActivityController@listActivity']);
    Route::get('add-activity', ['as' => 'admin.add-activity', 'uses' => 'ActivityController@addActivity']);
    Route::post('save-activity', ['as' => 'admin.save-activity', 'uses' => 'ActivityController@saveActivity']);
    Route::get('edit-activity', ['as' => 'admin.edit-activity', 'uses' => 'ActivityController@editActivity']);
    Route::post('update-activity', ['as' => 'admin.update-activity', 'uses' => 'ActivityController@updateActivity']);
    Route::get('deactivate-activity', ['as' => 'admin.deactivate-activity', 'uses' => 'ActivityController@deactivateActivity']);
    Route::get('activate-activity', ['as' => 'admin.activate-activity', 'uses' => 'ActivityController@activateActivity']);
    Route::get('list-agency-activity/{id}', ['as' => 'admin.list-activity', 'uses' => 'AgencyController@listActivity']);
    Route::get('delete-activity', ['as' => 'admin.delete-activity', 'uses' => 'AgencyController@deleteActivity']);
    Route::get('view-activity/{id}', ['as' => 'admin.view-activity', 'uses' => 'AgencyController@viewActivity']);


















    /*     * * user list routes ** */
    Route::get('/list-user', ['as' => 'admin.list-user', 'uses' => 'UserController@index']);
    /*     * * delete user routes ** */
    Route::get('/delete-user', ['as' => 'admin.delete-user', 'uses' => 'UserController@deleteUser']);
    /*     * * block user routes ** */
    Route::get('/block-user', ['as' => 'admin.block-user', 'uses' => 'UserController@blockUser']);
    /*     * * unblock user routes ** */
    Route::get('/unblock-user', ['as' => 'admin.unblock-user', 'uses' => 'UserController@unBlockUser']);
    /*     * * user order routes ** */
    Route::get('/user-orders', ['as' => 'admin.user.orders', 'uses' => 'OrderController@getUserOrders']);
    /*     * * user order details routes ** */
    Route::get('/user-orders-details', ['as' => 'admin.user.order_details', 'uses' => 'OrderController@getUserOrdersDetails']);
    /*     * * pharmacy list routes ** */
    Route::get('/list-pharmacy', ['as' => 'admin.list-pharmacy', 'uses' => 'PharmacyController@index']);
    /*     * * delete pharmacy routes ** */
    Route::get('/delete-pharmacy', ['as' => 'admin.delete-pharmacy', 'uses' => 'PharmacyController@deletePharmacy']);
    /*     * * block pharmacy routes ** */
    
    /*     * * add pharmacy routes ** */
    Route::get('/add-pharmacy', ['as' => 'admin.add', 'uses' => 'PharmacyController@addPharmacy']);
    /*     * * check pharmacy already exist routes ** */
    Route::get('/pharmacy-exist', ['as' => 'pharmacy-exist', 'uses' => 'PharmacyController@checkPharmacyExists']);
    /*     * * save pharmacy routes ** */
    Route::post('/save-pharmacy', ['as' => 'admin.save-pharmacy', 'uses' => 'PharmacyController@store']);
    Route::post('/update-pharmacy', ['as' => 'admin.update-pharmacy', 'uses' => 'PharmacyController@updatePharmacy']);
    /*     * * pharmacy details routes ** */
    Route::get('/pharmacy-profile', ['as' => 'admin.pharmacy-profile', 'uses' => 'PharmacyController@pharmacyProfile']);
    /*     * * medicine list routes ** */
    Route::get('/medicines', ['as' => 'admin.medicine', 'uses' => 'PharmacyController@getMedicines']);
    /*     * * upload  pharmacy image routes ** */
    //Route::post('/upload-image', ['as' => 'admin.upload-image', 'uses' => 'PharmacyController@uploadPharmacyImage']);
    /*     * * delete pharmacy routes ** */
    Route::get('/delete-image', ['as' => 'admin.delete-image', 'uses' => 'PharmacyController@deleteImage']);
    /*     * *  pharmacy accept or reject routes ** */
    
    /*     * * add medicine view routes ** */
    Route::get('/add-medicine', ['as' => 'admin.add', 'uses' => 'PharmacyController@addMedicine']);
    /*     * * save medicine routes ** */
    Route::post('/save-medicine', ['as' => 'admin.save-medicine', 'uses' => 'PharmacyController@storeMedicine']);
    /*     * * import medicine by exelsheet routes ** */
    Route::post('/add-excel-medicine', ['as' => 'admin-add-excel-medicine', 'uses' => 'PharmacyController@importExcel']);
    Route::get('/pharmacy-orders', ['as' => 'admin.pharmacy.orders', 'uses' => 'PharmacyController@getPharmacyOrders']);
    /*     * * pharmacy order details routes ** */
    Route::get('/pharmacy-orders-details', ['as' => 'admin.pharmacy.order_details', 'uses' => 'OrderController@getPharmacyOrdersDetails']);
    /*     * * get particular pharmacy order details routes ** */
    Route::get('/orders', ['as' => 'admin.pharmacy.orders', 'uses' => 'OrderController@getOrders']);
    /*     * * get earned revenue pharmacy wise routes ** */
    Route::get('/earned-revenue', ['as' => 'admin.revenue.revenue', 'uses' => 'RevenueController@getEarnedRevenue']);
    /*     * * get order listing of particular pharmacy routes ** */
    Route::get('/view-order', ['as' => 'admin.revenue.order', 'uses' => 'RevenueController@viewOrder']);
    /*     * * set commition on pharmacy routes ** */
    Route::get('/set-comission', ['as' => 'set-comission', 'uses' => 'PharmacyController@setCommission']);
    /*     * * set tax on pharmacy routes ** */
    Route::post('/add-tax', ['as' => 'add-tax', 'uses' => 'PharmacyController@addTax']);
    /*     * * Pharmacy CMS routes ** */
    Route::get('/cms-pharmacy/{slug}', ['uses' => 'CmsController@index']);
    Route::get('/cms-contact-support', ['as' => 'admin.cms.contact-support', 'uses' => 'CmsController@cmsContactSuport']);
    Route::post('/cms-contact-support', ['as' => 'admin.cms.contact-support', 'uses' => 'CmsController@cmsContactSuport']);
    Route::post('/update-cms', ['as' => 'admin.update-cms', 'uses' => 'CmsController@updateCms']);
    Route::get('/cms-app/{slug}', ['uses' => 'CmsController@cmsApp']);
    Route::get('/pharmacy-feedback', ['as' => 'admin.pharmacy-feedback', 'uses' => 'CmsController@pharmacyFeedback']);
    Route::post('/update-cms-app', ['as' => 'admin.update-cms-app', 'uses' => 'CmsController@updateCmsApp']);
    Route::get('/quantiy-unit-list', ['as' => 'admin.quantiy-unit-list', 'uses' => 'QuantityUnitController@index']);
    /*     * * delete quantity routes ** */
    Route::get('/delete-quantity-unit', ['as' => 'admin.delete-quantity-unit', 'uses' => 'QuantityUnitController@deleteUnitType']);
    /*     * * block quantity unit routes ** */
    Route::get('/block-quantity-unit', ['as' => 'admin.block-quantity-unit', 'uses' => 'QuantityUnitController@blockUnitType']);
    /*     * * unblock quantity unit routes ** */
    Route::get('/unblock-quantity-unit', ['as' => 'admin.unblock-quantity-unit', 'uses' => 'QuantityUnitController@unBlockUnitType']);
    Route::get('/add-quantity-unit', ['as' => 'admin.add-quantity-unit', 'uses' => 'QuantityUnitController@addQuantityUnit']);
    Route::post('/add-quantity-unit', ['as' => 'admin.add-quantity-unit', 'uses' => 'QuantityUnitController@storeUnitType']);
  });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
