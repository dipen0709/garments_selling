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
use App\Customer;
use App\Sizewithprice;
use App\ClothMaster;


class SizeWithPriceController extends CommonController{

    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->middleware('auth');
    }

    public function index(Request $request){
        $return_data = array();
        $term = Session::get('search_value');
        $Sizewithprice_data = Sizewithprice::where('chr_delete','=',0);
        if(isset($term) && $term != ''){
            $Sizewithprice_data->where('serial_name','like','%' .$term . '%');
        }
        $result = $Sizewithprice_data->orderBy('serial_name','ASC')->paginate(100);
        $this->data['title'] = 'Average';
        $this->data['sizenprices'] = $result;
        $this->data['user'] = Auth::user();
        $this->data['kapad_array'] = BillController::getKapadArray();
        return View('admin/sizewithprice/index', array_merge($this->data, $return_data))->with('term', $term)->render();
    }
    
    public function create(Request $request){
        $return_data = array();
        $this->data['title'] = 'Add Average';
        $this->data['kapad_master'] = ClothMaster::select('id','name')->where('chr_delete','=',0)->get();
        return View('admin/sizewithprice/create', array_merge($this->data, $return_data))->render();
    }
    
    public function edit(Request $request){
        $sizewithprice = Sizewithprice::find($request->id);     
        $return_data['sizewithprice'] = $sizewithprice;
        $this->data['kapad_master'] = ClothMaster::select('id','name')->where('chr_delete','=',0)->get();
        $this->data['title'] = 'Edit Average';
        $return_data['cloth_details'] = array();
        if(!empty($sizewithprice) && count($sizewithprice) > 0) {
            if(isset($sizewithprice['cloth_details']) && $sizewithprice['cloth_details'] != ''){
                $return_data['cloth_details'] = json_decode($sizewithprice['cloth_details']);
            }
            return View('admin/sizewithprice/edit', array_merge($this->data, $return_data))->render();
        } else {
            return redirect()->route('home');
        }
    }
    
    public function delete(Request $request){
        $sizenprice           =  Sizewithprice::find($request->id);
        $sizenprice->chr_delete = 1;
        $sizenprice->save();
        return redirect()->route('sizewithprice');
    }
    
     
    
    public function update(Request $request){
        $sizenprice =  Sizewithprice::find($request->id);
        $sizenprice->serial_name = $request->serial_name;
        $j = $request->addDetails;
        $size = $request->size;
        $price = $request->price;
        $data = array();
        for($a= 0; $a < $j; $a++){
            if(isset($size[$a]) && isset($price[$a])){
                $data['size'] = $size[$a];
                $data['price'] = $price[$a];
                $x[] = $data;
            }
        }
        if(!empty($x)){
            $sizenprice->cloth_details = json_encode($x);
        } else {
            $sizenprice->cloth_details = '';
        }
        $sizenprice->save();
        return redirect()->route('sizewithprice');
    }
    
    public function store(Request $request){

        $sizenprice = new Sizewithprice();
        $sizenprice->serial_name = $request->serial_name;
        $j = $request->addDetails;
        $size = $request->size;
        $price = $request->price;
        $data = array();
        for($a= 0; $a < $j; $a++){
            if(isset($size[$a]) && isset($price[$a])){
                $data['size'] = $size[$a];
                $data['price'] = $price[$a];
                $x[] = $data;
            }
            
        }
        if(!empty($x)){
            $sizenprice->cloth_details = json_encode($x);
        }
        $sizenprice->save();
        return redirect()->route('sizewithprice');
    }
     
    
}

?>