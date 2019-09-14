<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\User;
use App\UserSession;
use App\CompanyDetail;
use App\JobSpeciality;

class AuthController extends Controller {

    public function loginView() {

        $data['title'] = 'Admin login';
        return view('admin_login', $data);
    }

    public function adminLogin(Request $request) {


        $credentials = $this->validate(request(), [
            'email' => 'required',
            'password' => 'required',
                ]
        );

        $username = $request->email;
        $password = $request->password;


        if (Auth()->guard('admin')->attempt(['email' => $username, 'password' => $password])) {
            return redirect('dashboard');
        } else {

            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function companyLogin(Request $request) {


        $credentials = $this->validate(request(), [
            'email' => 'required',
            'password' => 'required',
                ]
        );

        $username = $request->email;
        $password = $request->password;

        $user = User::where('email', $username)->first();
        if ($user) {
            if ($user->is_email_verified == '1') {
                if ($user->is_blocked == '0') {
                    if (Auth::attempt(['email' => $username, 'password' => $password, 'type' => 'company'])) {
//                        dd('hre');
                        $detail = CompanyDetail::where('user_id', $user->id)->first();
                        if ($detail) {
                            return response()->json(array('success' => 1, 'redirect' => 'main_page'));
                        } else {
                            return response()->json(array('success' => 1, 'redirect' => 'company_basic_info'));
                        }
                    } elseif (Auth::attempt(['email' => $username, 'password' => $password, 'type' => 'homeowner'])) {
                        return response()->json(array('success' => 1, 'redirect' => 'user-dashboard'));
                    } else {
                        return response()->json(array('success' => 0, 'message' => 'Invalid Email Password'));
                    }
                } else {
                    return response()->json(array('success' => 0, 'message' => 'Blocked by admin'));
                }
            } else {
                return response()->json(array('success' => 0, 'message' => 'Email not verified'));
            }
        } else {
            return response()->json(array('success' => 0, 'message' => 'Invalid Email Password'));
        }
    }

    public function testComapny() {
        $data = 'It Workssss';
        return $data;
    }

    public function logout() {
        Auth::guard('admin')->logout();

        return redirect('/admin_login');
    }

    public function companylogout() {
//           dd('here');
        Auth::logout();
        return redirect('/');
    }

    public function registerCompany(Request $request) {



        $validator = Validator::make($request->all(), [
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return response()->json(array('success' => 0, 'message' => $errors));
        }
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $activate_code = Str::random(15);
        $user->email_confirmaiton_token = $activate_code;
        $user->is_blocked = 0;
        $user->type = 'company';
        $user->tab = 'default';
        $user->save();

        $viewData['name'] = $user->first_name;
        $email_code = $user->email_confirmaiton_token;
        $viewData['link'] = url('verify_account/' . $email_code);
        Mail::send('email_template.email_verify', $viewData, function ($m) use ($user) {
            $m->from(env('FROM_EMAIL'), 'ConstructBid App');
            $m->to($user->email, $user->username)->subject('Confirmation Email');
        });
        return response()->json(array('success' => 1, 'message' => 'Your are registered.Please Verify Email'));
    }

    public function postHomeowner(Request $request) {



        $request->validate([
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = bcrypt($request->password);
        $activate_code = Str::random(15);
        $user->email_confirmaiton_token = $activate_code;
        $user->is_blocked = 0;
        $user->type = 'homeowner';
        $user->save();

        $viewData['name'] = $user->first_name;
        $email_code = $user->email_confirmaiton_token;
        $viewData['link'] = url('verify_account/' . $email_code);
        Mail::send('email_template.email_verify', $viewData, function ($m) use ($user) {
            $m->from(env('FROM_EMAIL'), 'ConstructBid App');
            $m->to($user->email, $user->username)->subject('Confirmation Email');
        });
        $request->session()->flash('success', 'Your are registered.Please verify email');
        return redirect('/post_job');
    }

    public function verifyAccount($code) {

        $user_record = User::where('email_confirmaiton_token', $code)->first();

        if ($user_record) {

            $data = array('is_email_verified' => 1, 'email_confirmaiton_token' => '');

            if (User::where('email_confirmaiton_token', $code)->update($data)) {

//                $data['message'] = 'Your Account verified successfully';
//                return view('frontend/success_template', $data);
                return redirect('/')->with('success_login', 'Email verified successfully.');
            }
            $data['message'] = 'Sorry there are some errors please try again later!';
            return view('frontend/error_template', $data);
        }
        $data['message'] = 'Sorry activation link is expired or token invalid';
        return view('frontend/error_template', $data);
    }

    public function sendForgotPassword(Request $request) {
//        dd($request->all());
        $this->validate($request, [
            'email' => 'required'
        ]);

        $forgot_email = $request->email;
        $email = User::where('email', $forgot_email)->first();
        if ($email) {

            $forgot_token = md5(time());

            User::where('email', $forgot_email)->update(['forget_password_token' => $forgot_token]);

            $link = url('reset_password') . '/' . $forgot_token;
            $full_name = $email->first_name . ' ' . $email->last_name;
            Mail::send('email_template.forgot_password', ['full_name' => $full_name, 'link' => $link], function ($m) use ($email) {
                $full_name = $email->first_name . ' ' . $email->last_name;
                $m->from(env('MAIL_USERNAME', ''), 'ConstructBid Forgot password');
                $to = $email;

                $m->to($email->email, $full_name)->subject('Password Reset link');
            });

            return response()->json(array('success' => 1, 'message' => 'Check your email to reset Password', 'redirect' => 'main_page'));
        } else {
            return response()->json(array('success' => 0, 'message' => 'Invalid Email Address'));
        }

        return response()->json(array('success' => 1, 'message' => 'Check your email to reset Password', 'redirect' => 'main_page'));
    }

    function resetPasswordView($token) {

        
        if (!isset($token) || $token == '') {
            $request->Session()->flash('error', 'Invalid link');
            return redirect(url('/'));
        }
        $data = array();
        $data['title'] = 'Reset Password';
        $data['token'] = $token;
        $data['reset_model_open'] = 'modal';
              $data['company'] = User::where('is_popular', 1)->get();

//        dd($this->data['company'] );
        $data['speciality'] = JobSpeciality::get();
        $data['categories'] = JobSpeciality::all();
        $data['company_recent'] = User::where('type', 'company')->whereHas('getProposals', function($q) {
                    $q->where('status', 'accept');
                })->with(['getProposals' => function($q) {
                        $q->where('status', 'accept')
                                ->whereHas('getJob')
                                ->with('getJob')
                                ->orderBy('created_at', 'desc');
                    }])->with('ratingAvg')->withCount('getRatings')->orderBy('created_at', 'desc')->take(5)->get();
        return view('index', $data);
    }

    function postResetPassword(Request $request) {
        $token = $request->token;
        $user_record = User::where('forget_password_token', $token)->first();
        if ($user_record) {
            $request->validate([
                'reset_password' => 'required|min:6'
            ]);
            $data = array('password' => bcrypt($request->reset_password), 'forget_password_token' => '');

            if (User::where('forget_password_token', $token)->update($data)) {


                return response()->json(array('success' => 1, 'message' => 'Password changed successfully'));
            } else {

                return response()->json(array('success' => 1, 'message' => 'Sorry!there is some errors please try later.'));
            }
            $data['message'] = 'You have changed your password successfully.';
            return response()->json(array('success' => 0, 'message' => 'You have changed your password successfully.'));
        } else {

            return response()->json(array('success' => 1, 'message' => 'Link expired.'));
        }
    }

    function authenticateEmailValidate(Request $request) {
        $check_user = User::where('email', $request['email'])->first();
        if ($check_user) {
            echo "false";
        } else {
            echo "true";
        }
    }

//    public function checkEmail(Request $request) {
////        dd($request->all());
//        $email = $request->email;
//
//        $check_email = User::where('email', $email)->first();
//        if ($check_email) {
//           return Response::json(array('success' => 0, 'message' => 'Email Already Taken'));
//        } 
//    }
}
