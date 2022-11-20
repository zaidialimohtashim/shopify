<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function __construct(){
        $this->category_model = new Category();  
    }

    public function allCategories(){
        $data = $this->category_model->with(['getParentCategory'])->whereNull('deleted_at')->get();
        return view('category.list',['categories'=>$data]);
    }

    public function storeCategories(Request $request){
        try{
            if($request->has('file')){
                $file = $this->uploadCustomFile($request->file);
                $request->merge([
                    'category_image' => $file['path'],
                    'filename' => $file['file_name']
                ]);
            }

           
            $slug = makeSlug(Category::class,$request->name);
            $request->merge(['slug'=>$slug]);
            $this->category_model->create($request->only($this->category_model->getFillable()));
            return redirect()->back()->with('success','Category successfully uploaded');

        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()],400);
        }
    }

    public function updateCategories(Request $request){
        try{
            if($request->has('file')){
                $file = $this->uploadCustomFile($request->file);
                $request->merge([
                    'category_image' => $file['path'],
                    'filename' => $file['file_name']
                ]);
            }
           
            // $slug = makeSlug(Category::class,$request->name);
            // $request->merge(['slug'=>$slug]);
            $this->category_model->where("id",$request->id)->update($request->only($this->category_model->getFillable()));
            return redirect()->back()->with('success','Category successfully updated');

        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()],400);
        }
    }

    public function addCategories(){
        $data = $this->category_model->whereNull('deleted_at')->where("parent",0)->get();
        return view('category.add',["parents"=>$data]);
    }

    public function editCategories($id){
        $data = $this->category_model->whereNull('deleted_at')->where("parent",0)->get();
        $category = $this->category_model->with(['getParentCategory'])->whereNull('deleted_at')->where("id",$id)->first();
        return view('category.edit',["parents"=>$data,"category"=>$category,"id"=>$id]);
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

    public function delete(Request $request)
    {
        $this->category_model->where("id",$request->id)->delete();
    }
}
