<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\File;
use App\User;
use App\Admin;
use App\JobSpeciality;
use App\Specialities;
use App\Proposal;
use App\Job;
use App\Review;
use App\Subscription;
use App\Notification;
use Laravel\Cashier;
use Session;
use Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Response;
//use Illuminate\Validation\Validator;


class AdminController extends Controller {

    public function dashboard() {
        $this->data['tab'] = 'dashboard';
        $this->data['homeowners'] = User::where('type', 'homeowner')->count();
        $this->data['company'] = User::where('type', 'company')->count();
        $this->data['jobs'] = Job::count();
        $this->data['proposals'] = Proposal::count();
        return view('admin.dashboard', $this->data);
    }

    public function getCompanies() {
        $this->data['tab'] = 'companies';

        $this->data['title'] = 'All Companies';
        $this->data['result'] = User::where('type', 'company')->get();
        return view('admin.companies', $this->data);
    }

    public function getHomeOwner() {
        $this->data['tab'] = 'homeowners';

        $this->data['title'] = 'All Home Owners';
        $this->data['homeowners'] = User::where('type', 'homeowner')->get();

        return view('admin.homeowners', $this->data);
    }

    public function getSubscription() {
        $this->data['tab'] = 'subscriptions';

        $this->data['title'] = 'All Subscriptions';
        $this->data['subscriptions'] = Subscription::with('getUser')->get();


        return view('admin.subscriptions', $this->data);
    }

    public function blockUser(Request $request) {

        if ($request->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $user = User::where('id', $request->id)->first();

        $user->is_blocked = $status;
        $user->save();
        return response()->json(['status' => 'success', 'User' => $user]);
    }

    public function verifyUser(Request $request) {

        if ($request->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $user = User::where('id', $request->id)->first();

        $user->is_verified = $status;
        $user->save();
        return response()->json(['status' => 'success', 'User' => $user]);
    }

    public function popularUser(Request $request) {

        if ($request->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $user = User::where('id', $request->id)->first();

        $user->is_popular = $status;
        $user->save();
        return response()->json(['status' => 'success', 'User' => $user]);
    }
    
    public function jobSpecialtyStatus(Request $request){
//        dd($request->all());
        if ($request->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $job_specialty = JobSpeciality::where('id',$request->id)->first();
        $job_specialty->is_popular = $status;
        $job_specialty->save();
        return response()->json(['status' => 'success', 'JobSpeciality' => $job_specialty]);
    }

    public function deleteUser(Request $request) {

        $this->data['tab'] = 'homeowners';
        $user = User::where('id', $request->id)->forceDelete();
        return response()->json(['status' => 'success', 'User' => $user]);
    }

    public function editUser($user_id = '') {
        $this->data['tab'] = 'homeowners';
        $this->data['type'] = 'homeowner';

        if ($user_id) {
            $this->data['result'] = User::where('id', $user_id)->first();

            $this->data['title'] = 'Edit Home Owners';
        } else {
            $this->data['title'] = 'Add Home Owners';
        }

        return view('admin.edit_user', $this->data);
    }

    public function restoreUser($user_id) {

        $user = User::withTrashed()->where('id', $user_id)->restore();
        $u = User::where('id', $user_id)->first();
        if ($u->type === 'company') {
            $view = 'companies';
        } else {
            $view = 'home_owner';
        }
        return redirect($view);
    }

    public function editCompany($user_id = '') {
        $this->data['tab'] = 'companies';
        $this->data['type'] = 'company';

        if ($user_id) {
            $this->data['result'] = User::where('id', $user_id)->first();

            $this->data['title'] = 'Edit Companies';
        } else {
            $this->data['title'] = 'Add Companies';
        }

        return view('admin.edit_user', $this->data);
    }

    public function addUser(Request $request) {
//        dd($request->all());
        $this->data['tab'] = 'homeowners';
        if ($request->id) {

            $request->validate([
                'first_name' => 'required',
//                'email' => 'required|email',
                'home_address' => 'required',
            ]);
        } else {
            $request->validate([
                'first_name' => 'required',
                'email' => 'required|email',
                'home_address' => 'required',
                'password' => 'required|confirmed|min:6',
            ]);
        }
        $email_already_exist = User::Where('email', $request->email)->where('id', '!=', $request->id)->first();
        if ($email_already_exist) {
            $request->session()->flash('error', 'This email already exist.');
            return redirect()->back()->withInput();
        }
        if ($request->id) {
            $user = User::where('id', $request->id)->first();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
//            $user->email = $request->email;
            $user->home_address = $request->home_address;
//            $user->password = bcrypt($request->password);
            $user->type = $request->type;
        } else {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->home_address = $request->home_address;
//            $user->password = Hash::make($request->password);
            $user->password = bcrypt($request->password);
            $user->type = $request->type;
        }
        $image_uploaded = false;
        if ($request->hasFile('image')) {

            $image_path = addFile($request->image, 'public/images/profile_images/');

            if ($image_path) {
                $user->profile_image = $image_path;
            } else {
                $image_uploaded = true;
                $request->session()->flash('error', 'Image type not allowed.');
            }
        }
        if ($user->type == 'company') {
            $view = 'companies';
        } else {
            $view = 'home_owner';
        }
        $user->save();
        return redirect($view);
    }

    public function deletedUser() {
        $this->data['tab'] = 'deleted_user';
        $this->data['title'] = 'Deleted Homeowners';

        $this->data['user'] = User::onlyTrashed()->where('type', 'homeowner')->get();

        return view('admin.deleted', $this->data);
    }

    public function deletedCompany() {
        $this->data['tab'] = 'deleted_company';
        $this->data['title'] = 'Deleted Companies';

        $this->data['user'] = User::onlyTrashed()->where('type', 'company')->get();

        return view('admin.deleted', $this->data);
    }

    public function jobSpecialities($id = '') {
        $this->data['tab'] = 'job_speciality';

        if ($id) {
            $this->data['title'] = 'Home Owner Jobs Specialities';
            $this->data['jobs_speciality'] = Specialities::where('job_id', $id)->with('getspecialImage','getJobSpecialty')->get();
//            dd( $this->data['jobs_speciality'] );

        } else {
            $this->data['title'] = 'Jobs Specialities';
            $this->data['speciality'] = JobSpeciality::get();
        }



        return view('admin.jobs_specialities', $this->data);
    }

    public function jobs() {
        $this->data['tab'] = 'jobs';
        $this->data['title'] = 'Jobs';

        $this->data['jobs'] = Job::with('getSpeciality', 'getUser', 'getProposal')
                        ->withCount('getSpeciality')
                        ->withCount('getProposal')->get();

//        dd($this->data['jobs'] );
//      $this->data['$proposal_count']= Job::withCount('getProposal')->get();
//      dd(  $proposal_count->first()->get_proposal_count);
//                 echo '<pre>';
//          print_r( $this->data['jobs']);
//          
//          exit;




        return view('admin.jobs', $this->data);
    }

    public function addJob(Request $request) {
        
        $request->validate([
            'job'=>'required',
           'path' => 'image|mimes:jpeg,png,jpg,gif,svg', 
            ]);
       
        $this->data['tab'] = 'job';
        $this->data['title'] = 'Jobs Specialities';
        $job = new JobSpeciality;
  
         if ($request->hasFile('path')) {
             
             $image_path = addFile($request->path, 'public/admin/job_speciality/');
             $job->image_path =  $image_path;
         }else{
         $job->image_path =  'public/images/images.png';
         
         }
        $job->title = $request->job;
        $job->save();
        return redirect('job_specialities')->with('success','Speciality added Succesfully');
    }

    public function deleteJob($job_id) {

        $this->data['tab'] = 'job';
        $this->data['title'] = 'Jobs Specialities';
        Specialities::where('id', $job_id)->delete();


        return redirect('job_specialities');
    }
  public function deletespecialJob($job_id) {
//dd($job_id);
        $this->data['tab'] = 'job';
        $this->data['title'] = 'Jobs Specialities';
        JobSpeciality::where('id', $job_id)->delete();


        return redirect('job_specialities')->with('error','Speciality Deleted Successfully');
    }
    public function proposal($job_id = '') {

        $this->data['tab'] = 'proposal';

        if ($job_id) {
            $this->data['title'] = 'Proposals On Jobs';
            $this->data['proposal'] = Proposal::where('job_id', $job_id)->with('getUser')->get();
        } else {
            $this->data['title'] = 'Proposals';
            $this->data['proposal'] = Proposal::with('getUser')->get();
        }

//        foreach($this->data['proposal'] as $company_name)
//        {
////            echo '<pre>';
////          print_r($company_name);
////          
////          exit;
//            $this->data['name']=$company_name->getUser->first_name;
//        }
//        dd( $this->data['name']);
        return view('admin.proposals', $this->data);
    }

    public function reviews() {

        $this->data['tab'] = 'reviews';
        $this->data['title'] = 'Reviews';

        $this->data['reviews'] = Review::with('getHomeowner', 'getCompany')->get();
        return view('admin.reviews', $this->data);
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin_login');
    }

//    public function testCreateCardToken(){
//        \Stripe\Stripe::setApiKey("sk_test_skfGwxD3Nuja2dzEmTwAvZ8n00dWE4oQcB");
//
//       $token=  \Stripe\Token::create([
//            'card' => [
//                'number' => '4242 4242 4242 4242',
//                'exp_month' => 6,
//                'exp_year' => 2020,
//                'cvc' => '314'
//            ]
//        ]);
//       return $token;
//    }
//    
//    public function createSubscription() {
//        $id = 4;
//        $token = "tok_1EpYvPI46AskzifkyDfxKBmi";
//        $user = User::where('id',$id)->where('type','company')->first();
////        $user = User::find($id);
////        dd($user);
//        $subscription = Subscription::where('user_id',$id)->first();
//        if(!$subscription) {
////            dd('true');
//        if($user->newSubscription('Construction', 'plan_FKCSaXgiW2R6bt')->create($token)){
//            
//            return redirect()->back()->with('success','Subscription Create Successfully!');
//            
//        }
//        else{
//            return redirect()->back()->with('error','Error while creating subsciption');
//        }
//        }
//        else{
////            dd('false');
//            return redirect()->back()->with('error','This user already have subscriptiopn');
//        }
//        
//        
//    }
    public function getSubscriptions() {

        $this->data['tab'] = 'subscriptions';
        $this->data['title'] = 'Subscriptions';

        $this->data['subscriptions'] = Subscription::with(['getUser' => function($query) {
                        $query->withCount('getProposals');
                    }])->get();
      
        return view('admin.subscriptions', $this->data);
    }

    public function getNotification() {

        $this->data['tab'] = 'notifications';
        $this->data['title'] = 'Notification';


        return view('admin.notifications', $this->data);
    }

    public function addNotification(Request $request) {

        $this->data['tab'] = 'notifications';
        $this->data['title'] = 'Notification';
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'type' => 'required',
        ]);
        if ($request->type == 'all') {
            $user = User::where('update_web_notification',0)->get();
        } elseif ($request->type == 'homeowner') {
            $user = User::where('type', 'homeowner')->where('update_web_notification',0)->get();
        } else {
            $user = User::where('type', 'company')->where('update_web_notification',0)->get();
        }
        foreach ($user as $users) {
            $notification = new Notification;
            $notification->to_user = $users->id;
            $notification->title = $request->title;
            $notification->description = $request->message;
            $notification->type = 'admin';
            $notification->is_read = 1;
            $notification->save();
        }

        return redirect('notification')->with('success', 'Notification send');
 
    }
    
    
//    Edit Admin Profile View
    function editProfileView(){
        
        $data['tab'] = 'edit_profile';
        $data['title'] = 'Edit My Profile';
        $id = Auth::guard('admin')->user()->id;
        $data['detail'] = Admin::find($id)->first();
        
        return view('admin.edit-admin-profile', $data);
    }
    
//    Save Admin Profile Data
    function editProfileData(Request $request){
        
          $request->validate([
            'full_name'   => 'required|min:6|max:255',
            'email'        => 'required|email|max:255',
            'profile_img'     => 'image|mimes:jpeg,jpg,bmp,png,gif', 
        ]);
            //Get Admin ID
            $id = Auth::guard('admin')->user()->id;
            //Check Image Exist
            $img_check          = $request->hasFile('profile_img');
            //Fetch Admin From DB
            $admin = Admin::find($id)->first();
            //Set values against fields
            $admin->full_name = $request->full_name;
            $admin->email = $request->email;
            //Fetch Image
            $old_photo     = 'public/images/'.$admin->profile_pic;
            //If New Image Added than delete old image and insert new image to DB and folder
            if($img_check){
                
                $image              = $request->file('profile_img');
                $path               = 'public/images/admin/profile_pic/';
                $random             = substr(md5(mt_rand()), 0, 20);
                $filename           = $random . '.' . $image->getClientOriginalExtension();
                $image->move($path,$filename);
                $final_path         = 'public/images/admin/profile_pic/'.$filename;
                $admin->profile_pic     = $final_path;
                //Deleting image from folder
                if(File::exists($old_photo)) {
                    File::delete($old_photo);
                }

            }
            $admin->save();
            Session::flash('success', 'Updated successfully');
            return Redirect::to(URL::previous());
            
       
    }
//    Chnage Admin Password
    function changePassword(Request $request){
//        dd($request->all());
//        $request->validate([
//            'current_password' => 'required',
//            'password' => 'min:6|required|confirmed',
//            'password_confirmation' => 'required', 
//        ]);

        // Setup the validator
        $message =['password.required'=> 'The new password field is required.'];
        $rules = array('current_password' => 'required', 'password' => 'min:6|required|confirmed','password_confirmation' => 'required', );
        $validator = Validator::make(Input::all(), $rules,$message);
        // Validate the input and return correct response
        if ($validator->fails())
        {   $errors = $validator->getMessageBag()->toArray();
            return Response::json(array(
                'status' => false,
                'message' => $errors,
                'from' => 'validator'

            ), 400); // 400 being the HTTP code for an invalid request.
        }
        $password  = Auth::guard('admin')->user()->password;
        if (Hash::check($request['current_password'], $password)) {
            
            $id = Auth::guard('admin')->user()->id;
            $admin = Admin::find($id)->first();
            $admin->password = bcrypt($request->password);
            
            $admin->save();
//            Session::flash('success', 'Password Updated successfully');
             return Response::json(array('status' => true, 'message' => 'Password Updated successfully'), 200);
            
        } else {
            //Session::flash('error', 'Invalid Old Password');
            //return Redirect::to(URL::previous());
            return Response::json(array('success' => false, 'message' => 'Invalid Old Password', 'from' => 'invalid'), 400);
            
        }
    }
//    Login as Homeowner or Company
    function loginAs($id) {
        $user = User::find($id);
        Auth::login($user);
        return Redirect::to('/');
    }

}
