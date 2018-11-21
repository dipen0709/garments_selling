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
        $this->data['stock'] = Stock::where('chr_delete','=',0)->orderBy('id','desc')->get();
        return View('admin/stock/index', array_merge($this->data, $return_data))->render();
    }

    public function create(Request $request){
        $return_data = array();
        $this->data['title'] = 'Add Stock';
        $this->data['stock'] = Stock::where('chr_delete','=',0)->orderBy('id','desc')->get();
        $this->data['sizewithprices'] = Sizewithprice::select('id','serial_name')->where('chr_delete','=',0)->get();        
        return View('admin/stock/create', array_merge($this->data, $return_data))->render();
    }
     
    public function store(Request $request){

        $stock =  new Stock();
        $stock->serial_no = $request->serial_no;
        $stock->kapad = $request->kapad;
        $stock->size = $request->size;
        $stock->qty = $request->qty;
        $stock->order_date = date('Y-m-d', strtotime($request->order_date));   
        $stock->chr_delete = 0;
        $stock->save();
        return redirect()->route('stock');
    }
    public function edit(Request $request){
        $stocks = Stock::find($request->id);
        $return_data['data'] = $stocks;
        $this->data['title'] = 'Edit Stock';
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
        $stock->serial_no = $request->serial_no;
        $stock->kapad = $request->kapad;
        $stock->size = $request->size;
        $stock->qty = $request->qty;
        $stock->order_date = date('Y-m-d', strtotime($request->order_date));   
        $stock->chr_delete = 0;        
        $stock->save();
        return redirect()->route('stock');
    }
   
}

?>