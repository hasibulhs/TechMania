<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use App\Mail\EmailVerificationMail;
use Carbon\Carbon;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $user= User::where(['email'=>$req->email])->first();

        if(!$user)
        {
            //return redirect()->back()->with('error','Email is not registered');
            return "Email is not registered";
        }
        
        else
        {
            if(!$user->email_verified_at)
            {
                //return redirect()->back()->with('error','Email is not verified');
                return "Email is not verified";
            }
            
            else
            {
                if(!$user->is_active)
                {
                    //return redirect()->back()->with('error','User is not active. Contact admin');
                    return "User is not active. Contact admin";
                }
                
                else
                {
                    if(Hash::check($req->password,$user->password))
                    {
                        $req->session()->put('user', $user);
                        //return redirect('/')->with('success',"Login successfull");
                        return redirect('/');
                    }
                    
                    else
                    {
                        //return redirect()->back()->with('success',"Invalid credentials");
                        return "Invalid credentials";
                    }
                }
            }
        }
    }

    public function register(Request $req)
    {
        //return $req->input();

        $user = new User;
        $user->first_name=$req->first_name;
        $user->last_name=$req->last_name;
        $user->email=$req->email;
        $user->email_verification_code=Str::random(40);
        $user->password=Hash::make($req->password);
        $user->save();
        
        Mail::to($req->email)->send(new EmailVerificationMail($user));
        //return redirect()->back()->with('success','Registration successfull. Please check your email address for email verification link.');
        //return redirect()->back();
        return "Registration successfull. Please check your email address for email verification link.";
    }

    public function checkEmail(Request $req)
    {
        $user=User::where('email',$req->email)->first();
    	
        if($user)
        {
    		echo 'false';
    	}

        else
        {
    		echo 'true';
    	}
    }

    public function verify_email($verification_code)
    {
        $user=User::where('email_verification_code',$verification_code)->first();

        if(!$user)
        {
            //return redirect('/login')->with('error','Invalid URL');
            return "Invalid URL";
        }
        
        else
        {
            if($user->email_verified_at)
            {
                //return redirect('/login')->with('error','Email already verified');
                return "Email already verified";
            }
            
            else
            {
                $user->update([
                    'email_verified_at'=>\Carbon\Carbon::now()
                ]);

                //return redirect('/login')->with('success','Email successfully verified');
                return "Email successfully verified";
            }
        }
    }
}
