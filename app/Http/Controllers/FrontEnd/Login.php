<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\UserRestPassword;
use App\Models\Doctor;
use App\Models\Student;
use App\Models\Specialty;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Lesson;
use App\Models\Term;
use App\User;
use SweetAlert;
use Carbon\Carbon;
use Mail;
use DB;
use Auth;

class Login extends Controller
{



    public function login()
    {
       return view('Design.auth.login');
    }

    public function login_post(){

        $rememberme = request('rememberme') == 1 ? true : false;

         $section = request('section');
         $name = request('name');
         $password = request('password');
         $pass_check = bcrypt(request('password'));
         //====================================================================
         $doctor = Doctor::where('name', $name)->first();

         $admin = User::where('name', $name)->first();

         $student = Student::where('name', $name)->first();

        //=====================================================================
         if($section == "doctor")
         {

            if($doctor)
            {
                //dd('Doctor');
                if(Auth::guard('doctor')->attempt(['name' => $name, 'password' => $password],$rememberme)){

                    return redirect('doctors/dashboard');

                }else{
                     alert()->error("Your Data Is Not Right");
                    return back();
                }

            }else{
                 alert()->error("Your Data Is Not Right");
                return back();
            }
         }

        //=====================================================================
         //==== Auth Student
         if($section == "student")
         {

              if($student)
              {

                if(Auth::guard('student')->attempt(['name' => $name, 'password' => $password],$rememberme)){

                    return redirect('home');
                }else{
                     alert()->error("Your Data Is Not Right");
                    return back();
                }

             }else{
                  alert()->error("Your Data Is Not Right");
                 return back();
             }
         }


         if($section == "admin")
         {
             if($admin)
             {
                  //dd('Admin');
                if(auth()->guard('web')->attempt(['name' => $name , 'password' => $password], $rememberme)){

                    return redirect('admin/dashboard');

                }else{
                        alert()->error("Your Data Is Not Right");
                        return back();
                }

            }else{

                alert()->error("Your Data Is Not Right");
                return back();
            }

         }

    }


    public function logout_student()
    {
        auth()->guard('student')->logout();
        return redirect('login');
    }

    public function forget_password(){
        $sliders = slider::all();
        $links = Link::all();
        $icons = Icon::all();
        return view('design.forget_password', compact('links', 'icons', 'sliders'));
    }

    public function forget_password_post(){
        $user = User::where('email', request('email'))->first();
        if(!empty($user)){
            $token = app('auth.password.broker')->createToken($user);
            $data = DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::to($user->email)->send(new UserRestPassword(['data' => $user, 'token' => $token]));
            session()->flash('success_rest', 'تم ارسال تعديل لينك اعادة كلمة السر الي الايميل الخاص بك');
            return back();

        }else{
            session()->flash('no_email', 'لا يوجد بريد الكتروني مسجل لك الينا من فضلك قم بأرسال لنا بيانات التسجيل التي تعرفها حتي نتمكن من استرجاع حسابك مرة أخري  .. رسالنا علي رقم الواتس  01111599363');

            return back();
        }
        return back();
    }

    public function reset_password($token){

        $sliders = slider::all();
        $links = Link::all();
        $icons = Icon::all();


        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){

            return view('design.reset_password', ['data' => $check_token, 'sliders'=>$sliders, 'links'=>$links, 'icons'=>$icons]);
        }else{

            return redirect('forget/password');
        }

    }

    public function reset_password_post($token){

        $this->validate(request(), [
            'password' => 'required',
        ], [],[
            'password' => 'password'
        ]);

        $check_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();
        if(!empty($check_token)){

           $user = User::where('email', $check_token->email)->update([
               'email'  =>  $check_token->email,
               'password' => bcrypt(request('password'))
               ]);

               DB::table('password_resets')->where('email', request('email'))->delete();
               Auth()->guard('web')->attempt(['email' => $check_token->email, 'password'=> request('password')], true);
               return redirect('/');
        }else{

            return redirect('forget/password');
        }
    }
}
