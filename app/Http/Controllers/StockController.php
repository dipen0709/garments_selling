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
use App\Stock;
use App\Sizewithprice;

class StockController extends CommonController{

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
        $this->data['title'] = 'Stocks';
        $this->data['stock'] = Stock::select('stocks.*','sizewithprices.serial_name')->leftjoin('sizewithprices','sizewithprices.id','=','stocks.serial_id')->where('stocks.chr_delete','=',0)->orderBy('stocks.order_date','DESC')->paginate(25);
        return View('admin/stock/index', array_merge($this->data, $return_data))->render();
    }

    public function create(Request $request){
        $return_data = array();
        $this->data['title'] = 'Add Stock';
        $this->data['sizewithprices'] = Sizewithprice::select('id','serial_name','cloth_details')->where('chr_delete','=',0)->get();        
        return View('admin/stock/create', array_merge($this->data, $return_data))->render();
    }
     
    public function store(Request $request){
        $data = $request->all();
        $stock =  new Stock();        
        $serial_id = $request->serial_id;
        $stock->serial_id = $serial_id;
        $stock->size = $request->size;
        $stock->qty = $request->qty;
        $stock->order_date = date('Y-m-d', strtotime($request->order_date));                	
        $stock->save();
        
        return redirect()->route('stock');
    }
    public function edit(Request $request){
        $stocks = Stock::find($request->id);
        $return_data['data'] = $stocks;
        $this->data['title'] = 'Edit Stock';
        $this->data['sizewithprices'] = Sizewithprice::select('id','serial_name','cloth_details')->where('chr_delete','=',0)->get();   
        $serial_id = $stocks->serial_id; 
        if($serial_id){
              $check_sizewithprice =  $sizewithprices = Sizewithprice::select('id','serial_name','cloth_details')->where('chr_delete','=',0)->where('id','=',$serial_id)->first();
        }
        $kapad_array = BillController::getKapadArray();
        $result = json_decode($check_sizewithprice->cloth_details);
        $this->data['kapad']=$result;
        if(!empty($stocks) && count($stocks) > 0) {
            return View('admin/stock/edit', array_merge($this->data, $return_data))->render();
        } else {
            return redirect()->route('home');
        }
    }
    
    public function delete(Request $request){
        $stock           =  Stock::find($request->id);
        $stock->chr_delete = 1;
        $stock->save();
        return redirect()->route('stock');
    }         
    
    public function update(Request $request){

        $stock =  Stock::find($request->id);
        $stock->serial_id = $request->serial_id;  
        $stock->size = $request->size;
        $stock->qty = $request->qty;
        $stock->order_date = date('Y-m-d', strtotime($request->order_date));   
        $stock->chr_delete = 0;        
        $stock->save();
        return redirect()->route('stock');
    }
   
    public function getsizenkapad(Request $request){
        
        $serial_id = $request->serial_id; 
        if($serial_id){
              $check_sizewithprice =  $sizewithprices = Sizewithprice::select('id','serial_name','cloth_details')->where('chr_delete','=',0)->where('id','=',$serial_id)->first();
        }
      
        if(!empty($check_sizewithprice)){
            if(isset($check_sizewithprice->cloth_details) && $check_sizewithprice->cloth_details){
                $kapad_array = BillController::getKapadArray();
                $result = json_decode($check_sizewithprice->cloth_details);
                $return_data['flag'] = 1;
                $count =  count($result);
                
                $html = '';

                if($count > 0){
           $html .= '<div class="col-md-12"><div class="form-group"><div class="col-md-6"><label>Size</label>
            <select id="size" name="size" class="form-control m-b-sm"><option value="0">Select Size</option>';
             $valid_count = 0;
             foreach($result as $key => $data){
                 $i = $key + 1;
                 $size = '';
                 
                 if(isset($data->size)){
                    $size = $data->size;   
                 }                                
                  if($size){    
                      $valid_count++;
             $html .= '<option value="'.$size.'">'.$size.'</option>';             
                    }
             }
             $html .= '</select></div>';
             $html .= '<div class="col-md-2"><label>Qty</label><input class="form-control" type="text" name="qty" id="qty" value="" /></div>';
             $html .= '<input type="hidden" name="count_size_with_price" id="count_size_with_price" value="'.$valid_count.'" />';   
              $html .= '</div></div>';
                }
            } else {
                $html = '<div class="form-group">Size not available for selected serial number.</div>';
            }
        } else {
            $html  = '<div class="form-group">Please select valid serial number.</div>';
        }
        return $html;
    }
}

?>