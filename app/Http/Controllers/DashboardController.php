<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends CommonController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return_data = array();
        $this->data['title'] = 'Dashboard';
        $this->data['user'] = Auth::user();
        
        return View('admin/dashboard', array_merge($this->data, $return_data))->render();
    }
}
