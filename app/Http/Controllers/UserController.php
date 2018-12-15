<?php
namespace App\Http\Controllers;

/* * Laravel built-in or extened functionality/Utility class used* */

use Auth;
use File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Redirect;
use App\User;
use App\ApplicationUser;

class UserController extends CommonController{

    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }
    
    public function index()
    {
        $return_data = array();
        $this->data['title'] = 'Users';
        $this->data['users'] = Auth::user()->get();
        
//        echo '<pre>'; print_r($this->data['data']); die;
        return View('admin/users/index', array_merge($this->data, $return_data))->render();
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    
}

?>