<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClothMaster;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**ClothMaster
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public static function addCloth(Request $request){
        $cloth_name = $request->cloth_name;        
        if($cloth_name){
            $check_cloth = ClothMaster::where('name','=',$cloth_name)->first();            
            if(empty($check_cloth)){
                $cloth_master = new ClothMaster();
                $cloth_master->name = $cloth_name;
                $cloth_master->save();
                $return_data['flag'] = 1;
                $return_data['msg'] = 'Cloth type added successfully.';
                
                $cloths =  ClothMaster::select('name','id')->where('chr_delete','=',0)->get();
                $return_data['count'] =  $cloths->count();
                $return_data['cloth'] =  $cloths;
                
            } else {
                $return_data['flag'] = 0;
                $return_data['msg'] = 'Cloth type name already exist.';
            }
        } else {
            $return_data['flag'] = 0;
            $return_data['msg'] = 'Please enter Cloth type.';
        }
        return json_encode($return_data);
    }
}
