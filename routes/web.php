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

Route::get('/landing_page', 'CompanyController@landing');
Route::get('/homeowner_landing', 'CompanyController@homeonwerlanding');
Route::group(['middleware' => ['nocache']], function () {
Route::get('/admin_login', function () {
    if (Auth::guard('admin')->check()) {
        
        return redirect('/dashboard');
      
    }else{
        $data['title'] = 'Admin login';
    return view('admin_login', $data);}
 
});

Route::post('/admin_post_login', 'AuthController@adminLogin');
Route::post('company_post_login', 'AuthController@companyLogin');
Route::post('/post_homeowner', 'AuthController@postHomeowner');

Route::post('register_company', 'AuthController@registerCompany');
Route::post('check_email', 'AuthController@checkEmail');
//forgot password
Route::post('/sendforget', 'AuthController@sendForgotPassword');
Route::get('/reset_password/{id?}', 'AuthController@resetPasswordView');
Route::post('/reset_password', 'AuthController@postResetPassword');
//
Route::get('verify_account/{email_code}', 'AuthController@verifyAccount');
Route::get('statusCron', 'CronJobController@statusCron');

Route::get('/', 'CompanyController@homeonwerlanding')->name('login');

Route::get('/main_page', function () {
    if(Auth::check()){
        if(Auth::user()->type=='company'){
            return redirect('company-dashboard');
        }else{
            return redirect('user-dashboard');
        }
    }
    return view('index');
});




Route::get('/company_profile_guest/{id}', 'HomeOwnerController@companyProfile');
//Route::get('/my_proposals', function () {
//    return view('profile/my_proposals');
//});
Route::get('/user_notification', function () {
    return view('home/notifications');
});
Route::get('/email', function () {
    return view('email_template.proposal');
});



Route::get('/view_contractors', function () {
    return view('company.view_contractor');
});

//Route::get('/job_search', function () {
//    return view('home.job_search');
//});

Route::get('/company_search', function () {
    return view('home.company_search');
});
// User Routes (Shery)
Route::get('/edit_profile', function () {
    return view('profile.edit_profile');
});
Route::get('/proporsal', function () {
    return view('home.proporsal_submit');
});
Route::get('/post_job', function () {
    return view('profile.post_job');
});
Route::get('authenticate_email_validate', 'AuthController@authenticateEmailValidate');


// Route::get('/view_contractor_project', function () {
//        return view('home.contruct');
//    });
// Route::post(
//        'stripe/webhook',
//        '\App\Http\Controllers\WebhookController@handleWebhook'
//    );

 

Route::get('company_logout', 'AuthController@companylogout');
});
Route::group(['middleware' => ['admin','nocache']], function () {
    Route::get('dashboard', 'AdminController@dashboard');
    Route::get('companies', 'AdminController@getCompanies');
    Route::get('home_owner', 'AdminController@getHomeOwner');
    //proposal
    Route::get('/proposals/{id?}', 'AdminController@proposal');
    Route::get('/subscription', 'AdminController@getSubscriptions');
    Route::get('/notification', 'AdminController@getNotification');
    Route::post('/add_notification', 'AdminController@addNotification');
    Route::post('/job_specialty_status', 'AdminController@jobSpecialtyStatus');
    //jobs
    Route::get('/job_specialities/{id?}', 'AdminController@jobSpecialities');
    Route::get('jobs', 'AdminController@jobs');
    Route::post('add_job', 'AdminController@addJob');
    Route::get('delete_job{id}', 'AdminController@deleteJob');
    Route::get('delete_job_special/{id}', 'AdminController@deletespecialJob');
    //user
    Route::post('/block_user', 'AdminController@blockUser');
    Route::post('/verify_user', 'AdminController@verifyUser');
    Route::post('/popular_user', 'AdminController@popularUser');
    Route::post('/delete_user', 'AdminController@deleteUser');
    //get Deleted Users
    Route::get('/deleted_user', 'AdminController@deletedUser');
    Route::get('/deleted_company', 'AdminController@deletedcompany');
    Route::get('/edit_user/{id?}', 'AdminController@editUser');
    Route::get('/restore_user/{id?}', 'AdminController@restoreUser');
    Route::post('add_user', 'AdminController@addUser');
    Route::get('/edit_company/{id?}', 'AdminController@editCompany');
    Route::get('reviews', 'AdminController@reviews');
    Route::get('test_token_stripe', 'AdminController@testCreateCardToken');
    Route::get('test_create_subscription', 'AdminController@createSubscription');
    Route::get('logout', 'AuthController@logout');
//    Admin Edit Profile View
    Route::get('edit_admin_profile_view', 'AdminController@editProfileView');
    Route::get('logout', 'AuthController@logout');
//    Save Admin Edit Profile Data 
    Route::post('save_edit_profile_data', 'AdminController@editProfileData');
//    Change Password
    Route::post('change_password', 'AdminController@changePassword');
//    Login As
    Route::get('login_as/{id}', 'AdminController@loginAs');
});
//Company Routes

Route::group(['middleware' => ['nocache', 'company', 'auth']], function () {

   
//search comapny
    Route::get('job_search', 'CompanyController@jobSearch');
    Route::post('post_job_search', 'CompanyController@postJobSearch');
    
    Route::get('test_company', 'AuthController@testComapny');
    Route::get('/company_basic_info', function () {
        return view('company.basicinfo');
    });

    Route::post('post_company_info', 'CompanyController@postCompanyInfo');
    Route::get('/company-dashboard', 'CompanyController@dashboard');
    Route::get('/my_saves', 'CompanyController@mySaves');
    Route::post('/upload_project_image', 'CompanyController@uploadProjectImage');
    Route::get('/unsave_job/{id}', 'CompanyController@unSaves');
    Route::get('/view_job/{id}', 'CompanyController@viewJob');
    Route::get('/delete_proposal/{id}', 'CompanyController@deleteProposal');
    Route::post('/edit_proposal', 'CompanyController@editProposal');

    Route::post('/add_proposal', 'CompanyController@addProposal');

    Route::post('/delete_image_company', 'CompanyController@deleteImage');

//    Route::get('/company_profile', 'CompanyController@getMyProfile');



    Route::post('check_password', 'CompanyController@checkPassoword');

    Route::post('update_password', 'CompanyController@updatePassword');
    Route::post('email_update', 'CompanyController@emailUpdate');

    Route::get('/company_profile/{tab?}', 'CompanyController@getMyProfile');

    Route::post('/update_company_profile', 'CompanyController@updateCompanyProfile');
    Route::post('/company_upload_image', 'CompanyController@uploadImage');
    Route::post('/add_description', 'CompanyController@addDescription');

    Route::post('/add_service', 'CompanyController@addService');

    Route::post('/update_email_notification_settings', 'CompanyController@updateEmailNotificationSettings');

    Route::post('/add_product', 'CompanyController@addProduct');

    Route::post('/edit_service', 'CompanyController@editService');

    Route::post('/update_product', 'CompanyController@updateProduct');
    Route::post('/upload_cover', 'CompanyController@uploadCover');
    Route::get('delete_product/{id}', 'CompanyController@deleteProduct');
    Route::get('delete_project/{id}', 'CompanyController@deleteProject');
    Route::get('/delete_service/{id}/{tab}', 'CompanyController@deleteService');
    Route::post('/add_speciality_company', 'CompanyController@addSpeciality');
    Route::post('/add_speciality_admin', 'CompanyController@addSpecialityAdmin');
    Route::post('/delete_speciality', 'CompanyController@deleteSpeciality');

//    Route::get('/project_detail', function () {
//    return view('home.project-detail');
//});
    Route::get('project_detail/{id}', 'CompanyController@projectDetail');


    Route::post('add_project', 'CompanyController@addProject');
    Route::post('update_project', 'CompanyController@updateProject');

    Route::post('delete_project_image', 'CompanyController@deleteProjectImage');

    Route::post('update_edit_businees', 'CompanyController@updateEditBusinees');



    Route::get('/view_contractor/{tab?}', 'CompanyController@getGeneralContractor');

    Route::get('company_notification', 'CompanyController@companyNotification');

    Route::get('/member_plan', function () {
        return view('company.member_plan');
    });


    Route::post('update_stripe_customer', 'CompanyController@updateStripeCustomer');
    Route::get('cancel_subscription', 'CompanyController@cancelSubscription');

    Route::post('change_membership', 'CompanyController@changeMembership');




    Route::get('/download_file/{id}', 'CompanyController@downloadFile');
    Route::get('/save_job/{id}', 'CompanyController@saveJob');
    Route::get('/view_public_job/{id}', 'CompanyController@viewJob');
});
// Route::get('/view_contractor_project', function () {
//        return view('home.contruct');
//    });
//Homeowner Routes

Route::get('/proposal_check/{id}/{status}/{redirect?}', 'HomeOwnerController@proposalCheck');
Route::post('/upload_image', 'HomeOwnerController@uploadImage');

Route::group(['middleware' => ['homeOwner','nocache']], function () {

    Route::get('/user-dashboard', 'HomeOwnerController@dashboard');
    Route::get('/homeowner_saves', 'HomeOwnerController@mySaves');
    Route::get('/unsave_company/{id}/{redirect?}', 'HomeOwnerController@unSaves');

    Route::get('/post_job_form/{id?}', 'HomeOwnerController@editJob');
    Route::post('/delete_image', 'HomeOwnerController@deleteImage');
    Route::post('/delete_speciality_home', 'HomeOwnerController@deleteSpeciality');
    Route::post('/add_speciality', 'HomeOwnerController@addSpeciality');
    Route::post('/edit_post_job', 'HomeOwnerController@postJob');
    Route::get('/homeowner_proposals', 'HomeOwnerController@proposals');
    Route::get('/download_file_home/{id}', 'HomeOwnerController@downloadFile');
    Route::get('/download_file_home_upload', 'HomeOwnerController@downloadFileUpload');

    Route::get('/my_profile/{tab?}', 'HomeOwnerController@myProfile');
    Route::post('/my_profile', 'HomeOwnerController@updateProfile');

    Route::get('/company_search', 'HomeOwnerController@companySearch');
// 
    Route::post('/post_company_search', 'HomeOwnerController@postCompanySearch');
    Route::post('/post_contact_company', 'HomeOwnerController@postContactCompany');
    Route::post('/post_quote_company', 'HomeOwnerController@postQuoteCompany');

    Route::get('/company_profile_home/{id}', 'HomeOwnerController@companyProfile');
    Route::post('/sort_reviews', 'HomeOwnerController@sortReviews');
    Route::get('home_notification', 'HomeOwnerController@homeNotification');
    Route::post('check_password_home', 'HomeOwnerController@checkPassoword');
    Route::post('update_password_home', 'HomeOwnerController@updatePassword');
    Route::post('/update_email_notification_settings_home', 'HomeOwnerController@updateEmailNotificationSettings');

    Route::get('write_review/{id}', 'HomeOwnerController@writeReview');

    Route::get('store_search_location','HomeOwnerController@storeSearchLocation');


    Route::post('/upload_review_image', 'HomeOwnerController@uploadReviewImage');
    Route::post('/post_review', 'HomeOwnerController@postReview');
     Route::get('/save_company/{id}', 'HomeOwnerController@saveCompany');
     Route::get('/delete_job/{id}', 'HomeOwnerController@deleteJob');
      Route::get('project_detail_home/{id}/{company_id}', 'HomeOwnerController@projectDetail');

});

Route::post('/news_letter', 'CompanyController@newsletter');
