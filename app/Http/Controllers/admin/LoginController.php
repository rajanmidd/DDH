<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\CustomHelper;
use App\models\Admin;
use App\Http\Controllers\Controller;
use Mail;

class LoginController extends Controller
{   
     use AuthenticatesUsers;

    protected $redirectTo = '/';
   /**
    * Show the Login page for the admin.
    * 
    * @return type
    */
     public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function index()
    {       
        if(auth()->guard('admin')->check())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login.login');
    }   
  
   /**
    * Function used for check the login functionality
    * 
    * @param Request $request
    */
   
   public function store(Request $request)
   {      
        $validator=$this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // echo \Hash::make('123456'); die;
        $data=$request->all();
        $AdminDetail=Admin::whereEmail($data['email'])->first();     
        if(empty($AdminDetail)) {
            return \Redirect::back()->withErrors(["Sorry, Your account doesn't exists."]);
        } else if(!\Hash::check($data['password'],$AdminDetail->password)) {
            return \Redirect::back()->withErrors(['Sorry, your password is incorrect.']);
        } else {       
            if(\Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]))  {
                return redirect()->route('admin.dashboard');
            } else {
                return \Redirect::back()->withErrors(['Sorry, Error ocurred. Please try again.']);
            }
        }    
    }
   
   /**
    * Function used for logout from the admin panel
    * 
    * @return type
    */
   
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('admin');
    }
}
