<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Job;
use App\Save;
use App\User;
use App\File;
use App\Review;
use App\Project;
use App\Contact;
use App\Service;
use App\Specialities;
use App\JobSpeciality;
use App\Proposal;
use App\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class HomeOwnerController extends Controller {

    public function dashboard() {

        $id = Auth::id();
        $this->data['counts'] = 0;
        $this->data['jobs'] = Job::where('user_id', $id)->where('is_draft', 0)->with('getFiles')->orderBy('created_at','desc')->get();
        $this->data['drafts'] = Job::where('user_id', $id)->where('is_draft', 1)->with('getFiles')->orderBy('created_at','desc')->get();
        $this->data['saves_count'] = Save::where('homeowner_id', $id)->where('company_id', '!=', null)->count();
        $this->data['count'] = Job::where('user_id', $id)->count();
        $this->data['image'] = User::where('id', $id)->first();
//        $this->data['categories'] = JobSpeciality::all();
//        dd($this->data);
        $data['proposal_count'] = Job::where('user_id', $id)->withCount('getProposal')->get();
//        dd($data['proposal_count']);
        foreach ($data['proposal_count'] as $count) {
            $this->data['counts'] = $this->data['counts'] + $count->get_proposal_count;
        }
        return view('home.user-dashboard', $this->data);
    }

    public function mySaves() {

        $id = Auth::id();
        $company = [];
        $this->data['counts'] = 0;
        $this->data['saves'] = Save::where('homeowner_id', $id)->where('company_id', '!=', null)->orderBy('created_at','desc')->get();

        foreach ($this->data['saves'] as $key => $save) {
            $this->data['company'][$key] = User::where('id', $save->company_id)->first();
        }
        $data['proposal_count'] = Job::where('user_id', $id)->withCount('getProposal')->get();
//        dd($data['proposal_count']);
        foreach ($data['proposal_count'] as $count) {
            $this->data['counts'] = $this->data['counts'] + $count->get_proposal_count;
        }
        $this->data['saves_count'] = Save::where('homeowner_id', $id)->where('company_id', '!=', null)->count();
        $this->data['count'] = Job::where('user_id', $id)->count();
        $this->data['image'] = User::where('id', $id)->first();
//        dd($this->data);

        return view('home.my_saves', $this->data, $company);
    }

    public function unSaves($company_id, $redirect = '') {

        $id = Auth::id();
        Save::where('company_id', $company_id)->where('homeowner_id', $id)->where('job_id', null)->delete();
        if ($redirect) {
            return redirect('company_profile_home/' . $company_id);
        }

        return redirect('homeowner_saves');
    }

    public function editJob($job_id = '') {



        $id = Auth::id();
        $data['job_status'] = Job::where('id', $job_id)->where('user_id', $id)->with(['getProposal' => function($q) {
                        $q->where('status', 'accept')->take(1);
                    }])->first();
//         dd($data['job_status']->getProposal['0']->status);                   
        if (isset($data['job_status']->getProposal['0']) && $data['job_status']->getProposal['0']->status == 'accept') {
            return redirect()->back()->with('success', 'This job is in the process you can not edit it.');
        }
//        dd($data['job_status']);
        $data['result'] = Job::where('id', $job_id)->where('user_id', $id)->with('getFiles', 'getJobUser')->with('getSpeciality')->first();
//        dd($data['result']);
        $data['User'] = User::where('id', $id)->first();
        $data['specialities'] = JobSpeciality::get();
//       dd($data['result']);
        return view('home.post_job_form', $data);
    }

    public function uploadImage(Request $request) {
//        return response()->json(array('success' => 1, 'message' => 'File not save. Invalid Format'));;
        $image_uploaded = false;
//        dd($request->all());
        if ($request->hasFile('file')) {
            $name = $request->file->getClientOriginalName();
//            dd($name);
//            dd($request->file->getClientMimeType());
            if ($request->file->getClientMimeType() == 'image/jpeg' || $request->file->getClientMimeType() == 'image/png') {
                $type = 'image';
            } else if ($request->file->getClientMimeType() == 'application/pdf') {
//                dd('here');
                $type = 'pdf';
            } else if ($request->file->getClientMimeType() == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                $type = 'doc';
            } else if ($request->file->getClientMimeType() == 'application/x-zip-compressed') {
                $type = 'zip';
            } else if ($request->file->getClientMimeType() == 'application/octet-stream') {
//                dd('here');
                $type = 'doc';
            } else {
                return response()->json(array('success' => 0, 'message' => 'File not save. Invalid Format'));
            }

            $image_path = addProposalFile($request->file, 'public/images/job_files/');



            if ($image_path) {

                return response()->json(array('success' => 1, 'path' => $image_path, 'type' => $type, 'name' => $name));
            } else {
                $image_uploaded = true;
                return response()->json(array('success' => 0, 'message' => 'File not save. Invalid Formatss'));
            }
            return response()->json(array('success' => 0, 'message' => 'Invalid File'));
        }


//        Session()->flash('success','Email update successfully');
//        return view('profile.login&password_company',$data);
    }

    public function uploadReviewImage(Request $request) {
//        return response()->json(array('success' => 1, 'message' => 'File not save. Invalid Format'));;
        $image_uploaded = false;
        if ($request->hasFile('file')) {
            $name = $request->file->getClientOriginalName();

            $image_path = addFile($request->file, 'public/images/review_files/');



            if ($image_path) {
                return response()->json(array('success' => 1, 'path' => $image_path, 'name' => $name));
            } else {
                $image_uploaded = true;
                return response()->json(array('success' => 0, 'message' => 'File not save. Invalid Format'));
            }
            return response()->json(array('success' => 0, 'message' => 'Invalid File'));
        }


//        Session()->flash('success','Email update successfully');
//        return view('profile.login&password_company',$data);
    }

    public function deleteImage(Request $request) {

        $id = Auth::id();
        File::where('id', $request->id)->delete();
        return response()->json(array('success' => 1, 'message' => 'File Deleted Successfullly'));
    }

    public function deleteSpeciality(Request $request) {


        Specialities:: where('id', $request->id)->delete();
        return response()->json(array('success' => 1, 'message' => 'Speciality Deleted'));
    }

    public function addSpeciality(Request $request) {


        $speciality = new Specialities;
        $speciality->job_id = $request->id;
        $speciality->name = $request->speciality;




        $speciality->save();

        return response()->json(array('success' => 1, 'message' => 'Speciality Added', 'id' => $speciality->id));
    }

    public function postJob(Request $request) {
//        dd($request->all());
        $id = Auth::id();
        if ($request->is_draft) {
            if ($request->job_id) {
                $job = Job::where('id', $request->job_id)->first();
                $job->is_draft = $request->is_draft;
                $job->title = $request->job_title;
                $job->description = $request->job_description;
                if ($request->project == 'One Time Project') {
                    $job->type = 'one_time_project';
                } else {
                    $job->type = 'ongoing_project';
                }
                if ($request->end_date) {
                    $job->finish = $request->end_date;
                }
                $job->category = $request->category;
                $job->date = $request->date;
                $job->time = $request->time;
                $job->location = $request->location;
                $job->start = $request->start_date;
                $job->budget_start = $request->budget_start;
                $job->budget_end = $request->budget_end;
                $job->longitude = $request->long;
                $job->latitude = $request->lat;
                if ($request->extrnal_link) {
                    $job->extrnal_link = $request->extrnal_link;
                }
                $job->save();
                $files = explode(",", $request->job_images[0]);
                $type = explode(",", $request->job_images_type[0]);
                $name = explode(",", $request->job_images_name[0]);
                $special = explode(",", $request->job_specialities_name[0]);
                $special_id = explode(",", $request->job_specialities_id[0]);

                if ($request->job_specialities_name[0]) {
                    foreach ($special as $index => $specials) {
                        if ($specials != '') {
                            $sp = new Specialities;
                            if ($sp != null) {
                                $sp->name = $specials;
                                $sp->job_id = $request->job_id;
                            }
                            if ($special_id[$index] != null) {
                                $sp->speciality_id = $special_id[$index];
                            }

                            $sp->save();
                        }
                    }
                }
                if ($request->job_images[0]) {
                    foreach ($files as $index => $file) {
                        if ($file != '') {
                            $images = new File;
                            if ($file != null) {
                                $images->path = $file;
                                $images->job_id = $request->job_id;
                            }
                            if ($type[$index] != null) {
                                $images->type = $type[$index];
                            }
                            if ($name[$index] != null) {
                                $images->original_name = $name[$index];
                            }
                            $images->save();
                        }
                    }
                }
            } else {
                $job = new Job;
                $job->is_draft = $request->is_draft;
                $job->title = $request->job_title;
                $job->user_id = $id;
                $job->description = $request->job_description;
                if ($request->extrnal_link) {
                    $job->extrnal_link = $request->extrnal_link;
                }
                if ($request->project == 'One Time Project') {
                    $job->type = 'one_time_project';
                } else {
                    $job->type = 'ongoing_project';
                }
                if ($request->end_date) {
                    $job->finish = $request->end_date;
                }
                $job->category = $request->category;
                $job->date = $request->date;
                $job->time = $request->time;
                $job->location = $request->location;
                $job->start = $request->start_date;
                $job->budget_start = $request->budget_start;
                $job->longitude = $request->long;
                $job->latitude = $request->lat;
                $job->budget_end = $request->budget_end;
                $job->save();
                $files = explode(",", $request->job_images[0]);
                $type = explode(",", $request->job_images_type[0]);
                $name = explode(",", $request->job_images_name[0]);
                $special = explode(",", $request->job_specialities_name[0]);
                $special_id = explode(",", $request->job_specialities_id[0]);

                if ($request->job_specialities_name[0]) {
                    foreach ($special as $index => $specials) {
                        if ($specials != '') {
                            $sp = new Specialities;
                            if ($sp != null) {
                                $sp->name = $specials;
                                $sp->job_id = $job->id;
                            }
                            if ($special_id[$index] != null) {
                                $sp->speciality_id = $special_id[$index];
                            }

                            $sp->save();
                        }
                    }
                }
                if ($request->job_images[0]) {
                    foreach ($files as $index => $file) {
                        if ($file != '') {
                            $images = new File;
                            if ($file != null) {
                                $images->path = $file;
                                $images->job_id = $job->id;
                            }
                            if ($type[$index] != null) {
                                $images->type = $type[$index];
                            }
                            if ($name[$index] != null) {
                                $images->original_name = $name[$index];
                            }
                            $images->save();
                        }
                    }
                }
            }
        } elseif ($request->job_id) {
            $job = Job::where('id', $request->job_id)->first();
            $job->title = $request->job_title;
            $job->is_draft = 0;
            $job->description = $request->job_description;
            if ($request->project == 'One Time Project') {
                $job->type = 'one_time_project';
            } else {
                $job->type = 'ongoing_project';
            }
            if ($request->end_date) {
                $job->finish = $request->end_date;
            }
            $job->category = $request->category;
            $job->date = $request->date;
            $job->time = $request->time;
            $job->location = $request->location;
            $job->start = $request->start_date;
            $job->budget_start = $request->budget_start;
            $job->budget_end = $request->budget_end;
            $job->longitude = $request->long;
            $job->latitude = $request->lat;
            if ($request->extrnal_link) {
                $job->extrnal_link = $request->extrnal_link;
            }
            $job->save();
            $files = explode(",", $request->job_images[0]);
            $type = explode(",", $request->job_images_type[0]);
            $name = explode(",", $request->job_images_name[0]);
            $special = explode(",", $request->job_specialities_name[0]);
            $special_id = explode(",", $request->job_specialities_id[0]);

            if ($request->job_specialities_name[0]) {
                foreach ($special as $index => $specials) {
                    if ($specials != '') {
                        $sp = new Specialities;
                        if ($sp != null) {
                            $sp->name = $specials;
                            $sp->job_id = $request->job_id;
                        }
                        if ($special_id[$index] != null) {
                            $sp->speciality_id = $special_id[$index];
                        }

                        $sp->save();
                    }
                }
            }
            if ($request->job_images[0]) {
                foreach ($files as $index => $file) {
                    if ($file != '') {
                        $images = new File;
                        if ($file != null) {
                            $images->path = $file;
                            $images->job_id = $request->job_id;
                        }
                        if ($type[$index] != null) {
                            $images->type = $type[$index];
                        }
                        if ($name[$index] != null) {
                            $images->original_name = $name[$index];
                        }
                        $images->save();
                    }
                }
            }
        } else {
            $job = new Job;
            $job->title = $request->job_title;
            $job->user_id = $id;
            $job->description = $request->job_description;
            if ($request->project == 'One Time Project') {
                $job->type = 'one_time_project';
            } else {
                $job->type = 'ongoing_project';
            }
            if ($request->end_date) {
                $job->finish = $request->end_date;
            }
            $job->category = $request->category;
            $job->date = $request->date;
            $job->time = $request->time;
            $job->location = $request->location;
            $job->start = $request->start_date;
            $job->budget_start = $request->budget_start;
            $job->budget_end = $request->budget_end;
            $job->longitude = $request->long;
            $job->latitude = $request->lat;
            if ($request->extrnal_link) {
                $job->extrnal_link = $request->extrnal_link;
            }
            $job->save();
            $files = explode(",", $request->job_images[0]);
            $type = explode(",", $request->job_images_type[0]);
            $name = explode(",", $request->job_images_name[0]);
            $special = explode(",", $request->job_specialities_name[0]);
            $special_id = explode(",", $request->job_specialities_id[0]);
            if ($request->job_specialities_name[0]) {
                foreach ($special as $index => $specials) {
                    if ($specials != '') {
                        $sp = new Specialities;
                        if ($sp != null) {
                            $sp->name = $specials;
                            $sp->job_id = $job->id;
                        }
                        if ($special_id[$index] != null) {
                            $sp->speciality_id = $special_id[$index];
                        }

                        $sp->save();
                    }
                }
            }
            if ($request->job_images[0]) {
                foreach ($files as $index => $file) {
                    if ($file != '') {
                        $images = new File;
                        if ($file != null) {
                            $images->path = $file;
                            $images->job_id = $job->id;
                        }
                        if ($type[$index] != null) {
                            $images->type = $type[$index];
                        }
                        if ($name[$index] != null) {
                            $images->original_name = $name[$index];
                        }
                        $images->save();
                    }
                }
            }
        }
        if($request->is_draft)
        {
             return redirect('user-dashboard')->with('success','Draft saved successfully!');
        }else
        {
            return redirect('user-dashboard')->with('success','Job saved successfully!');
        }
       
    }

    public function proposals() {
        
        Collection::macro('toUpper', function () {
        return $this->map(function ($value) {
        return Str::upper($value);
    });
});

$collection = collect(['first', 'second']);
//dd($collection->toUpper());
        $id = Auth::id();


        $data['counts'] = 0;
        $data['saves_count'] = Save::where('homeowner_id', $id)->where('company_id', '!=', null)->count();
        $data['proposal_count'] = Job::where('user_id', $id)->withCount('getProposal')->get();
//        dd($data['proposal_count']);
        foreach ($data['proposal_count'] as $count) {
            $data['counts'] = $data['counts'] + $count->get_proposal_count;
        }
//        dd( $data['counts']);
        $data['count'] = Job::where('user_id', $id)->count();
        $data['image'] = User::where('id', $id)->first();
//        $this->data['rating']=User::where('id',$id)->with('ratingAvg')->first();
        $data['jobs'] = Job::where('user_id', $id)->select('id')->get()->toArray();
        foreach ($data['jobs'] as $jobs){
            $data['Proposals'][]=Proposal::where('job_id',$jobs)->with('getUser.ratingAvg','getFiles')
                            ->orderBy('match_specialties','desc')
                            ->get();
        }
        
        
        
//    dd($data['Proposals']);
//                         echo '<pre>';
//          print_r(  $data['propsals']);
//          exit;
//        dd($this->data);
        return view('home.my_proposals', $data);
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

    function downloadFileUpload() {
        $path = $_GET['path'];
        $image = $_GET['image'];
        $new_path = str_replace("public", "", $path);
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . $new_path;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $image, $headers);
    }

    function proposalCheck($proposal_id, $status, $redirect = '') {
//          dd($status);
        if (Auth::check()) {


            $id = Auth::id();
            $proposal = Proposal::where('id', $proposal_id)->with('getUser')->first();
            $user = Job::where('id', $proposal->job_id)->with('getUser')->first();
            $proposal->status = $status;

            if ($status == 'accept') {
                $notification = new Notification;
                $notification->from_user = $id;
                $notification->to_user = $proposal->company_id;
                $notification->type = 'proposal';
                $notification->is_read = 1;
                $notification->description = 'Proposal Accepted';
                $notification->title = 'Proposal Accepted';
                $notification->save();
            } else if ($status == 'reject') {
                $notification = new Notification;
                $notification->from_user = $id;
                $notification->to_user = $proposal->company_id;
                $notification->type = 'proposal';
                $notification->is_read = 1;
                $notification->description = 'Proposal Rejected';
                $notification->title = 'Proposal Rejected';
                $notification->save();
            }
            $proposal->save();
//            dd('here');
//                dd($user);
            $viewData['homeowner_first_name'] = $user->getUser->first_name;
            $viewData['homeowner_last_name'] = $user->getUser->last_name;
            $viewData['image'] = $user->getUser->profile_image;
            $viewData['compnay_first_name'] = $proposal->getUser->first_name;
            $viewData['company_last_name'] = $proposal->getUser->last_name;
            $viewData['status'] = $status;
            $viewData['link'] = url('/view_public_job/' . $proposal->job_id);
            Mail::send('email_template.proposal_accept', $viewData, function ($m) use ($proposal) {
                $m->from(env('FROM_EMAIL'), 'ConstructBid App');
                $m->to($proposal->getUser->email, $proposal->getUser->username)->subject('Proposal Status');
            });

            if ($redirect) {
                if ($status == 'accept') {
                    return redirect('home_notification')->with('success', 'Proposal has been accepted !');
                } else if ($status == 'reject') {
                    return redirect('home_notification')->with('success', 'Proposal has been rejected !');
                }
            } else {
                return redirect('homeowner_proposals');
            }
        } else {
            return redirect('/')->with('open_login', '');
        }
    }

//    ->with('getProposals.getJob')'=>function($q){$q->where('status','accept');}]

    public function companySearch() {
        
        $id= Auth::user()->id;
        
        $data['comapanies'] = User::where('type', 'company')->with('getCompanyDetail', 'ratingAvg', 'getProposals.getJob')
                ->with(['getSaves'=>function($q) use($id)
                {
                    $q->where('homeowner_id',$id);
                }])->withCount('getRatings')->get();
                
        $data['comapanies_count'] = User::where('type', 'company')->with('getCompanyDetail', 'ratingAvg', 'getSaves', 'getProposals.getJob')
                        ->withCount('getRatings')->count();
        $data['specialities'] = JobSpeciality::all();
//        dd($data['comapanies']);
        return view('home.company_search', $data);
    }

    public function postCompanySearch(Request $request) {
//         dd($request->all());
        $id = Auth::id(); 
        $lat = $request->lat;
        $lng = $request->lng;
//       dd($lat);
        $name = $request->comapany_name;
//        dd($request->comapany_name);
        $speciality = $request->specialities;
        $speciality_string = '';
        if ($request->specialities) {
            $speciality_string = join(', ', $speciality);
        }

        $emp = $request->val_emp;

        $string = '';
        if ($emp) {
            $string = join(', ', $emp);
        }
        $company_type = $request->company_type;
        $loc = $request->location;
        $rating = $request->rating;

        $verfify = $request->verify;
        $amount_start = $request->amount_start;
        $amount_end = $request->amount_end;

        $radius = 7000;

        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lng)) + sin(radians($lat)) * sin(radians(latitude))))";

        $res['comapanies'] = User::where('type', 'company')->with('getCompanyDetail', 'getCompanyConatcted', 'ratingAvg', 'getSaves')
                ->with(['getSaves'=>function($q) use($id)
                {
                    $q->where('homeowner_id',$id);
                }])->when($company_type, function($q) use($company_type){
                        $q->whereHas('getCompanyDetail', function($qu) use($company_type){
                            $qu->where('profile_type',$company_type);
                    });
                })->with(['getProposals' => function($q) {
                                $q->where('status', 'accept')->orderBy('created_at', 'Desc')->take(1);
                                $q->with('getJob');
                            }])
                        ->when($name, function($q) use($name) {
                            $q->where('first_name', 'like', "%$name%");
                        })->when($lat, function($query) use($haversine, $radius) {
                    $query->selectRaw("* ,{$haversine} AS distance")
                            ->whereRaw("{$haversine} < ?", [$radius])
                            ->orderByRaw("distance");
                })->when($rating, function($query) use($rating) {
                    $query->whereHas('getRatings', function($q) use($rating) {
                        $q->havingRaw('AVG(rating) >= ?', array($rating));
                    });
                })->when($verfify, function($q) use($verfify) {
                    $q->where('is_verified', '1');
                })->when($amount_start, function($q) use($amount_start, $amount_end) {
                    $q->whereHas('getProposals', function($qu) use($amount_start, $amount_end) {
                        $qu->where('status', 'accept');
                        $qu->whereHas('getJob', function($qurey) use($amount_start, $amount_end) {
                            $qurey->where('budget_start', $amount_start);
                            $qurey->where('budget_end', $amount_end);
                        })->take(1);
                    });
                })->when($emp, function($q) use($emp, $string) {
                    if (strpos($string, 'general_contractors') !== false) {
                        
                        $q->whereHas('getGeneralContractor');
                    } else if (strpos($string, 'sub_contractors') !== false) {
                        
                        $q->whereHas('getSubContractor');
                    } else if (strpos($string, 'supplier') !== false) {
                        $q->whereHas('getSupplier');
                    } else if (strpos($string, 'professional') !== false) {
                        $q->whereHas('getProfessional');
                    } else if (strpos($string, 'owner') !== false) {
                        $q->whereHas('getOwner');
                    }
                })->when($speciality, function ($q) use($request) {
                    foreach ($request->specialities as $spec){
                   $q->whereHas('getSpecialities', function($qu) use($spec){
                            $qu->where('name', 'like',"%$spec%");
                        });
                    }
//                    if (strpos($speciality_string, 'Lightning') !== false) {
//
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Lightning');
//                        });
//                    } else if (strpos($speciality_string, 'Sewerage') !== false) {
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Sewerage');
//                        });
//                    } else if (strpos($speciality_string, 'Mechnical') !== false) {
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Mechnical');
//                        });
//                    } else if (strpos($speciality_string, 'Plumbing') !== false) {
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Plumbing');
//                        });
//                    } else if (strpos($speciality_string, 'Roofing') !== false) {
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Roofing');
//                        });
//                    } else if (strpos($speciality_string, 'Site') !== false) {
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Site');
//                        });
//                    } else if (strpos($speciality_string, 'Underground') !== false) {
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Underground');
//                        });
//                    } else if (strpos($speciality_string, 'Building') !== false) {
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Building');
//                        });
//                    } else if (strpos($speciality_string, 'Electrical') !== false) {
//                        $q->whereHas('getSpecialities', function($qu) {
//                            $qu->where('name', 'Electrical');
//                        });
//                    }
                })->withCount('getRatings')->get();

//        dd($res['comapanies']);     
//        ->when($speciality , function ($q) use($emp , $speciality_string , $string) {
//                            if(strpos($string, 'general_contractors') !== false) {
//                                 if(strpos($speciality_string, 'Lightning') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Lightning');
//                                            });
//                                     });
//                            }
//                              else if(strpos($speciality_string, 'Sewerage') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Sewerage');
//                                            });
//                                     });
//                            }
//                              else if(strpos($speciality_string, 'Mechnical') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Mechnical');
//                                            });
//                                     });
//                            }
//                              else if(strpos($speciality_string, 'Plumbing') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Plumbing');
//                                            });
//                                     });
//                            }
//                              else if(strpos($speciality_string, 'Roofing') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Roofing');
//                                            });
//                                     });
//                            }
//                              else if(strpos($speciality_string, 'Site') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Site');
//                                            });
//                                     });
//                            }
//                              else if(strpos($speciality_string, 'Underground') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Underground');
//                                            });
//                                     });
//                            }
//                              else if(strpos($speciality_string, 'Building') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Building');
//                                            });
//                                     });
//                            }
//                              else if(strpos($speciality_string, 'Electrical') !== false) {
//                                     $q->whereHas('getGeneralContractor', function($qu) {
//                                         $qu->whereHas('getSpecialities' ,function($name){
//                                                $name->where('name','Electrical');
//                                            });
//                                     });
//                            }
//                             } 
//        $res['current_date_time'] = 'hellooo';
//        return view('home.search_result_homeowner',$res);
        $response = new \stdClass();
        $response->view = view('home.search_result_homeowner', $res)->render();
        $response->total_count = count($res['comapanies']);
        echo json_encode($response);
    }

    public function storeSearchLocation(Request $request) {
//        dd($request->all());
        $lat = $request->lat;
        $lng = $request->lng;
        $company_id = $request->company_id;
        $radius = 700;
        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(lat)) * cos(radians(lng) - radians($lng)) + sin(radians($lat)) * sin(radians(lat))))";

        $res['products'] = \App\Product::where('company_id', $company_id)->with('getFile')
                        ->when($lat, function($query) use($haversine, $radius) {
                            $query->selectRaw("* ,{$haversine} AS distance")
                            ->whereRaw("{$haversine} < ?", [$radius])
                            ->orderByRaw("distance");
                        })->get();
//            dd($res['products']);            
        $response = new \stdClass();
        $response->view = view('home.search_location_result', $res)->render();
//        dd($response);
//        $response->total_count = count($res['comapanies']);
        echo json_encode($response);
    }

    public function postContactCompany(Request $request) {

//        dd($request->all());
        $home_owner_id = Auth::id();
        $company_id = $request->company_id;
        $contact = new Contact;
        $contact->homeowner_id = $home_owner_id;
        $contact->company_id = $company_id;
        $contact->save();
        $company = User::where('id', $company_id)->where('type', 'company')->first();
        $viewData['homeowner_first_name'] = $request->first_name;
        $viewData['homeowner_last_name'] = $request->last_name;
        $viewData['homeowner_email'] = $request->email;
        $viewData['description'] = $request->details;
        $viewData['compnay_first_name'] = $company->first_name;
        $viewData['company_last_name'] = $company->last_name;
//      $viewData['link'] = url('/view_public_job/' . $proposal->job_id);
        Mail::send('email_template.contact_company', $viewData, function ($m) use ($company) {
            $m->from(env('FROM_EMAIL'), 'ConstructBid App');
            $m->to($company->email, $company->username)->subject('Homeowner wants to contact');
        });
        return response()->json(array('success' => 1, 'message' => 'Your message has been sent to the ' . $company->first_name . ' ' . $company->last_name . ' via email!'));
    }

    function companyProfile($id) {
//             dd($id);
        $home_owner_id = Auth::id();
        $data['tab'] = 'default';
        $data['company'] = User::where('id', $id)
                ->with(['getSubContractor' => function($q) {
                        $q->with('getServices.getFile')
                        ->withCount('getServices')
                        ->with('getSpecialities');
                    }])->with(['getGeneralContractor' => function($q) {
                        $q->with('getServices.getFile')
                        ->withCount('getServices')
                        ->with('getSpecialities');
                    }])->with(['getOwner' => function($q) {
                        $q->with('getServices.getFile')
                        ->withCount('getServices')
                        ->with('getSpecialities');
                    }])->with(['getProfessional' => function($q) {
                        $q->with('getServices.getFile')
                        ->withCount('getServices')
                        ->with('getSpecialities');
                    }])->with(['getSupplier' => function($q) {
                        $q->with('getServices.getFile')
                        ->withCount('getServices')
                        ->with('getSpecialities');
                    }])->with(['getProjects' => function($q) {
                        $q->with('getFile')
                        ->where('is_hide', 0)
                        ->withCount('getFile');
                    }])->with(['getProducts' => function($q) {
                        $q->with('getFile')
                        ->where('is_hide', 0)
                        ->withCount('getFile');
                    }])
                ->with(['getRatings' => function($q) {
                        $q->orderBy('created_at', 'desc');
                    }])
                ->withCount('starrating')
                ->with('ratingAvg', 'getCompanyDetail')
                ->withCount('getRatings')->withCount(['getProjects' => function($q) {
                        $q->where('is_hide', '0');
                    }])
                ->first();
        $data['review'] = Review::where('company_id', $id)->with('getfile', 'getHomeowner')->orderby('created_at', 'desc')->get();
        $data['save'] = Save::where('company_id', $id)->where('homeowner_id', $home_owner_id)->first();
        $data['contact'] = Contact::where('company_id', $id)->where('homeowner_id', $home_owner_id)->first();
        $data['job'] = User::where('id', $home_owner_id)->with(['getJobs' => function($q) {
                        $q->whereHas('getProposal', function($q) {
                                    $q->where('status', 'accept');
                                });
                    }])->first();
//        dd($data['job']);

        return view('home.contruct', $data);
    }

    public function sortReviews(Request $request) {
//   dd($request->all());
        $home_owner_id = Auth::id();
        if ($request->sort === 'recent') {
            $data['company'] = User::where('id', $request->company_id)
                    ->with(['getSubContractor' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getGeneralContractor' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getOwner' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getProfessional' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getSupplier' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getProjects' => function($q) {
                            $q->with('getFile')
                            ->withCount('getFile');
                        }])
                    ->with(['getRatings' => function($q) {
                            $q->orderBy('created_at', 'desc');
                        }])
                    ->withCount('starrating')
                    ->with('getProducts.getFile', 'ratingAvg', 'getCompanyDetail')
                    ->withCount('getRatings')->withCount('getProjects')
                    ->first();
            $data['save'] = Save::where('company_id', $request->company_id)->where('homeowner_id', $home_owner_id)->first();
            $data['contact'] = Contact::where('company_id', $request->company_id)->where('homeowner_id', $home_owner_id)->first();
            $data['review'] = Review::where('company_id', $request->company_id)->with('getfile', 'getHomeowner')->orderby('created_at', 'desc')->get();
        } elseif ($request->sort === 'old') {
            $data['company'] = User::where('id', $request->company_id)
                    ->with(['getSubContractor' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getGeneralContractor' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getOwner' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getProfessional' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getSupplier' => function($q) {
                            $q->with('getServices.getFile')
                            ->withCount('getServices')
                            ->with('getSpecialities');
                        }])->with(['getProjects' => function($q) {
                            $q->with('getFile')
                            ->withCount('getFile');
                        }])
                    ->with(['getRatings' => function($q) {
                            $q->orderBy('created_at', 'desc');
                        }])
                    ->withCount('starrating')
                    ->with('getProducts.getFile', 'ratingAvg', 'getCompanyDetail')
                    ->withCount('getRatings')->withCount('getProjects')
                    ->first();
            $data['save'] = Save::where('company_id', $request->company_id)->where('homeowner_id', $home_owner_id)->first();
            $data['contact'] = Contact::where('company_id', $request->company_id)->where('homeowner_id', $home_owner_id)->first();
            $data['review'] = Review::where('company_id', $request->company_id)->with('getfile', 'getHomeowner')->orderby('created_at', 'asc')->get();
        }
        $data['tab'] = 'sort';
//        dd($data);
        return view('home.contruct', $data);
    }

    public function homeNotification() {
        $id = Auth::id();
//        $data['notifications'] = Notification::where('to_user', $id)->with('getSender.ratingAvg')->whereHas('getProposal.getFiles')->orWhereHas('getProposal.getFiles')->get();
        $data['notifications'] = Notification::where('to_user', $id)->orderBy('created_at', 'desc')->with('getSender.ratingAvg')->where(function($q) {
                    $q->whereHas('getProposal', function($w) {
                        $w->whereHas('getFiles');
                    });
                    $q->orWhereHas('getProposal', function($e) {
                        $e->orWhereHas('getFiles');
                    });
                })->orderBy('id', 'Desc')->get();

        foreach ($data['notifications'] as $notifications) {
            $notifications->is_read = 0;
            $notifications->save();
        }

//        dd($data['notifications']);
        return view('home.notifications', $data);
    }

    function myProfile($tab = '') {
        $user_id = Auth::user()->id;
//        dd($user_id);
        $data['result'] = User::where('id', $user_id)->first();
        $data['tab_id'] = $tab;
        $data['result']->tab = 'default';
        $date = explode('-', $data['result']->dob);

        if ($data['result']->dob) {
            $data['year'] = $date[0];
            $data['month'] = $date[1];
            $data['day'] = $date[2];
        }

        $data['result']->save();
//        dd($data['result']);

        $data['image'] = User::where('id', $user_id)->first();


        return view('profile.my_profile', $data);
    }

    function updateProfile(Request $request) {

//        dd($request->all());
        $date = $request->year . '-' . $request->month . '-' . $request->day;
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->dob = $date;
        $user->home_address = $request->home_address;
        $user->phone_code = $request->country_code;
        $user->country = $request->country;
        $user->language = $request->language;
        $user->currency = $request->currency;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->address_2 = $request->address_2;
        $user->latitude = $request->latitude;
        $user->latitude_two = $request->latitude_2;
        $user->longitude = $request->longitude;
        $user->longitude_two = $request->longitude_2;
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
        $user->save();
        
        return redirect('my_profile');
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
            return redirect('my_profile' . '/' . $tab_id)->with('success', 'Password updated Successfully');
        } else { 
//            $user = User::where('id', $user_id)->first();
            $tab_id = "loginpassword";
//            $user->save();
            return redirect('my_profile' . '/' . $tab_id)->with('error', 'First Verify old password');
        }
    }

    public function updateEmailNotificationSettings(Request $request) {

        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();


        if ($request->update_web_notification) {
            $user->update_web_notification = '0';
        } else {
            $user->update_web_notification = '1';
        }
        if ($request->job_activity) {

            $user->activity_on_job = '0';
        } else {
            $user->activity_on_job = '1';
        }


        $user->tab = "email&notification";

        $user->save();

        
        return redirect('my_profile/' . $user->tab)->with('success', 'Notification updated successfully!');
    }

    public function postQuoteCompany(Request $request) {

//     dd($request->all());
        $home_owner_id = Auth::id();
        $company_id = $request->company_id;
        $company = User::where('id', $company_id)->where('type', 'company')->first();
        if ($company->getCompanyDetail->service_qoute_notication == '0') {
            $notification = new Notification;
            $notification->from_user = $home_owner_id;
            $notification->to_user = $company_id;
            $notification->type = 'quote';
            $notification->is_read = 1;
            $notification->save();
        }
        $viewData['homeowner_first_name'] = $request->first_name;
        $viewData['service'] = Service::where('id', $request->service_id)->with('getFile')->first();

        $viewData['homeowner_last_name'] = $request->last_name;
        $viewData['homeowner_email'] = $request->email;
        $viewData['description'] = $request->description;
        $viewData['compnay_first_name'] = $company->first_name;
        $viewData['company_last_name'] = $company->last_name;
//      $viewData['link'] = url('/view_public_job/' . $proposal->job_id);
        if ($company->getCompanyDetail->service_qoute_notication == '0') {
            Mail::send('email_template.quote_template', $viewData, function ($m) use ($company) {
                $m->from(env('FROM_EMAIL'), 'ConstructBid App');
                $m->to($company->email, $company->username)->subject('Homeowner Quotes');
            });
        }
        return redirect('company_profile_home/' . $company_id)->with('success', 'Quote has been send !');
    }

    public function writeReview($id) {

        $data['user'] = User::where('id', $id)->first();

        return view('home.write_review', $data);
    }

    public function postReview(Request $request) {
//          dd($request->all());
        $homeowner_id = Auth::id();
        if ($request->rating == null) {
            return redirect()->back()->with('error', 'Please select Rating!');
        }
        $review_images_path = explode(",", $request->review_images[0]);
        $review_images_name = explode(",", $request->review_images_name[0]);
        $review = new Review;
        $review->homeowner_id = $homeowner_id;
        $review->company_id = $request->company_id;
        $review->feedback = $request->description;
        $review->rating = $request->rating;
        $review->save();
        if ($request->review_images[0]) {
            foreach ($review_images_path as $index => $reviews) {
                if ($reviews != '') {
                    $images = new File;
                    if ($review_images_path != null) {
                        $images->path = $reviews;
                        $images->review_id = $review->id;
                    }
                    if ($review_images_name[$index] != null) {
                        $images->original_name = $review_images_name[$index];
                    }
                    $images->type = 'image';
                    $images->save();
                }
            }
        }
        $company = User::where('id', $request->company_id)->first();
        if ($company->getCompanyDetail->service_qoute_notication == '0') {
            $notification = new Notification;
            $notification->from_user = $homeowner_id;
            $notification->to_user = $request->company_id;
            $notification->type = 'review';
            $notification->is_read = 1;
            $notification->save();
        }
        return redirect('company_profile_home/' . $request->company_id);
    }

    public function saveCompany($id) {
        $homeowner_id = Auth::id();
        $save = new Save;
        $save->company_id = $id;
        $save->homeowner_id = $homeowner_id;
        $save->save();
        
        
        return redirect('company_profile_home/' . $id);
    }

    public function deleteJob($id) {
        $job_draft = Job::where('id', $id)->where('is_draft', '1')->first();
        if ($job_draft) {
            $job_draft->delete();
            return redirect('user-dashboard')->with('success', 'Job deleted Successfully.');
        }
//        $job = Job::with('getJobProposal')->get();
//        whereDoesntHave
        $job = Job::whereHas('getJobProposal', function($q) {
                    $q->where('status', 'accept');
                })->where('id', $id)->whereDate('finish', '>=', Carbon::now()->toDateString())->first();
//        dd($job);
        $job_delete = Job::where('id', $id)->first();
        if ($job) {
            return redirect()->back()->with('success', 'Job is not finish yet.');
        }
//        dd($job_delete);
        $job_delete->delete();
        
        return redirect('user-dashboard')->with('success', 'Job deleted Successfully.');
    }

    public function projectDetail($id, $company_id) {
        
        $data['project_detial'] = Project::where('id', $id)->with('getFile', 'getComapny.ratingAvg')->first();
        $data['more_projects'] = Project::where('company_id', $company_id)->with('getFile')->get();
        $data['company'] = User::where('id', $company_id)->with('ratingAvg')->first();
//        dd($data['more_projects']);
        return view('home.project-detail', $data);
    }

}
