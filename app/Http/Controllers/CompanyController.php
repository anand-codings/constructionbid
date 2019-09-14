<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Proposal;
use App\Save;
use App\CompanyDetail;
use App\File;
use App\Service;
use App\GeneralContractor;
use App\SubContractor;
use App\Supplier;
use App\Professional;
use App\Owner;
use App\JobSpeciality;
use App\Specialities;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Validator;
use App\Subscription;
use App\Product;
use App\Project;
use App\Job;
use App\NewsLetter;
use Carbon;
use App\Notification;
use stdClass;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller {

    public function __construct() {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
//        $this->middleware(function ($request, $next) {
//            $this->userId = Auth::user()->id;
//            $this->userName = Auth::user()->first_name;
//            return $next($request);
//        });
    }

    public function index() {
        if (Auth::check()) {
            if (Auth::user()->type == "company") {
                return redirect('company-dashboard');
            } else {
                return redirect('user-dashboard');
            }
        }
        $this->data['company'] = User::where('is_popular', 1)->get();

//        dd($this->data['company'] );
        $this->data['speciality'] = JobSpeciality::orderBy('created_at', 'desc')->get();
        $this->data['categories'] = JobSpeciality::all();
        $this->data['company_recent'] = User::where('type', 'company')->whereHas('getProposals', function($q) {
                    $q->where('status', 'accept');
                })->with(['getProposals' => function($q) {
                        $q->where('status', 'accept')
                                ->whereHas('getJob')
                                ->with('getJob')
                                ->orderBy('created_at', 'desc');
                    }])->with('ratingAvg')->withCount('getRatings')->orderBy('created_at', 'desc')->take(5)->get();

//        dd( $this->data['company_recent']);
//        dd( $this->data['speciality'] );
  
        return view('index', $this->data);
    }
    public function landing() {
        if (Auth::check()) {
            if (Auth::user()->type == "company") {
                return redirect('company-dashboard');
            } else {
                return redirect('user-dashboard');
            }
        }
        $this->data['company'] = User::where('is_popular', 1)->get();

//        dd($this->data['company'] );
        $this->data['speciality'] = JobSpeciality::orderBy('created_at', 'desc')->get();
        $this->data['categories'] = JobSpeciality::all();
        $this->data['company_recent'] = User::where('type', 'company')->whereHas('getProposals', function($q) {
                    $q->where('status', 'accept');
                })->with(['getProposals' => function($q) {
                        $q->where('status', 'accept')
                                ->whereHas('getJob')
                                ->with('getJob')
                                ->orderBy('created_at', 'desc');
                    }])->with('ratingAvg')->withCount('getRatings')->orderBy('created_at', 'desc')->take(5)->get();

//        dd( $this->data['company_recent']);
//        dd( $this->data['speciality'] );
  
        return view('landing_Page', $this->data);
    }
    public function homeonwerlanding() {
        if (Auth::check()) {
            if (Auth::user()->type == "company") {
                return redirect('company-dashboard');
            } else {
                return redirect('user-dashboard');
            }
        }
        $this->data['company'] = User::where('is_popular', 1)->get();

        $this->data['speciality'] = JobSpeciality::orderBy('created_at', 'desc')->get();
        $this->data['categories'] = JobSpeciality::all();
        $this->data['company_recent'] = User::where('type', 'company')->whereHas('getProposals', function($q) {
                    $q->where('status', 'accept');
                })->with(['getProposals' => function($q) {
                        $q->where('status', 'accept')
                                ->whereHas('getJob')
                                ->with('getJob')
                                ->orderBy('created_at', 'desc');
                    }])->with('ratingAvg')->withCount('getRatings')->orderBy('created_at', 'desc')->take(5)->get();

        $this->data['target_bids'] = Proposal::count();
        $this->data['successfull_projects'] = Job::whereDate('finish','<',Carbon\Carbon::now()->toDateString())->whereHas('getProposal',function($q){
                                                    $q->where('status','=','accept');
                                                 })->count();
       $this->data['homeowner_search'] = 'yes';                                         
        return view('homeowner_landing', $this->data);
    }
    
    public function postCompanyInfo(Request $request) {
//        dd($request->all());
        $user_id = Auth::id();

        if (!$request->stripeToken) {

            $request->validate([
                'first_name' => 'required',
                'home_address' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'detail' => 'required',
                'banner_logo' => 'required',
                'banner_images' => 'required',
                'profile_type' => 'required',
            ]);
//            dd('without stripe');
            $user = User::where('id', $user_id)->first();
            $user->first_name = $request->first_name;
            $user->home_address = $request->home_address;
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;
            $user->address_2 = $request->address_2;
            $user->country = $request->country;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->phone = $request->phone;
//            $user->email = $request->email;
            if ($request->hasFile('banner_logo')) {
//            dd('here');
                $image_path = addFile($request->banner_logo, 'public/images/profile_images/');

                if ($image_path) {
                    $user->profile_image = $image_path;
                } else {
                    $image_uploaded = true;
                    $request->session()->flash('error', 'Image type not allowed.');
                    return redirect()->back()->withInput();
                }
            }
            if ($request->hasFile('banner_images')) {
//            dd('here');
                $image_path = addFile($request->banner_images, 'public/images/profile_images/');

                if ($image_path) {
                    $user->cover_image = $image_path;
                } else {
                    $image_uploaded = true;
                    $request->session()->flash('error', 'Image type not allowed.');
                    return redirect()->back()->withInput();
                }
            } 
//            dd('here');
            $user->save();
            
            $company_detail = new CompanyDetail();
            $company_detail->user_id = $user_id;
            $company_detail->fax_number = $request->fax_number;
            $company_detail->profile_type = $request->profile_type;

            $company_detail->detail = $request->detail;

            $company_detail->website = $request->website;

            $company_detail->fb_link = $request->fb_link;
            $company_detail->insta_link = $request->insta_link;
            $company_detail->linkedin_link = $request->linkedin_link;
            $company_detail->twitter_link = $request->twitter_link;
            $company_detail->save();

//            $subscription = new Subscription();
//            $subscription->user_id = $user_id;
//            $subscription->name = 'Construction';
//            $subscription->stripe_plan = 'Free';
//            $subscription->quantity = '1';
//            $subscription->save();
//            
//            dd('hre');
            return redirect('company-dashboard')->with('success', 'Basic Info has been added succesfully');
        } else {
//            dd('downhere');
            $request->validate([
                'first_name' => 'required',
                'home_address' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'detail' => 'required',
                'banner_logo' => 'required',
                'banner_images' => 'required',
            ]);

            $user = User::where('id', $user_id)->where('type', 'company')->first();
            $user->first_name = $request->first_name;
            $user->home_address = $request->home_address;
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;
            $user->address_2 = $request->address_2;
            $user->country = $request->country;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->phone = $request->phone;

            if ($request->hasFile('banner_logo')) {

                $image_path = addFile($request->banner_logo, 'public/images/profile_images/');

                if ($image_path) {
                    $user->profile_image = $image_path;
                } else {
                    $image_uploaded = true;
                    $request->session()->flash('error', 'Image type not allowed.');
                    return redirect()->back()->withInput();
                }
            }
            if ($request->hasFile('banner_images')) {

                $image_path = addFile($request->banner_images, 'public/images/profile_images/');

                if ($image_path) {
                    $user->cover_image = $image_path;
                } else {
                    $image_uploaded = true;
                    $request->session()->flash('error', 'Image type not allowed.');
                    returnredirect()->back()->withInput();
                }
            }

            $user->save();
            $company_detail = new CompanyDetail();
            $company_detail->user_id = $user_id;
            $company_detail->fax_number = $request->fax_number;
            $company_detail->card_holder_name = $request->card_holder_name;
             $company_detail->profile_type = $request->profile_type;
            $company_detail->detail = $request->detail;

            $company_detail->website = $request->website;

            $company_detail->fb_link = $request->fb_link;
            $company_detail->insta_link = $request->insta_link;
            $company_detail->linkedin_link = $request->linkedin_link;
            $company_detail->twitter_link = $request->twitter_link;
            $company_detail->save();



            // stripe
            $token = $request->stripeToken;
            $plan = $request->choose_plan;
            $plan_id = '';
            $bids = '';
            if ($plan == 'limited') {
                $plan_id = 'plan_FhkJScuGNd74AI';
                $bids = 15;
            } else {
                $plan_id = 'plan_FhkJmntlLpw7Di';
            }

            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                if ($user->newSubscription('Construction', $plan_id)->create($token)) {

                    $subs = Subscription::where('user_id', $user_id)->first();
                    $subscription_id = $subs->stripe_id;

                    $stripe_details = \Stripe\Subscription::retrieve($subscription_id);

                    $timestamp = $stripe_details->current_period_end;
                    $periods_end = date('Y-m-d H:i:s', $timestamp);
                    $subs->ends_at = $periods_end;
                    $subs->status = '1';
                    $subs->count = '0';
                    $subs->bids = $bids;
                    $subs->save();

                    return redirect('company-dashboard')->with('success', 'Company profile created successfully!');
                }
            } catch (\Stripe\Error\Card $e) {
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\RateLimit $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\InvalidRequest $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\Authentication $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\ApiConnection $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\Base $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (Exception $e) {
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
        }
    }

    public function dashboard() {
        $this->data['tab'] = 'dashboard';
        $id = Auth::id();

        $this->data['proposals'] = Proposal::where('company_id', $id)->with('getFiles', 'getJob.getUser')->orderBy('created_at','desc')->get();

//        $this->data['rating']=User::where('id',$id)->with('ratingAvg')->first();
//        dd($this->data['rating']->ratingAvg->total *20);
//        
//        $this->data['drafts'] = Proposal::where('company_id', $id)->where('is_draft', 1)->with('getFiles')->get();
        $this->data['saves_count'] = Save::where('company_id', $id)->where('job_id', '!=', null)->count();
        $this->data['count'] = Proposal::where('company_id', $id)->count();
        $this->data['image'] = User::where('id', $id)->first();
//        $this->data['categories'] = JobSpeciality::all();

        return view('company.company_dashboard', $this->data);
    }

    public function mySaves() {
        $this->data['tab'] = 'saves';
        $id = Auth::id();

        $this->data['image'] = User::where('id', $id)->first();
        $this->data['saves'] = Save::where('company_id', $id)->where('job_id', '!=', null)->with('getJobs')->orderBy('created_at','desc')->get();
        $this->data['saves_count'] = Save::where('company_id', $id)->where('job_id', '!=', null)->count();
        $this->data['count'] = Proposal::where('company_id', $id)->count();
        return view('company.my_saves', $this->data);
    }

    public function getMyProfile($tab = '') {
        $user_id = Auth::user()->id;
//        dd($user_id);
        $data['result'] = User::where('id', $user_id)->with('getCompanyDetail', 'getSubscription')->first();
        $data['tab_id'] = $tab;
        $data['result']->tab = 'default';
        $data['result']->save();

//        dd($data['result']);
        $data['image'] = User::where('id', $user_id)->first();

        return view('profile.login&password_company', $data);
    }

    public function updateCompanyProfile(Request $request) {
//        dd($request->all());

        $request->validate([
            'email' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'detail' => 'required',
        ]);

//        dd($request->all());

        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user->first_name = $request->company_name;
        $user->home_address = $request->home_address;
        $user->address_2 = $request->address_2;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($request->latitude && $request->longitude) {
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;
        }

        if ($request->latitude_two && $request->longitude_two) {
            $user->latitude_two = $request->latitude_two;
            $user->longitude_two = $request->longitude_two;
        }
        if ($request->hasFile('profile_image')) {
//            dd('here');
            $image_path = addFile($request->profile_image, 'public/images/profile_images/');

            if ($image_path) {
                $user->profile_image = $image_path;
            } else {
                $image_uploaded = true;
                $request->session()->flash('error', 'Image type not allowed.');
                return redirect()->back();
            }
        }
        $company_detail = CompanyDetail::where('user_id', $user_id)->first();
        if ($company_detail) {
//            dd('yes');
            $company_detail->fax_number = $request->fax_number;
            $company_detail->detail = $request->detail;
            $company_detail->website = $request->website;
            $company_detail->fb_link = $request->fb_link;
            $company_detail->insta_link = $request->insta_link;
            $company_detail->linkedin_link = $request->linkedin_link;
            $company_detail->profile_type = $request->profile_type;
            $company_detail->twitter_link = $request->twitter_link;
            $company_detail->save();
        } else {
//            dd('no');
            $detail = new CompanyDetail();
            $detail->user_id = $user_id;
            $detail->fax_number = $request->fax_number;
            $detail->detail = $request->detail;
            $detail->website = $request->website;
            $detail->fb_link = $request->fb_link;
            $detail->insta_link = $request->insta_link;
            $detail->linkedin_link = $request->linkedin_link;
            $detail->twitter_link = $request->twitter_link;
            $detail->save();
        }

        $user->save();

        return redirect()->back()->with('success', 'Save and Update Successfully');
    }

    public function unSaves($job_id) {

        $this->data['tab'] = 'saves';
        $id = Auth::id();
        ;
        Save::where('company_id', $id)->where('job_id', $job_id)->where('homeowner_id', null)->delete();
        return redirect('my_saves');
    }

    public function viewJob($job_id) {

        if(Auth::check()){
        $id = Auth::id();
        $data['user']=User::where('id',$id)->with('getSubscription')->first();
        $data['job'] = Job::where('id', $job_id)->with('getFiles', 'getUser', 'getSpeciality')->first();
        $data['check_save'] = Save::where('company_id', $id)->where('job_id', $job_id)->first();
        $data['check_proposal'] = Proposal::where('company_id', $id)->where('job_id', $job_id)->first();
//        dd($data['check_proposal']);
//        dd( $data['check_save']);
//        dd($data['job']);
//        Save::where('company_id', $id)->where('job_id', $job_id)->where('homeowner_id', null)->delete();
            return view('company.proporsal_submit', $data);
        }else{
            return redirect('/');
        }
    }

    public function deleteProposal($proposal_id) {

        $this->data['tab'] = 'dashboard';
        $id = Auth::id();
        Proposal::where('company_id', $id)->where('id', $proposal_id)->delete();
        return redirect('user-dashboard');
    }

    public function deleteImage(Request $request) {


        $this->data['tab'] = 'dashboard';
        $id = Auth::id();
        File::where('id', $request->id)->delete();
        return response()->json(array('success' => 1, 'message' => 'File Deleted Successfullly'));
    }

    public function editProposal(Request $request) {
//        dd($request->all());
        $this->data['tab'] = 'dashboard';

        $files = explode(",", $request->path[0]);
        $type = explode(",", $request->type[0]);
        $name = explode(",", $request->name[0]);

        foreach ($files as $index => $file) {
            $images = new File;
            if ($file != null) {
                $images->path = $file;
                $images->proposal_id = $request->id;
            }
            if ($type[$index] != null) {
                $images->type = $type[$index];
            }
            if ($name[$index] != null) {
                $images->original_name = $name[$index];
            }
            $images->save();
        }

//          


        $proposal = Proposal::where('id', $request->id)->first();
        $proposal->user_name = $request->user_name;
        $proposal->subject = $request->subject;
        $proposal->message = $request->message;
        $proposal->save();
//       for(int $i=0 ; $i<$request->path.length;$i++)
//       {
//           helloo 
//       }

        return response()->json(array('success' => 1, 'message' => 'Proposal Edit'));
    }

    public function checkPassoword(Request $request) {

        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        if (Hash::check($request->password, $user->password)) {
//            $data= '1';
            return response()->json();
        } else {
            $data = '1';
            return response()->json($data);
        }
    }

    public function updatePassword(Request $request) {
        $user_id = Auth::id();
        if ($request->old_password) {

            $user = User::where('id', $user_id)->first();
            $user->password = bcrypt($request->new_password);
//            $user->tab = "loginpassword";
            $user->save();
            $tab_id = "loginpassword";
//             $data['tab_id'] = "loginpassword";
            return redirect('company_profile' . '/' . $tab_id)->with('success', 'Password updated Successfully');
        } else {
//            $user = User::where('id', $user_id)->first();
            $tab_id = "loginpassword";
//            $user->save();
            return redirect('company_profile' . '/' . $tab_id)->with('error', 'First Verify old password');
        }
    }

    public function emailUpdate(Request $request) {
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        $user->email = $request->email;
        $user->tab = 'loginpassword';
        $user->save();

//        Session()->flash('success','Email update successfully');
        $tab_id = "loginpassword";

//        return view('profile.login&password_company',$data);
        return redirect('company_profile' . '/' . $tab_id)->with('success', 'Email update successfully');
    }

    public function uploadImage(Request $request) {


//dd($request->all());

        $image_uploaded = false;
        if ($request->hasFile('file')) {
            $name = $request->file->getClientOriginalName();

            if ($request->file->getClientMimeType() == 'image/jpeg' || $request->file->getClientMimeType() == 'image/png') {
                $type = 'image';
            } else if ($request->file->getClientMimeType() == 'application/pdf') {
                $type = 'pdf';
            } else if ($request->file->getClientMimeType() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                $type = 'doc';
            } else if ($request->file->getClientMimeType() == 'application/x-zip-compressed') {
                $type = 'zip';
            }
            else if ($request->file->getClientMimeType() == 'application/octet-stream') {
//                dd('here');
                $type = 'doc';
            }
            else {
                return response()->json(array('success' => 0, 'message' => 'File not save. Invalid Format'));
            }
            if ($request->project == '1') {
                $image_path = addProposalFile($request->file, 'public/images/project_images/');
            } else {
                $image_path = addProposalFile($request->file, 'public/images/proposal_files/');
            }


            if ($image_path) {

                return response()->json(array('success' => 1, 'path' => $image_path, 'type' => $type, 'name' => $name));
            } else {
                $image_uploaded = true;
                return response()->json(array('success' => 0, 'message' => 'File not save. Invalid Format'));
            }
            return response()->json(array('success' => 0, 'message' => 'Invalid File'));
        }


//        Session()->flash('success','Email update successfully');
//        return view('profile.login&password_company',$data);
    }

    public function getGeneralContractor($tab = '') {

        $id = Auth::id();

        $this->data['result'] = User::where('id', $id)
                ->with('getGeneralContractor.getSpecialities', 'getSubContractor.getSpecialities', 'getProfessional.getSpecialities', 'getSupplier.getSpecialities', 'getOwner.getSpecialities')
                ->first();
        $this->data['gc_services'] = GeneralContractor::where('user_id', $id)->with('getServices.getFile')
                ->whereHas('getServices')
                ->get();
        $this->data['sc_services'] = SubContractor::where('user_id', $id)->with('getServices.getFile')
                ->whereHas('getServices')
                ->get();
        $this->data['sup_services'] = Supplier::where('user_id', $id)->with('getServices.getFile')
                ->whereHas('getServices')
                ->get();
        $this->data['prof_services'] = Professional::where('user_id', $id)->with('getServices.getFile')
                ->whereHas('getServices')
                ->get();
        $this->data['owner_services'] = Owner::where('user_id', $id)->with('getServices.getFile')
                ->whereHas('getServices')
                ->get();
        $this->data['specialities'] = JobSpeciality::get();

        $this->data['image'] = User::where('id', $id)->first();
        $this->data['tab_id'] = $tab;
        $this->data['products'] = Product::where('company_id', $id)->with('getFile')->get();
        $this->data['projects'] = User::where('id', $id)->with('getProjects.getFile')->first();
        if ($tab == 'old') {

            $this->data['reviews'] = \App\Review::where('company_id', $id)->with('getfile', 'getHomeowner')->orderBy('created_at', 'Asc')->get();
            $this->data['reviews_count'] = User::where('users.id', $id)
                            ->with('getRatings.getfile', 'getRatings.getHomeowner')
                            ->selectRaw("users.*,reviews.company_id, reviews.rating,AVG(reviews.rating) AS rating")
                            ->join('reviews', 'reviews.company_id', '=', 'users.id')
                            ->groupBy('users.id')
                            ->withCount('getRatings')->first();
            $this->data['tab_id'] = 'review';
        } else {
            $this->data['reviews'] = \App\Review::where('company_id', $id)->with('getfile', 'getHomeowner')->orderBy('created_at', 'DESC')->get();

            $this->data['reviews_count'] = User::where('users.id', $id)
                            ->with('getRatings.getfile', 'getRatings.getHomeowner')
                            ->selectRaw("users.*,reviews.company_id, reviews.rating,AVG(reviews.rating) AS rating")
                            ->join('reviews', 'reviews.company_id', '=', 'users.id')
                            ->groupBy('users.id')
                            ->withCount('getRatings')->first();
//            $this->data['tab_id'] = 'review';
        }

        $this->data['business'] = User::where('id', $id)->with('getCompanyDetail')->first();

        return view('company.index', $this->data);
    }

    public function addDescription(Request $request) {



        $id = Auth::id();
//        dd($request->all());
        if ($request->type == 'gc') {
            $tab = '';

            if ($request->id) {
                $general_contractor = GeneralContractor::where('id', $request->id)->first();
                $general_contractor->description = $request->description;
                $general_contractor->save();
            } else {
                $general_contractor = new GeneralContractor;
                $general_contractor->description = $request->description;
                $general_contractor->user_id = $id;
                $general_contractor->save();
            }
        } else if ($request->type == 'professional') {
            $tab = 'professional';
            if ($request->id) {
                $general_contractor = Professional::where('id', $request->id)->first();
                $general_contractor->description = $request->description;
                $general_contractor->save();
            } else {
                $general_contractor = new Professional;
                $general_contractor->description = $request->description;
                $general_contractor->user_id = $id;
                $general_contractor->save();
            }
        } else if ($request->type == 'supplier') {
            $tab = 'supplier';
            if ($request->id) {
                $general_contractor = Supplier::where('id', $request->id)->first();
                $general_contractor->description = $request->description;
                $general_contractor->save();
            } else {
                $general_contractor = new Supplier;
                $general_contractor->description = $request->description;
                $general_contractor->user_id = $id;
                $general_contractor->save();
            }
        } else if ($request->type == 'sub_contractor') {
            $tab = 'sc';
            if ($request->id) {
                $general_contractor = SubContractor::where('id', $request->id)->first();
                $general_contractor->description = $request->description;
                $general_contractor->save();
            } else {
                $general_contractor = new SubContractor;
                $general_contractor->description = $request->description;
                $general_contractor->user_id = $id;
                $general_contractor->save();
            }
        } else if ($request->type == 'owner') {
            $tab = 'owner';
            if ($request->id) {
                $general_contractor = Owner::where('id', $request->id)->first();
                $general_contractor->description = $request->description;
                $general_contractor->save();
            } else {
                $general_contractor = new Owner;
                $general_contractor->description = $request->description;
                $general_contractor->user_id = $id;
                $general_contractor->save();
            }
        }




        return redirect('view_contractor/' . $tab)->with('success', 'Description added successfully!');
    }

    public function addService(Request $request) {



        $this->data['tab'] = 'dashboard';
        $id = Auth::id();
        if ($request->hasFile('file')) {
            $name = $request->file->getClientOriginalName();
        }
        if ($request->type == 'gc') {
            $tab = '';
            if ($request->id) {
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->gc_id = $request->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
//            $general_contractor = GeneralContractor::where('id', $request->id)->first();
//            $general_contractor->description = $request->description;
//            $general_contractor->save();
            } else {

                $general_contractor = new GeneralContractor;
                $general_contractor->user_id = $id;
                $general_contractor->save();
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->gc_id = $general_contractor->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            }
        } else if ($request->type == 'professional') {
            $tab = 'professional';
            if ($request->id) {
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->professional_id = $request->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            } else {
                $general_contractor = new Professional;
                $general_contractor->user_id = $id;
                $general_contractor->save();
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->professional_id = $general_contractor->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            }
        } else if ($request->type == 'supplier') {
            $tab = 'supplier';
            if ($request->id) {
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->supplier_id = $request->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            } else {
                $general_contractor = new Supplier;
                $general_contractor->user_id = $id;
                $general_contractor->save();
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->supplier_id = $general_contractor->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            }
        } else if ($request->type == 'sub_contractor') {
            $tab = 'sc';
            if ($request->id) {
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->sc_id = $request->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            } else {
                $general_contractor = new SubContractor;
                $general_contractor->user_id = $id;
                $general_contractor->save();
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->sc_id = $general_contractor->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            }
        } else if ($request->type == 'owner') {
            $tab = 'owner';
            if ($request->id) {
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->owner_id = $request->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            } else {
                $general_contractor = new Owner;
                $general_contractor->user_id = $id;
                $general_contractor->save();
                $service = new Service;
                $service->title = $request->title;
                $service->cost_start = $request->cost_start;
                $service->cost_end = $request->cost_end;
                $service->location = $request->location;
                $service->description = $request->description;
                $service->owner_id = $general_contractor->id;
                $service->save();
                $image_uploaded = false;
                if ($request->hasFile('file')) {

                    $image_path = addFile($request->file, 'public/images/service_images/');

                    if ($image_path) {
                        $file = new File;
                        $file->path = $image_path;
                        $file->original_name = $name;
                        $file->service_id = $service->id;
                        $file->save();
                    }
                }
            }
        }


        return redirect('view_contractor/' . $tab)->with('success', 'Service added successfully!');
    }

    public function updateEmailNotificationSettings(Request $request) {
      
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();
        $user_detail = CompanyDetail::where('user_id', $user_id)->first();

        if ($request->update_web_notification) {
            $user->update_web_notification = '0';
        } else {
            $user->update_web_notification = '1';
        }
        if ($request->service_qoute_notication) {

            $user_detail->service_qoute_notication = '0';
        } else {
            $user_detail->service_qoute_notication = '1';
        }
        if ($request->review_notification) {
            $user_detail->review_notification = '0';
        } else {
            $user_detail->review_notification = '1';
        }

        $user->tab = "email&notification";

        $user->save();

        $user_detail->save();
        return redirect('company_profile/' . $user->tab)->with('success', 'Notification updated successfully!');
    }

    public function editService(Request $request) {

        if ($request->hasFile('file')) {
            $name = $request->file->getClientOriginalName();

            $image = File::where('service_id', $request->id)->first();
            if ($image) {
                $image_path = addFile($request->file, 'public/images/service_images/');
                $image->path = $image_path;
                $image->service_id = $request->id;
                $image->original_name = $name;
                $image->save();
            } else {
                $image = new File;
                $image_path = addFile($request->file, 'public/images/service_images/');
                $image->path = $image_path;
                $image->service_id = $request->id;
                $image->original_name = $name;
                $image->save();
            }
        }
        if ($request->type == 'gc') {
            $tab = '';
            $service = Service::where('id', $request->id)->first();
            $service->title = $request->title;
            $service->cost_start = $request->cost_start;
            $service->cost_end = $request->cost_end;
            $service->description = $request->description;
            $service->location = $request->location;
            $service->save();
        } else if ($request->type == 'prof') {
            $tab = 'professional';
            $service = Service::where('id', $request->id)->first();
            $service->title = $request->title;
            $service->cost_start = $request->cost_start;
            $service->cost_end = $request->cost_end;
            $service->description = $request->description;
            $service->location = $request->location;
            $service->save();
        } elseif ($request->type == 'sup') {
            $tab = 'supplier';
            $service = Service::where('id', $request->id)->first();
            $service->title = $request->title;
            $service->cost_start = $request->cost_start;
            $service->cost_end = $request->cost_end;
            $service->description = $request->description;
            $service->location = $request->location;
            $service->save();
        } elseif ($request->type == 'sc') {
            $tab = 'supplier';
            $service = Service::where('id', $request->id)->first();
            $service->title = $request->title;
            $service->cost_start = $request->cost_start;
            $service->cost_end = $request->cost_end;
            $service->description = $request->description;
            $service->location = $request->location;
            $service->save();
        } elseif ($request->type == 'owner') {
            $tab = 'owner';
            $service = Service::where('id', $request->id)->first();
            $service->title = $request->title;
            $service->cost_start = $request->cost_start;
            $service->cost_end = $request->cost_end;
            $service->description = $request->description;
            $service->location = $request->location;
            $service->save();
        }
        return redirect('view_contractor/' . $tab)->with('success', 'Service edit successfully!');
    }

    public function addProduct(Request $request) {
//        dd($request->all());
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'location' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $user_id = Auth::id();
//        dd($user_id);
      
        $product = new Product();
        $product->company_id = $user_id;
        $product->title = $request->title;
        $product->price = $request->price;
        if($request->type=='not_available')
        {
            $product->type = 'not available';
            
        }else
        {
            $product->type = $request->type;
        }
        $product->location = $request->location;
        $product->lat = $request->lat;
        $product->lng = $request->lng;

        if ($request->is_hide) {

            $product->is_hide = '1';
        }
//        dd($product);
        $product->save();
        $image_uploaded = false;
        if ($request->hasFile('image')) {

            $image_path = addFile($request->image, 'public/images/product_images/');

            if ($image_path) {
                $file = new File;
                $file->path = $image_path;
                $file->product_id = $product->id;
                $file->type = 'image';
                $file->save();
            }
        }
        $tab = 'store';

        return redirect('view_contractor/' . $tab)->with('success', 'Product added successfully!');
    }

    public function updateProduct(Request $request) {

        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'location' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $user_id = Auth::id();
//        dd($user_id);
        $product_id = $request->id;
        $file_id = $request->file_id;
        $product = Product::where('id', $product_id)->first();
//        $product = new Product();
        $product->company_id = $user_id;
        $product->title = $request->title;
        $product->price = $request->price;
        if($request->type=='not_available')
        {
            $product->type = 'not available';
            
        }else
        {
            $product->type = $request->type;
        }
        
        $product->location = $request->location;
        $product->lat = $request->lat;
        $product->lng = $request->lng;
//        if ($request->is_hide) {
        if ($request->is_hide == 'on') {
//                dd('here');
            $product->is_hide = '1';
        } else {
            $product->is_hide = '0';
        }
//        }
//        dd($product);
        $product->save();
        $image_uploaded = false;
        if ($request->hasFile('image')) {

            $image_path = addFile($request->image, 'public/images/product_images/');

            if ($image_path) {
                $file = File::where('id', $file_id)->first();
//                dd($file);
                $file->path = $image_path;
                $file->product_id = $product->id;
                $file->type = 'image';
                $file->save();
            }
        }
        $tab = 'store';
        return redirect('view_contractor/' . $tab)->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id) {
//        dd($id);

        Product:: where('id', $id)->delete();
        $tab = 'store';
        return redirect('view_contractor/' . $tab)->with('success', 'Product deleted successfully!');
    }

    public function deleteProject($id) {
//        dd($id);

        Project:: where('id', $id)->delete();
        $tab = 'project';
        return redirect('view_contractor/' . $tab)->with('success', 'Project deleted successfully!');
    }

    public function addProject(Request $request) {
//        dd($request->all());
//        $request->validate([
//            'title' => 'required',
//            'location' => 'required',
//            'description' => 'required',
//            'photo' => 'required',
//        ]);
        $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'description' => 'required',
                    'location' => 'required',
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($validator->fails()) {
            return redirect('view_contractor/project')
                            ->withErrors($validator)
                            ->withInput();
        }
        $comppany_id = Auth::id();
        $files = explode(",", $request->path[0]);

        $project = new Project();
        $project->company_id = $comppany_id;
        $project->title = $request->title;
        $project->location = $request->location;
        $project->description = $request->description;

        if ($request->is_hide) {
            if ($request->is_hide == 'on') {
                $project->is_hide = '1';
            } else {
                $project->is_hide = '0';
            }
        }
        $project->save();
        if ($request->hasFile('photo')) {

            foreach ($files as $index => $file) {
                $images = new File;
                if ($file != null) {
//                dd($file);
                    $images->path = $file;
                    $images->project_id = $project->id;
                    $images->type = 'image';
                }

                $images->save();
            }
        }
        $tab = 'project';
        return redirect('view_contractor/' . $tab)->with('success', 'Project added successfully!');
    }

    public function deleteService($id, $tab) {
        if ($tab == 'gc') {
            $tab = '';
        }

        Service:: where('id', $id)->delete();
        File::where('service_id', $id)->delete();

        return redirect('view_contractor/' . $tab)->with('success', 'Service deleted successfully!');
    }

    public function uploadCover(Request $request) {

        $user_id = Auth::id();

        if ($request->hasFile('file')) {

            $image_path = addFile($request->file, 'public/images/prfile_images/');

            if ($image_path) {
                $user = User::where('id', $user_id)->first();
                $user->cover_image = $image_path;
                $user->save();

                return response()->json(array('success' => 1, 'message' => 'Banner Uploaded'));
            } else {

                return response()->json(array('success' => 0, 'message' => 'Banner not Uploaded. Invalid Format'));
            }
        } else {
            return response()->json(array('success' => 0, 'message' => 'Banner not Uploaded. Invalid Format'));
        }
    }

    public function projectDetail($id) {

        $user_id = Auth::id();
        $data['project_detial'] = Project::where('id', $id)->with('getFile', 'getComapny')->first();
        $data['more_projects'] = Project::where('company_id', $user_id)->with('getFile')->get();
//        dd($data['more_projects']);
        return view('company.project-detail', $data);
    }

    public function updateProject(Request $request) {
//        echo '<pre>';
//        print_r($request->all());exit;
//        dd($request->is_hide);
        $id = $request->id;
        $files = '';
        if ($request->path) {
            $files = json_decode($request->path[0]);
        }
        $project = Project::where('id', $id)->first();
        $project->title = $request->title;
        $project->location = $request->location;
        $project->description = $request->description;
        $project->description = $request->description;

        if ($request->is_hide == 'on') {
            $project->is_hide = '1';
        } else {
//                dd('hree');
            $project->is_hide = '0';
        }

        $project->save();

//        if ($request->hasFile('photoooo')) {
//              
        if ($request->path[0]) {
            foreach ($files as $file) {
                $images = new File;
                $images->path = $file;
                $images->project_id = $project->id;
                $images->type = 'image';
                $images->save();
            }
        }

        $tab = 'project';
        return redirect('view_contractor/' . $tab)->with('success', 'Project updated successfully!');
    }

//    public function addSpeciality(Request $request) {
//
//      
//        if ($validator->fails()) {
//            $errors = implode(', ', $validator->errors()->all());
//            return response()->json(array('success' => 0, 'message' => $errors));
//        }
//        if ($request->type == 'gc') {
//            $speciality = new Specialities;
//            $speciality->gc_id = $request->id;
//            $speciality->name = $request->speciality;
//        } else if ($request->type == 'prof') {
//            $speciality = new Specialities;
//            $speciality->professional_id = $request->id;
//            $speciality->name = $request->speciality;
//        } else if ($request->type == 'sup') {
//            $speciality = new Specialities;
//            $speciality->supplier_id = $request->id;
//            $speciality->name = $request->speciality;
//        } else if ($request->type == 'sc') {
//            $speciality = new Specialities;
//            $speciality->sc_id = $request->id;
//            $speciality->name = $request->speciality;
//        } else if ($request->type == 'owner') {
//            $speciality = new Specialities;
//            $speciality->owner_id = $request->id;
//            $speciality->name = $request->speciality;
//        }
//
//
//        $speciality->save();
//
//        return response()->json(array('success' => 1, 'message' => 'Speciality Added', 'id' => $speciality->id));
//    }

    public function addSpecialityAdmin(Request $request) {
//        dd($request->all());
        $user_id = Auth::id();
        $special = explode(",", $request->specialities[0]);
        $id = explode(",", $request->specialities_id[0]);
        if ($request->type == 'gc') {
            $tab = '';
            if ($request->sp_id) {
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->gc_id = $request->sp_id;


                            if ($id[$index] != null && $id[$index] != '') {

                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            } else {
                $gc = new GeneralContractor;
                $gc->user_id = $user_id;
                $gc->save();
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->gc_id = $gc->id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            }
        } else if ($request->type == 'sc') {
            $tab = 'sc';
            if ($request->sp_id) {
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->sc_id = $request->sp_id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            } else {
                $gc = new SubContractor;
                $gc->user_id = $user_id;
                $gc->save();
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->sc_id = $gc->id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            }
        } else if ($request->type == 'sup') {
            $tab = 'supplier';
            if ($request->sp_id) {
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->supplier_id = $request->sp_id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            } else {
                $gc = new Supplier;
                $gc->user_id = $user_id;
                $gc->save();
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->supplier_id = $gc->id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            }
        } else if ($request->type == 'prof') {
            $tab = 'professional';
            if ($request->sp_id) {
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->professional_id = $request->sp_id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            } else {
                $gc = new Professional;
                $gc->user_id = $user_id;
                $gc->save();
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->professional = $gc->id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            }
        } else if ($request->type == 'owner') {
            $tab = 'owner';

            if ($request->sp_id) {
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->owner_id = $request->sp_id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            } else {

                $gc = new Owner;

                $gc->user_id = $user_id;

                $gc->save();
                if ($request->specialities[0] != null && $request->specialities_id[0] != null) {
                    foreach ($special as $index => $specialities) {


                        if ($specialities != null && $specialities != '') {
                            $speciality = new Specialities;
                            $speciality->name = $specialities;
                            $speciality->owner_id = $gc->id;


                            if ($id[$index] != null && $id[$index] != '') {
                                $speciality->speciality_id = $id[$index];
                            }
                            $speciality->company_id = $user_id;
                            $speciality->save();
                        }
                    }
                }
            }
        }



        return redirect('view_contractor/' . $tab)->with('success', 'Specialities Added!');
    }

    public function deleteSpeciality(Request $request) {


        Specialities:: where('id', $request->id)->delete();
        return response()->json(array('success' => 1, 'message' => 'Speciality Deleted'));
    }

    public function deleteProjectImage(Request $request) {
//        dd($request->all());
        $file = File::where('id', $request->id)->delete();

        return response()->json(array('success' => 1, 'message' => 'Image Deleted'));
    }

    public function updateEditBusinees(Request $request) {
//        dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'home_address' => 'required',
            'email' => 'required',
        ]);
        $user = User::where('id', $request->comopany_id)->first();
        $company_detail = CompanyDetail::where('id', $request->comopany_detail_id)->first();
        $user->first_name = $request->first_name;
        $user->home_address = $request->home_address;
        $user->email = $request->email;
        $image_uploaded = false;
        if ($request->hasFile('photo')) {

            $image_path = addFile($request->photo, 'public/images/profile_images/');
            $user->profile_image = $image_path;
        }

        $company_detail->bio = $request->bio;
        $company_detail->service_provided = $request->service_provided;
        $company_detail->area_served = $request->area_served;
        $company_detail->website = $request->website;
        $company_detail->fb_link = $request->fb_link;
        $company_detail->insta_link = $request->insta_link;
        $company_detail->linkedin_link = $request->linkedin_link;
        $company_detail->twitter_link = $request->twitter_link;
        $user->save();
        $company_detail->save();
        $tab = 'edit_business';
        return redirect('view_contractor/' . $tab)->with('success', 'Business updated successfully!');
    }

    public function cancelSubscription() {
        
        $mytime = Carbon\Carbon::now();

        $id = Auth::id();
        
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $sub = Subscription::where('user_id', $id)->first();

            $sub = \Stripe\Subscription::retrieve($sub->stripe_id);
            $sub->cancel();
            $subcr = Subscription::where('user_id', $id)->first();
//            $subcr->trial_ends_at = $mytime->toDateString();
            $subcr->delete();

//            $sub->delete();
//            $subcr = Subscription::where('user_id', $id)->first();
//            $subcr->trial_ends_at = $mytime->toDateString();
//            
//            $sub->save();
//
////            $sub->save();
        } catch (\Stripe\Error\Card $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\RateLimit $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\InvalidRequest $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\Authentication $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\ApiConnection $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\Base $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (Exception $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        $tab = "memberships";
        return redirect('company_profile' . '/' . $tab)->with('success', 'Subscription canceled successfully!');
    }

    public function updateStripeCustomer(Request $request) {
        $id = Auth::id();
        $customer = User::where('id', $id)->with('getSubscription')->first();

        $user = User::where('id', $id)->first();
        $subscription = Subscription::where('user_id', $id)->first();
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a Customer:
            $customer = \Stripe\Customer::create([
                        'source' => $request->stripeToken,
                        'email' => $customer->email,
            ]);
//            dd($customer->sources->data[0]  );
            $user->stripe_id = $customer->id;
            $user->card_brand = $customer->sources->data[0]->brand;
            $user->card_last_four = $customer->sources->data[0]->last4;

            $subscription->name = $request->name;
            $subscription->save();
            $user->save();
        } catch (\Stripe\Error\Card $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\RateLimit $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\InvalidRequest $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\Authentication $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\ApiConnection $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (\Stripe\Error\Base $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        } catch (Exception $e) {

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
        $tab = "memberships";
        return redirect('company_profile' . '/' . $tab)->with('success', 'Card credentialsupdated successfully!');
    }

    public function changeMembership(Request $request) {
//        dd($request->all());
        $request->validate([
            'choose_plan' => 'required',
        ]);

        $id = Auth::id();
        $user_id = Auth::id();

        $company = User::where('id', $id)->first();
        $sub = Subscription::where('user_id', $id)->first();
        $token = $request->stripeToken;
        $plan = $request->choose_plan;
        $bids = '';
//        $plan_id = 'plan_FKCSaXgiW2R6bt';
        if ($plan == 'limited') {
            $plan_id = 'plan_FhkJScuGNd74AI';
            $bids='15';
        } else {
            $plan_id = 'plan_FhkJmntlLpw7Di';
            
        }
//        echo '<pre>';
//        print_r($sub);
//        exit;
        if ($sub) {
            try {

                $subcription = \Stripe\Subscription::retrieve($sub->stripe_id);
//            
                $dt = date("Y-m-d H:i:s", $subcription->current_period_end);
//
                $DeferenceInDays = Carbon\Carbon::parse(Carbon\Carbon::now())->diffInDays($dt);
//                dd($DeferenceInDays);
                if ($DeferenceInDays <= 30) {
                  $trail =   $company->newSubscription($request->name, $plan_id)
                            ->trialDays($DeferenceInDays)
                            ->create($token);
                            
                    $sub->delete();

                    $subsc = Subscription::where('user_id', $id)->first();
                    $subscription_id = $subsc->stripe_id;
                    
                    $stripe_details = \Stripe\Subscription::retrieve($subscription_id);
                    
                    $timestamp = $stripe_details->current_period_end;
                    $periods_end = date('Y-m-d H:i:s', $timestamp);
                    $subsc->trial_ends_at = $dt;
                    $subsc->ends_at = $periods_end;
                    $subsc->status = '1';
                    $subsc->bids = $bids;
                    $subsc->count = $subsc->count + 1;
                    $subsc->save();
//                    dd($trail);
                } else {
                    if ($company->newSubscription('Construction', $plan_id)->create($token)) {
                        $sub->delete();
                        $tab = 'memberships';
                        return redirect('company_profile' . '/' . $tab)->with('success', 'Subscription plan purchased successfully.');
                    }
                }
            } catch (\Stripe\Error\Card $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\RateLimit $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\InvalidRequest $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\Authentication $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\ApiConnection $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\Base $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (Exception $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
            $tab = 'memberships';
            return redirect('company_profile' . '/' . $tab)->with('success', 'Subscription plan change successfully');
        } else {
            try {
                if ($company->newSubscription('Construction', $plan_id)->create($token)) {
//                    $old_subcription = Subscription::where('user_id', $id)->where('stripe_plan', 'Free')->delete();
                    $subs = Subscription::where('user_id', $user_id)->first();
                    $subscription_id = $subs->stripe_id;
                    $stripe_details = \Stripe\Subscription::retrieve($subscription_id);
                    $timestamp = $stripe_details->current_period_end;
                    $periods_end = date('Y-m-d H:i:s', $timestamp);
                    $subs->ends_at = $periods_end;
//                    $subs->status = '1';
                    $subs->bids = $bids;
                    $subs->count = '0';
                    $subs->save();

                    $tab = 'memberships';
                    return redirect('company_profile' . '/' . $tab)->with('success', 'Subscription plan purchased successfully.');
                }
            } catch (\Stripe\Error\Card $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\RateLimit $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\InvalidRequest $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\Authentication $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\ApiConnection $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (\Stripe\Error\Base $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            } catch (Exception $e) {

                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
        }
    }

    public function jobSearch() {
        $data['specialities'] = JobSpeciality::all();
        $data['result'] = Job::with('getUser', 'getSpeciality')->get();
        $data['total_count'] = Job::all()->count();
        $data['categories'] = JobSpeciality::all();
        $data['current_date_time'] = Carbon\Carbon::now();

        return view('home.job_search', $data);
    }

    public function postJobSearch(Request $request) {

        $id=Auth::id();
        $res['user']=User::where('id',$id)->with('getSubscription')->first();
        $lat = $request->lat;
        $lng = $request->lng;

        $name = $request->job_name;
        $speciality = $request->specialities;
        $loc = $request->location;
//        $guest_job = $request->search_company_guest;
//        dd($guest_job);
        $radius = 7000;

        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lng)) + sin(radians($lat)) * sin(radians(latitude))))";
//        ->when($guest_job, function($query) use($guest_job) {
//                    $query->where('title', 'like', "%$guest_job%");
//                })
        $res['result'] = Job::where('is_draft','0')->with('getUser')->when($name, function($query) use($name) {
                            $query->where('title', 'like', "%$name%");
                        })->when($lat, function($query) use($haversine, $radius) {
                            $query->selectRaw("* ,{$haversine} AS distance")
                            ->whereRaw("{$haversine} < ?", [$radius])
                            ->orderByRaw("distance");
                        })
                        ->when($request->val_emp, function($cat) use($request) {
                            $cat->whereIn('category', $request->val_emp);
                        })
                        ->when($speciality, function($sep) use($speciality) {
                            $sep->whereHas('getSpeciality', function($q) use($speciality) {
                                $q->where('job_id', '!=', 'Null');
                                $q->whereIn('name', $speciality);
                            });
                        })->orderBy('created_at', 'desc')->get();

        $res['current_date_time'] = Carbon\Carbon::now();
        $response = new \stdClass();
        $response->view = view('company.search_result', $res)->render();
        $response->total_count = count($res['result']);
        echo json_encode($response);
    }

    public function addProposal(Request $request) {
//        dd($request->all());
//        $type = $request->file->getClientMimeType();
//        $this->validate($request, ['file' => 'image|mimes:jpeg,png,jpg,application/octet-stream,application/x-zip-compressed,application/pdf',]);
        $id = Auth::id();
//        dd($id);
        $company=User::where('id',$id)->first();

//        $subcription = Subscription::where('user_id', $id)->where('status', '1')->where('ends_at', '>', Carbon\Carbon::now())->first();
        $subcription = Subscription::where('user_id', $id)->first();
//    if ($subcription) {
//            if ($subcription->stripe_plan == 'plan_FKCSaXgiW2R6bt') {
//                $plan = "unlimited";
//                $bids = 'unlimited';
//            } else if ($subcription->stripe_plan == 'plan_FKCRHwmswfjnkI') {
//                $plan = "limited";
//                $bids = '60';
//            } else if ($subcription->stripe_plan == 'Free') {
//                $plan = "free";
//                $bids = '10';
//            }
//            $proposel = Proposal::where('company_id', $id)->whereBetween('created_at', [$subcription->created_at, $subcription->ends_at])->count();
//
//            if ($bids == 'unlimited' || $proposel <= $bids) {
//                $proposel = new Proposal();
//                $proposel->company_id = $id;
//                $proposel->job_id = $request->job_id;
//                $proposel->user_name = $request->user_name;
//                $proposel->subject = $request->subject;
//                $proposel->message = $request->message;
//                $proposel->save();
//                if ($request->hasFile('file')) {
//
//                    $image_path = addProposalFileType($request->file, 'public/images/proposal_files/');
//
//                    $type = '';
//                    if ($image_path['type'] == 'image/jpeg' || $image_path['type'] == 'image/png') {
//                        $type = 'image';
//                    } else if ($image_path['type'] == 'application/pdf') {
//                        $type = 'pdf';
//                    } else {
//                        $type = 'doc';
//                    }
//                    $image = new File;
//
//                    $image->path = $image_path['path'];
//                    $image->proposal_id = $proposel->id;
//                    $image->type = $type;
//
//                    $image->save();
//                }
//                $user_id = Job::where('id', $request->job_id)->first();
//                $notification = new Notification();
//                $notification->from_user = $id;
//                $notification->to_user = $user_id->user_id;
//                $notification->proposal_id = $proposel->id;
//                $notification->type = 'proposal';
//                $notification->title = 'Proposal has been submitted to your job';
//                $notification->save();
//                $home_owner = User::where('id', $user_id->user_id)->where('type', 'homeowner')->first();
//                $viewData['name'] = $home_owner->first_name;
//                Mail::send('email_template.proposal_email', $viewData, function ($m) use ($home_owner) {
//                    $m->from(env('FROM_EMAIL'), 'ConstructBid App');
//                    $m->to($home_owner->email, $home_owner->first_name)->subject('Got proposal on your job');
//                });
//
//                return redirect()->back()->with('success', 'Proposal has been submmitted successfully!');
//            }
//        } 
        
        $job = Job::where('id',$request->job_id)->first();
        $speciality = Specialities::where('job_id',$job->id)->get();
        $name;
        foreach($speciality as $spec){
            $name[] = $spec->name;
        }
//        dd($name);
        $company_id = '';
        $max_match = '';
        $company_job = Specialities::whereIn('name',$name)->where('company_id','!=','')->select('company_id', DB::raw('COUNT(specialities.name)'))->groupBy('company_id')->orderBy(DB::raw('COUNT(specialities.name)'),'desc')->get();

        foreach($company_job as $company){
            
                if($company->company_id == $id){
                    $company_id = $company->company_id;
                    $max_match = $company['COUNT(specialities.name)'];
                }
                
            }
                
        if ($subcription) {
            if($subcription->stripe_plan=='plan_FhkJmntlLpw7Di'){
//                dd('unlimted');
            $proposel = new Proposal();
            $proposel->company_id = $id;
            $proposel->job_id = $request->job_id;
            $proposel->user_name = $request->user_name;
            $proposel->subject = $request->subject;
            $proposel->message = $request->message;
            if($company_id){
                $proposel->match_specialties = $max_match;
            }
//            dd($proposel);
            $proposel->save();
            if ($request->hasFile('file')) {

                $image_path = addProposalFileType($request->file, 'public/images/proposal_files/');

                $type = '';
                if ($image_path['type'] == 'image/jpeg' || $image_path['type'] == 'image/png') {
                    $type = 'image';
                } else if ($image_path['type'] == 'application/pdf') {
                    $type = 'pdf';
                } else {
                    $type = 'doc';
                }
                $image = new File;

                $image->path = $image_path['path'];
                $image->proposal_id = $proposel->id;
                $image->type = $type;

                $image->save();
            }
          
            $user_id = Job::where('id', $request->job_id)->first();
            $home_owner = User::where('id', $user_id->user_id)->where('type', 'homeowner')->first();
            if($home_owner->activity_on_job == '0'){
            $notification = new Notification();
            $notification->from_user = $id;
            $notification->to_user = $user_id->user_id;
            $notification->proposal_id = $proposel->id;
            $notification->type = 'proposal';
            $notification->is_read = 1;
            $notification->title = 'Proposal has been submitted to your job';
            $notification->save();
            }
            $viewData['home_name'] = $home_owner->first_name.' '.$home_owner->last_name;
            $viewData['company_name'] = $company->first_name.' '.$company->last_name;
            $viewData['subject'] = $request->subject;
            $viewData['messagee'] = $request->message;
            $viewData['acceept'] = url('proposal_check/' . $proposel->id . '/' . 'accept');
            $viewData['reject'] = url('proposal_check/' . $proposel->id . '/' . 'reject');
            $viewData['view_job'] = url('view_public_job/' . $request->job_id);
//                $viewData['view_job'] = url('view_public_job/' . $request->job_id);
            if($home_owner->activity_on_job == '0'){
                Mail::send('email_template.proposal', $viewData, function ($m) use ($home_owner) {
                    $m->from(env('FROM_EMAIL'), 'ConstructBid App');
                    $m->to($home_owner->email, $home_owner->first_name)->subject('Got proposal on your job');
                });
            }
            return redirect()->back()->with('success', 'Proposal has been submmitted successfully!');
        } else{
//            dd('limited');
            if($subcription->bids > '0')
            {
                  $proposel = new Proposal();
            $proposel->company_id = $id;
            $proposel->job_id = $request->job_id;
            $proposel->user_name = $request->user_name;
            $proposel->subject = $request->subject;
            $proposel->message = $request->message;
            if($company_id){
                $proposel->match_specialties = $max_match;
            }
            $proposel->save();
            if ($request->hasFile('file')) {

                $image_path = addProposalFileType($request->file, 'public/images/proposal_files/');

                $type = '';
                if ($image_path['type'] == 'image/jpeg' || $image_path['type'] == 'image/png') {
                    $type = 'image';
                } else if ($image_path['type'] == 'application/pdf') {
                    $type = 'pdf';
                } else {
                    $type = 'doc';
                }
                $image = new File;

                $image->path = $image_path['path'];
                $image->proposal_id = $proposel->id;
                $image->type = $type;

                $image->save();
            }
          
            $user_id = Job::where('id', $request->job_id)->first();
            $home_owner = User::where('id', $user_id->user_id)->where('type', 'homeowner')->first();
            if($home_owner->activity_on_job == '0'){
            $notification = new Notification();
            $notification->from_user = $id;
            $notification->to_user = $user_id->user_id;
            $notification->proposal_id = $proposel->id;
            $notification->type = 'proposal';
            $notification->is_read = 1;
            $notification->title = 'Proposal has been submitted to your job';
            $notification->save();
            }
            $viewData['home_name'] = $home_owner->first_name.' '.$home_owner->last_name;
            $viewData['company_name'] = $company->first_name.' '.$company->last_name;
            $viewData['subject'] = $request->subject;
            $viewData['messagee'] = $request->message;
            $viewData['acceept'] = url('proposal_check/' . $proposel->id . '/' . 'accept');
            $viewData['reject'] = url('proposal_check/' . $proposel->id . '/' . 'reject');
            $viewData['view_job'] = url('view_public_job/' . $request->job_id);
//                $viewData['view_job'] = url('view_public_job/' . $request->job_id);
            if($home_owner->activity_on_job == '0'){
                Mail::send('email_template.proposal', $viewData, function ($m) use ($home_owner) {
                    $m->from(env('FROM_EMAIL'), 'ConstructBid App');
                    $m->to($home_owner->email, $home_owner->first_name)->subject('Got proposal on your job');
                });
            }
            $subcription->bids--;
            $subcription->save();
            return redirect()->back()->with('success', 'Proposal has been submmitted successfully!');
            }
            else{
                 return redirect()->back()->with('error', 'No Bids Remaining.Upgrade Membership');
            }
            
        } } else {
            return redirect()->back()->with('error', 'Purchase Subscription');
        }
    }

    function downloadFile($id) {
        $files = File::where('id', $id)->first();
        $new_path = str_replace("public", "", $files->path);
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . $new_path;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $files->original_name, $headers);
    }

    public function companyNotification() {
        $id = Auth::id();

        $data['notifications'] = Notification::where('to_user', $id)->with('getSender')->orderBy('created_at','desc')->get();
        foreach($data['notifications'] as $notifications){
            $notifications->is_read=0;
            $notifications->save();
        }

//        dd($data['notifications']);
        return view('profile.notification', $data);
    }

    public function saveJob($id) {
//        dd($id);

        $save = new Save();
        $save->job_id = $id;
        $save->company_id = Auth::id();
        $save->save();
        return redirect('my_saves')->with('success', 'Job saved successfully!');
    }

    public function newsletter(Request $request) {

        $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return response()->json(array('success' => 0, 'message' => $errors));
        }
        $email = NewsLetter::where('email', $request->email)->first();

        if ($email) {
            return response()->json(array('success' => 0, 'message' => 'Email Already Registered'));
        }
        $emails = new NewsLetter;
        $emails->email = $request->email;
        $emails->save();
        return response()->json(array('success' => 1, 'message' => 'Email Is Registered.We will notify You'));
    }

    public function uploadProjectImage(Request $request) {

        $image_uploaded = false;
        if ($request->hasFile('file')) {
            $name = $request->file->getClientOriginalName();
            if ($request->file->getClientMimeType() == 'image/jpeg' || $request->file->getClientMimeType() == 'image/png') {
                $type = 'image';
            } else if ($request->file->getClientMimeType() == 'application/pdf') {
                $type = 'pdf';
            } else if ($request->file->getClientMimeType() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                $type = 'doc';
            } else if ($request->file->getClientMimeType() == 'application/x-zip-compressed') {
                $type = 'zip';
            } else {
                return response()->json(array('success' => 0, 'message' => 'File not save. Invalid Format'));
            }

            $image_path = addProposalFile($request->file, 'public/images/job_files/');



            if ($image_path) {
                $add_file = new File();
                $add_file->project_id = $request->project;
                $add_file->path = $image_path;
                $add_file->save();
                return response()->json(array('success' => 1, 'path' => $image_path, 'type' => $type, 'name' => $name));
            } else {
                $image_uploaded = true;
                return response()->json(array('success' => 0, 'message' => 'File not save. Invalid Format'));
            }
            return response()->json(array('success' => 0, 'message' => 'Invalid File'));
        }


//        Session()->flash('success','Email update successfully');
//        return view('profile.login&password_company',$data);
    }

}
