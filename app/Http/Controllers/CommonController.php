<?php

namespace App\Http\Controllers;

use Auth;
use Route;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\User;


class CommonController extends Controller {

     protected $data                   = array();
     protected $iconpath               = array();
     protected $sidemenu               = array();
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
       $route = Route::current()->action;
       $route_group = '';
       if(isset($route['routegroup'])){
          $route_group = $route['routegroup'];
       }
       $this->data['route_group'] = $route_group;
       $this->iconpath = URL::to('/public/icons/').'/';
       $this->data['uploadpath'] = URL::to('/public/upload/').'/';
    }
}
