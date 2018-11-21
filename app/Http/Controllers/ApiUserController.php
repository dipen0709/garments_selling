<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\ApplicationUser;
use App\UserAnswer;
use App\Category;
use Illuminate\Support\Facades\URL;

class ApiUserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        $status = false;
        $message = "Invalid login details.";
        $data = array();

        if ($request->has('email') && $request->email != '' && $request->has('password') && $request->password != '') {
            $email = $request->email;
            $password = md5($request->password);
            $user_exist = ApplicationUser::processEmailCheck($email);
//            echo '<pre>';            print_r($user_exist); die;
            if (!empty($user_exist)) {
                $login_data = ApplicationUser::processUserLogin($email, $password);
                if (!empty($login_data)) {
                    $login_data = ApplicationUser::processDataFilter($login_data);
                    if ($login_data->user_status == 'active') {
                        if ($login_data->user_verified == 'yes') {
                            $status = true;
                            $message = "Logged in successfully.";
                            $data = $login_data;
                        } else {
                            $message = "Please verify your email.";
                        }
                    } else {
                        $message = "Your account is inactive.";
                    }
                } else {
                    $message = "Invalid login details.";
                }
            } else {
                $message = "Email/Username does not exist.";
            }
        } else {
            $message = "Parameter are missing or wrong. Parameters - (email,password).";
        }
        $response = array('status' => $status, 'message' => $message, 'data' => $data);
        return response()->json($response, 200);
    }

    public function registration(Request $request) {
        $status = false;
        $message = "Invalid registration details.";
        $data = array();

        if ($request->has('username') && $request->username != '' && $request->has('email') && $request->email != '' && $request->has('password') && $request->password != '') {

            $email = $request->email;
            $username = $request->username;
            $user_email_exist = ApplicationUser::processEmailCheck($email);
            if (empty($user_email_exist)) {
                $user_name_exist = ApplicationUser::processUsernameCheck($username);
                if (empty($user_name_exist)) {
                    $register_data = ApplicationUser::processRegistration($request);
                    if (!empty($register_data)) {
                        $login_data = ApplicationUser::processDataFilter($register_data);
                        $status = true;
                        $message = "Account created successfully. Please verify your account.";
                        $data = $login_data;
                    } else {
                        $message = "Error while registration, Please try again.";
                    }
                } else {
                    $message = "Username already exist.";
                }
            } else {
                $message = "Email already exist.";
            }
        } else {
            $message = "Parameter are missing or wrong. Parameters - (username,email,password).";
        }

        $response = array('status' => $status, 'message' => $message, 'data' => $data);
        return response()->json($response, 200);
    }

     public function validateUser(Request $request) {
        $return_data = array();
        $token = $request->token;
        if($token){
            $check_rp_token = ApplicationUser::checkUserToken($token);
            if(!empty($check_rp_token)){
                    $this->data['title'] = 'Reset Password';
                    $this->data['data'] = $check_rp_token;
                    $this->data['validate'] = 1;
                    return View('resetpassword', array_merge($this->data, $return_data))->render();
            } else {
                    $this->data['title'] = 'Something wrong in user validate';
                    $this->data['error_message'] = 'Your token is not valid.';
                    return View('resetpassword', array_merge($this->data, $return_data))->render();
            }
        }
        
    }
    
    public function forgotPassword(Request $request) {

        $status = false;
        $message = "Invalid API details.";
        $data = array();

        if ($request->has('email') && $request->email != '') {
            $email = $request->email;
            $email_data = ApplicationUser::processEmailCheck($email);
            if (!empty($email_data)) {
                if ($email_data->user_status == 'active') {
                    if ($email_data->user_verified == 'yes') {
                        $send_mail = ApplicationUser::sendForgotPasswordEmail($email_data);
                        if ($send_mail) {
                            $status = true;
                            $message = "Password reset link has been sent on your email. It will expired within one hour.";
                        } else {
                            $message = "Error while sending password reset link. Please try again.";
                        }
                    } else {
                        $message = "Please verify your email.";
                    }
                } else {
                    $message = "Your account is inactive.";
                }
            } else {
                $message = "Email does not exist.";
            }
        } else {
            $message = "Parameter are missing or wrong. Parameters - (email).";
        }
        $response = array('status' => $status, 'message' => $message, 'data' => $data);
        return response()->json($response, 200);
    }
    
   
    public function resetPassword(Request $request) {
        $return_data = array();
        $rp_token = $request->token;
        if($rp_token){
            $current_time = date('Y-m-d H:i:s');
            $check_rp_token = ApplicationUser::checkRPToken($rp_token,$current_time);
            if(!empty($check_rp_token)){
                if($check_rp_token->time_diff < 60){
                    $this->data['title'] = 'Reset Password';
                    $this->data['data'] = $check_rp_token;
                    $this->data['resetpassword'] = 1;
                    return View('resetpassword', array_merge($this->data, $return_data))->render();
                } else {
                    $this->data['title'] = 'Reset Password';
                    $this->data['error_message'] = 'Your token has expired.';
                    return View('resetpassword', array_merge($this->data, $return_data))->render();
                }
                
            } else {
                $this->data['title'] = 'Reset Password';
                $this->data['error_message'] = 'Your token is not valid.';
                return View('resetpassword', array_merge($this->data, $return_data))->render();
            }
        }
        
    }
    
    public function updatePassword(Request $request){
        $return_data = array();
        $rp_token = $request->token;
        $password = $request->password;
        if($rp_token && $password != ''){
            $current_time = date('Y-m-d H:i:s');
            $check_rp_token = ApplicationUser::checkRPToken($rp_token,$current_time);
            if(!empty($check_rp_token)){
                if($check_rp_token->time_diff < 60){
                    $update_password = ApplicationUser::find($check_rp_token->id);
                    $update_password->user_password = md5($request->password);
                    $update_password->user_rp_token = '';
                    $update_password->user_rp_token_created_date = null;
                    $update_password->save();
                    $this->data['title'] = 'Reset Password';
                    $this->data['data'] = $check_rp_token;
                    $this->data['message'] = 'Password has been updated.';
                    return View('resetpassword', array_merge($this->data, $return_data))->render();
                } else {
                    $this->data['title'] = 'Reset Password';
                    $this->data['error_message'] = 'Your token has expired.';
                    return View('resetpassword', array_merge($this->data, $return_data))->render();
                }
                
            } else {
                $this->data['title'] = 'Reset Password';
                $this->data['error_message'] = 'Your token is not valid.';
                return View('resetpassword', array_merge($this->data, $return_data))->render();
            }
        } else {
            $this->data['title'] = 'Reset Password';
            $this->data['error_message'] = 'Your token is not valid.';
            return View('resetpassword', array_merge($this->data, $return_data))->render();
        }
    }

    public function updateProfile(Request $request) {
        $status = false;
        $message = "Invalid login details.";
        $data = array();

        if ($request->has('user_encrypt_id') && $request->user_encrypt_id != '' && $request->email != '' && $request->dob != '' && $request->firstname != '' && $request->lastname != '') {
            $email = $request->email;
            $for_profile = 1;
            $user_encrypt_id = $request->user_encrypt_id;
            $email_data = ApplicationUser::processEmailCheck($email,$user_encrypt_id,$for_profile);
            $username_data = ApplicationUser::processUsernameCheck($email,$user_encrypt_id,$for_profile);
            if(!empty($email_data)){
                $message = "Email already exist.";
            } else if(!empty($username_data)){
                $message = "Username already exist.";
            } else {
                $login_data = ApplicationUser::updateProfileDatail($request);
                if ($login_data) {
                    $percentage = ApplicationUser::getProfilePercentage($user_encrypt_id); 
                    $login_data = ApplicationUser::processDataFilter($login_data,$percentage);
                    $status = true;
                    $message = "Logged in successfully.";
                    $data = $login_data;
                } else {
                    $message = "Profile not updated.";
                }
            }
        } else {
            $message = "Parameter are missing or wrong. Parameters - (user_encrypt_id,email,firstname,lastname,dob).";
        }

        $response = array('status' => $status, 'message' => $message, 'data' => $data);
        return response()->json($response, 200);
    }

    public function socialLogin(Request $request) {
        $status = false;
        $message = "Invalid login details.";
        $data = array();

        if ($request->has('social_type') && in_array($request->social_type, array(1,2,3)) && $request->has('social_string') && $request->social_string != '') {
            $login_data = ApplicationUser::processSocialLoginCheck($request);
            if (!empty($login_data)) {
                if ($login_data->user_status == 'active') {
                    if ($login_data->user_verified == 'yes') {
                        $login_data = ApplicationUser::processDataFilter($login_data);
                        $status = true;
                        $message = "Logged in successfully.";
                        $data = $login_data;
                    } else {
                        $message = "Please verify your email.";
                    }
                } else {
                    $message = "Your account is inactive.";
                }
            } else {
                if($request->email != ''){
                    $email = $request->email;
                    $email_data = ApplicationUser::processEmailCheck($email);
                }
                
                if(!empty($email_data)){
                    $message = "Email already exist.";
                } else {
                    $id = md5(uniqid());
                    $Application_user = new ApplicationUser();
                    $Application_user->user_encrypt_id = $id;
                    $Application_user->user_verified = 'yes';
                    $Application_user->user_social_type = $request->social_type;
                    $Application_user->user_social_string = $request->social_string;
                    $Application_user->username = $id;
                    $Application_user->user_password = md5($id);
                    if($request->email != ''){
                        $Application_user->user_email = $request->email;
                    } else {
                        $Application_user->user_email = $id . '@gmail.com';
                    }
                    if($request->firstname != ''){
                        $Application_user->user_firstname = $request->firstname;
                    } 
                    if($request->lastname != ''){
                        $Application_user->user_lastname = $request->lastname;
                    } 
                    if($request->dob != ''){
                        $Application_user->user_dob = ApplicationUser::dateConverToYMD($request->dob);
                    } 
                    
                    $Application_user->save();
                    $login_data = ApplicationUser::select('*', DB::raw('DATE_FORMAT(user_dob, "%m-%d-%Y") as user_dob'))->where('id', '=', $Application_user->id)->first();

                    if (!empty($login_data)) {
                        $login_data = $login_data->toArray();
                        $login_data = (object) $login_data;
                        $login_data = ApplicationUser::processDataFilter($login_data);
                        $status = true;
                        $message = "Logged in successfully.";
                        $data = $login_data;
                    } else {
                        $message = "Invalid new registration.";
                    }
               }
            }
        } else {
            $message = "Parameter are missing or wrong. Parameters - (social_type,social_string).";
        }

        $response = array('status' => $status, 'message' => $message, 'data' => $data);
        return response()->json($response, 200);
    }
    
    public function categoryList(Request $request) {
        $status = true;
        $message = "Category List.";
        $data = array();
        if ($request->has('user_id') && $request->user_id != '') {
            $user_id = $request->user_id;
            $CategoryWiseNumberOfQuestion = ApplicationUser::getCategoryWiseNumberOfQuestion();
            $CategoryWiseNumberOfAnswer = ApplicationUser::getCategoryWiseNumberOfAnswer($user_id);

            $category_list = Category::select('id as category_id','CategoryDetail as category_detail','Description as description','Image')->where('chr_delete','=',0)->get();
            foreach($category_list as $val){
                 $temp = array();
                 $temp['category_id'] = $val->category_id;
                 $temp['category_detail'] = $val->category_detail;
                 $temp['description'] = $val->description;
                 $image = $val->Image;
                 if($image){
                     $path = URL::to('/public/upload/');
                     $temp['image'] = $path . '/' . $image;
                 } else {
                     $temp['image'] = '';
                 }
                 $temp['status'] = 0;
                 if(isset($CategoryWiseNumberOfQuestion[$val->category_id]) && isset($CategoryWiseNumberOfAnswer[$val->category_id]) && $CategoryWiseNumberOfQuestion[$val->category_id] != '0' && $CategoryWiseNumberOfQuestion[$val->category_id] == $CategoryWiseNumberOfAnswer[$val->category_id]) {
                     $temp['status'] = 2;
                 } else if(isset($CategoryWiseNumberOfQuestion[$val->category_id]) && isset($CategoryWiseNumberOfAnswer[$val->category_id]) && $CategoryWiseNumberOfQuestion[$val->category_id] != '0' && $CategoryWiseNumberOfQuestion[$val->category_id] > $CategoryWiseNumberOfAnswer[$val->category_id]){
                     $temp['status'] = 1;
                 }
                 $data[] = $temp;
            }
        } else {
            $message = "Parameter are missing or wrong. Parameters - (user_id).";
        }
        $response = array('status' => $status, 'message' => $message, 'data' => $data);
        return response()->json($response, 200);
    }
    
    public function getQuetionary(Request $request) {
        $status = false;
        $message = "Invalid API call.";
        $data = array();
        $initial_id = 1;
        
        if ($request->has('user_id') && $request->user_id != '' && $request->has('category_id') && $request->category_id != '' && $request->has('question_id') && $request->has('event') && $request->has('answer') && $request->has('answer_description')) {
            $user_id = $request->user_id;
            $category_id = $request->category_id;
            $last_question_id = $request->question_id;
            $event = $request->event;
            $answer = $request->answer;
            $answer_description = $request->answer_description;

            if(!$last_question_id){
                $check_last_answer = ApplicationUser::getLastAnswer($user_id,$category_id);
                $new_question_id = $initial_id;
                if(!empty($check_last_answer)){
                    $new_question_id = $check_last_answer->QuestionID + $initial_id;
                }
            } else { 
                if($answer){
                    $current_question_data = ApplicationUser::getQuestionDetail($last_question_id,$category_id);
                    $already_answer_data = ApplicationUser::getAnswerDetail($last_question_id,$category_id,$user_id);
                    if(!empty($already_answer_data)){
                        $save_answer = UserAnswer::find($already_answer_data->id);
                    } else {
                        $save_answer = new UserAnswer();
                    }
                    $save_answer->UserID = $user_id;
                    $save_answer->QuestionID = $last_question_id;
                    $save_answer->CategoryID = $category_id;
                    $save_answer->question_number = $current_question_data->id;
                    $save_answer->answer = $answer;
                    if($answer_description && $answer == 'no' && !is_null($answer_description)){
                        $save_answer->answer_description = $answer_description;
                    } else {
                        $save_answer->answer_description = '';
                    }
                    $save_answer->save();
                }
                if($event && $event == 'prev'){
                    if($last_question_id <= $initial_id){
                        $new_question_id = $initial_id;
                    } else {
                       $new_question_id = $last_question_id - $initial_id;
                    }
                } else {
                    $new_question_id = $last_question_id + $initial_id;
                }
            } 
            $question_data = ApplicationUser::getQuestionDetail($new_question_id,$category_id);
            $answer_data   = ApplicationUser::getAnswerDetail($new_question_id,$category_id,$user_id);
            if(!empty($question_data)){
                $status = true;
                $message = "Category Question Answer.";
                $data['user_id'] = $user_id;
                $data['category_id'] = $category_id;
                $data['question_id'] = $question_data->QuestionID;
                $data['question_detail'] = $question_data->QuestionDetail;
                if(!is_null($question_data->Description)){
                $data['description'] = $question_data->Description;
                } else {
                $data['description'] = '';    
                }
                $data['total_question'] = ApplicationUser::getNumberOfQuestion($category_id);
                $data['need_description'] = $question_data->AnswerType;
                $data['answer'] = '';
                $data['answer_description'] = '';
                if(!empty($answer_data)){
                    $data['answer'] = $answer_data->answer;
                    if(!is_null($answer_data->answer_description)){
                        $data['answer_description'] = $answer_data->answer_description;
                    } else {
                        $data['answer_description'] = '';
                    }
                }
                $data['category_completed'] = "0";
            } else {
                $status = true;
                $message = "Categroy question completed.";
                $data['category_completed'] = "1";
            }
        
        } else {
            $message = "Parameter are missing or wrong. Parameters - (user_id,category_id,question_id,event,answer,answer_description).";
        }

        $response = array('status' => $status, 'message' => $message, 'data' => $data);
        return response()->json($response, 200);
    }

}
