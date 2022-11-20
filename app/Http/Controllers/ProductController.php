<?php

namespace App\Http\Controllers;

use App\Models\CustomizeProduct;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->product_model = new Product();   
        $this->custom_product_model = new CustomizeProduct();   
    }
    public function index(){
        $data = $this->product_model->whereNull('deleted_at')->get();
        return view('product.list',['products'=>$data]);
    }

    public function customize_product_list(){
        $data = $this->custom_product_model->with(['product'])->whereNull('deleted_at')->get();
        return view('product.custom_product_list',['products'=>$data]);
    }

    public function home(){
        $data = $this->product_model->whereNull('deleted_at')->get();
        return view('product.home',['products'=>$data]);
    }

    public function create(){
        return view('product.add');
    }

    public function view($id){
         $data = $this->product_model->where('id',$id)->first();
        return view('product.view',['product' => $data]);
    }

    public function deleteMe(Request $request){
        $this->product_model->where('id',$request->id)->delete();
    }

    public function store(Request $request){
        try{
            if($request->has('file')){
                $file = $this->uploadCustomFile($request->file);
                $request->merge([
                    'featured_image' => $file['path'],
                    'filename' => $file['file_name']
                ]);
            }
            
            $data = $this->product_model->create($request->only($this->product_model->getFillable()));
            return redirect()->back()->with('success','Product successfully uploaded');

        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage()],400);
        }
    }

    private function uploadCustomFile($file)
    {
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $basename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $ext = $file->getClientOriginalExtension();
        $name = time() . $basename . "." . $ext;
        $file->move(public_path() . '/files/', $name);
        return ["file_name" => $filename, "path" =>'/files/' . $name,"extension" =>$ext];
    }

    public function save_customize_product(Request $request){
        try{
            $data = $request->all();
        $pos  = strpos($data['image'], ';');
        $type = explode(':', substr($data['image'], 0, $pos))[1];
        $ext='';

        switch($type){
            case 'image/png':
                $ext='.png';
            break;
            case 'image/jpg':
                $ext='.jpg';
            break;
            case 'image/jpeg':
                $ext='.jpg';
            break;
        }

        $png_url = "perfil-".time().$ext;
        $path = public_path() . "/files/" . $png_url;
        $img = $data['image'];
        $img = substr($img, strpos($img, ",")+1);
        $data = base64_decode($img);
        $success = file_put_contents($path, $data);
        if($success){
            $this->custom_product_model->create([
                'product_id' => $request->product_id,
                'shop_id' => $request->shop_id,
                'customize_url' => "/files/" . $png_url,
                'type' => $ext,
            ]);
        }
        }catch(Exception $e){
            return $e->getMessage();
        }
        
    }
}
