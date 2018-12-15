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
use App\Bill;
use App\ClothMaster;
use App\Sizewithprice;

class BillController extends CommonController{

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
        $this->data['title'] = 'Bills';
        $this->data['bill'] = Bill::where('chr_delete','=',0)->orderBy('id','desc')->get();
        return View('admin/bill/index', array_merge($this->data, $return_data))->render();
    }

    public function create(Request $request){
        $return_data = array();
        $this->data['title'] = 'Add Bill';
        $this->data['bill'] = Bill::where('chr_delete','=',0)->orderBy('id','desc')->get();
        $sizewithprices = Sizewithprice::select('id','serial_name')->where('chr_delete','=',0);
        if($bills->serial_id && $order_count > 0){
           $sizewithprices->where('id','=',$bills->serial_id);
        }
        $return_data['sizewithprices'] = $sizewithprices->get();
        
        return View('admin/bill/create', array_merge($this->data, $return_data))->render();                
    }
     
    public function store(Request $request){

        $bill =  new Bill();
        $bill->serial_no = $request->serial_no;
        $bill->kapad = $request->kapad;
        $bill->size = $request->size;
        $bill->order_date = date('Y-m-d', strtotime($request->order_date));   
        $bill->chr_delete = 0;
        $bill->save();
        return redirect()->route('bill');
    }
    public function edit(Request $request){
        $bills = Bill::find($request->id);
        $return_data['data'] = $bills;
        $this->data['title'] = 'Edit Bill';
        if(!empty($bills) && count($bills) > 0) {
            return View('admin/bill/edit', array_merge($this->data, $return_data))->render();
        } else {
            return redirect()->route('home');
        }
    }
    
    public function delete(Request $request){
        $bill           =  Bill::find($request->id);
        $bill->chr_delete = 1;
        $bill->save();
        return redirect()->route('bill');
    }
    
     
    
    public function update(Request $request){

        $bill =  Bill::find($request->id);
        $bill->serial_no = $request->serial_no;
        $bill->kapad = $request->kapad;
        $bill->size = $request->size;
        $bill->order_date = date('Y-m-d', strtotime($request->order_date));   
        $bill->chr_delete = 0;        
        $bill->save();
        return redirect()->route('bill');
    }
   
    public static function getKapadArray(){
        return $kapad_array = ClothMaster::pluck('name','id');        
    }
}

?>