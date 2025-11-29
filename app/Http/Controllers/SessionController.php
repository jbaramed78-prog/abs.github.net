<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\vpassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\NotifyMail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function create()
    {
        return view('login.login');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $cin_email = $request->cin_email;
        $pwd = $request->password;
        $remember_me  = ( !empty( $request->input('check')) )? TRUE : FALSE;
        
        /* if(filter_var($cin_email, FILTER_VALIDATE_EMAIL)) {
            // logic for a valid email
            $result = $request->validate(['cin_email' => 'bail|required|exists:users,email']);
            $user = $request->validate([
                'cin_email' => '',
                'password' => ['bail','required',new vpassword($result['cin_email'])]
            ]);
    
            if(!User::Where('email', $result['cin_email'])->first()->active ){
    
                return redirect('/')->with('suspended','Account suspended for this moment');
            }
            
            $remember_me  = ( !empty( $request->input('check')) )? TRUE : FALSE;
    
            if(Auth::attempt([
                'email'=>$cin_email,
                "password"=>$request->password,
            ],$remember_me)){
                $request->session()->regenerate();
                return redirect()->intended('home');
            }
        }
        else {
            // logic for a valid matricule
            $result = $request->validate(['cin_email' => 'bail|required|exists:users,cin']);
            $user = $request->validate([
                'cin_email' => '',
                'password' => ['bail','required',new vpassword($result['cin_email'])]
            ]);
    
            if(!User::Where('cin', $result['cin_email'])->first()->active  ){
    
                return redirect('/')->with('suspended','Account suspended for this moment');
            }
            
            $remember_me  = ( !empty( $request->input('check')) )? TRUE : FALSE;
    
            if(Auth::attempt([
                'cin'=>$cin_email,
                "password"=>$request->password,
            ],$remember_me)){
                $request->session()->regenerate();
                return redirect()->intended('home');
            }
        } */
     
        /* using validator */
        
        $messages = [
            "required"=>":attribute Obligatoire",
            "exists"=>":attribute invalide"
        ];
      
        $rules = [
            "cin_email"=>'required',
        ];
        $attributes = [
            'cin_email' => 'Matricule/Email', 
        ];
        
        $validator = Validator::make($request->all(),$rules,$messages,$attributes);
        if ($validator->stopOnFirstFailure()->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            
            if(filter_var($cin_email, FILTER_VALIDATE_EMAIL)){
            
                /* email */
                $input = [
                    "email"=>$cin_email,
                    "password"=>$pwd
                ];
    
                $rules = [
                    "email"=>'bail|required|exists:users,email',
                    'password' => ['bail','required',new vpassword($cin_email)]
                ];
                $attributes = [
                    'email' => 'Email',
                    'password'=>"Mot de passe"
                ];
                
                $validator = Validator::make($input,$rules,$messages,$attributes);
                if ($validator->stopOnFirstFailure()->fails()) {
                    return redirect('/')
                                ->withErrors($validator)
                                ->withInput();
                }
                else
                {
                    if(!User::Where('email', $cin_email)->first()->active  ){
            
                        return redirect('/')->with('suspended','Account suspended for this moment');
                    }
                    
                    
                    
                    if(Auth::attempt([
                        'email'=>$cin_email,
                        "password"=>$request->password,
                    ],$remember_me)){
                        $request->session()->regenerate();
                        return redirect()->intended('home');
                    }

                }
            }else{
                /* cin */
                $input = [
                    "cin"=>$cin_email,
                    "password"=>$pwd
                ];
    
                $rules = [
                    "cin"=>'bail|required|exists:users,cin',
                    'password' => ['bail','required',new vpassword($cin_email)]
                ];
                $attributes = [
                    'cin' => 'matricule',
                    'password'=>"Mot de passe"
                ];
                
                $validator = Validator::make($input,$rules,$messages,$attributes);
                if ($validator->stopOnFirstFailure()->fails()) {
                    return redirect('/')
                                ->withErrors($validator)
                                ->withInput();
                } else
                {
                    if(!User::Where('cin', $cin_email)->first()->active  ){
            
                        return redirect('/')->with('suspended','Account suspended for this moment');
                    }
                    
                    
                    
                    if(Auth::attempt([
                        'cin'=>$cin_email,
                        "password"=>$request->password,
                    ],$remember_me)){
                        $request->session()->regenerate();
                        return redirect()->intended('home');
                    }

                }
            }

        }
       


      
     
       

    }

    public function destroy()
    {
        $user = User::Find(Auth::user()->id);
        $user->status = 0;
        $user->save();
        
        auth()->logout();
        return redirect("/");
    }

    public function check(Request $request){

        $attr = $request->validate([
            'cin' => 'bail|required|exists:users,cin',
            'email' => 'bail|required|exists:users,email'
        ]);

        $code = rand(10000,99999);



        session([
            'user_cin' => $attr["cin"],
            'code' => $code,
            'email'=>$attr['email']
        ]);

        $user = User::Where('cin',$attr["cin"])->first();

        /* $attr['email'] */

        $mail = Mail::to('anasdabibe98@gmail.com')->send(new NotifyMail($code,$user->firstname,$user->lastname));

        if($mail instanceof \Illuminate\Mail\SentMessage)
        {
            return redirect('/sendEmail')->with(['email' => $attr["email"]]);

        }else{
            dd("Failed");
        }

    }

    public function codeVerification(Request $request)
    {

        $codeGiven = (int)$request->codeVerification;
        $codeMail = session('code');

        

        if($codeGiven != $codeMail){

            return redirect('/sendEmail')
            ->with([
                'email' => session('email'),
                'error' => true
            ]);
        }
        
        $user = User::where('cin',session('user_cin'))->firstOrfail();

        return redirect('/pwdReset')->with([
            'img' => $user->picture_path,
            'name' => $user->firstname.' '.$user->lastname
        ]);

    }

    public function reset(Request $request)
    {

        $user = User::where('cin',session('user_cin'))->firstOrfail();

        if($request->pwd != $request->rpwd){

            return redirect('/pwdReset')->with([
                'img' => $user->picture_path,
                'name' => $user->firstname.' '.$user->lastname,
                'error' => true
            ]);
        }

        

        $user["password"] = $request->rpwd;
        $user->save();
        auth()->login($user);
        return redirect('/home');
    }
}
