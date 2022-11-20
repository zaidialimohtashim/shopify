<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Product;
use App\Models\Sticker;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;


class DesignController extends Controller
{
    public function __construct()
    {
        $this->shop_model = new User();
        $this->badges = new Badge();
        $this->stickers = new Sticker();
        $this->products = new Product();
    }

    public function index(Request $request){
   
        try{
        $shop_data = $this->shop_model->where('name',$request->shop)->first();
           
        $badges = $this->badges->whereNull('deleted_at')->get();
        $stickers = $this->stickers->whereNull('deleted_at')->get();
        $product = $this->products->where("id",$request->id)->whereNull('deleted_at')->first();
        $colors = $this->products->select('color')->whereNull('deleted_at')->get();

        return view('designer', 
        [
            "shop"=>$shop_data,
            "badges"=>$badges,
            "stickers"=>$stickers,
            "product" => $product,
            "colors" => $colors,
            "image" => $product->featured_image
        ]);
        }
        catch (Exception $e){
            
        }
    }

    public function getImage(Request $request){
        $colors = $this->products->where('color',"#".$request->color)->whereNull('deleted_at')->first();
        if($colors)
           return \URL::to($colors->featured_image);
    }

    public static function getImageFromRoute($url){
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;
    }
}
