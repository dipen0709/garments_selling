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
use App\Customer;

class CustomerController extends CommonController{

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
        $this->data['title'] = 'Customer';
        $this->data['customer'] = Customer::where('chr_delete','=',0)->orderBy('id','desc')->get();
        return View('admin/customer/index', array_merge($this->data, $return_data))->render();
    }
    public function create(Request $request){
        $return_data = array();
        $this->data['title'] = 'Add Customer';
        $this->data['customer'] = Customer::where('chr_delete','=',0)->orderBy('id','desc')->get();
        return View('admin/customer/create', array_merge($this->data, $return_data))->render();
    }     
    public function store(Request $request){

        $customer           =   new Customer();
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->chr_delete = 0;
        $customer->save();
        return redirect()->route('customer');
    }
    public function edit(Request $request){
        $customers = Customer::find($request->id);
        $return_data['data'] = $customers;
        $this->data['title'] = 'Edit Customer';
        if(!empty($customers) && count($customers) > 0) {
            return View('admin/customer/edit', array_merge($this->data, $return_data))->render();
        } else {
            return redirect()->route('home');
        }
    }    
    public function delete(Request $request){
        $customer           =  Customer::find($request->id);
        $customer->chr_delete = 1;
        $customer->save();
        return redirect()->route('customer');
    }   
    public function update(Request $request){

        $customer           =  Customer::find($request->id);
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->chr_delete = 0;                 
        $customer->save();
        return redirect()->route('customer');
    }       
}

?>