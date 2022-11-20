<?php

namespace App\Http\Controllers;

use App\Models\Sticker;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class StickerController extends Controller
{
    public function __construct()
    {
        $this->sticker_model = new Sticker();   
    }
    public function index(){
        $data = $this->sticker_model->whereNull('deleted_at')->get();
        return view('sticker.list',['stickers'=>$data]);
    }

    public function create(){
        return view('sticker.add');
    }

    public function view($id){
         $data = $this->sticker_model->where('id',$id)->first();
        return view('sticker.view',['sticker' => $data]);
    }

    public function deleteMe(Request $request){
        $this->sticker_model->where('id',$request->id)->delete();
    }

    public function store(Request $request){
        try{
            if($request->has('file')){
                $file = $this->uploadCustomFile($request->file);
                $request->merge([
                    'image' => $file['path'],
                    'filename' => $file['file_name']
                ]);
            }
            
            $data = $this->sticker_model->create($request->only($this->sticker_model->getFillable()));
            return redirect()->back()->with('success', 'Uploaded Succssfully');   
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
}
