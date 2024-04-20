<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    function ProductPage():View{
        return view('pages.dashboard.product-page');
    }

        function CreateProduct(Request $request){
            $user_id = $request->header('id');

            // Delete Old File
            $filePath = $request->input('file_path');
            File::delete($filePath);

            // Prepare File Name & Path
            $img = $request->file('img');

            $time = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$time}-{$file_name}";
            $img_url = "images/uploads/{$img_name}";

            // Upload File
            $img->move(public_path('images/uploads'),$img_name);


            // Save to Database
            return Product::create([
                'user_id'=>$user_id,
                'category_id'=>$request->input('category_id'),
                'img_url'=>$img_url,
                'name'=>$request->input('name'),
                'type'=>$request->input('type'),
                'description'=>$request->input('description'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'is_active' => $request->input('is_active')
            ]);
        }

    function ProductDelete(Request $request){
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        $filePath = $request->input('file_path');
        File::delete($filePath);
        return Product::where('id',$product_id)->where('user_id',$user_id)->delete();
    }

    function ProductByID(Request $request){
        $user_id=$request->header('id');
        $product_id=$request->input('id');
        return Product::where('id',$product_id)->where('user_id',$user_id)->first();
    }

    function ProductList(Request $request){
        $user_id=$request->header('id');
        return Product::where('user_id',$user_id)->get();
    }


    function ProductUpdate(Request $request){
        $user_id=$request->header('id');
        $product_id=$request->input('id');

        if ($request->hasFile('img')){

            // Upload New File
            $img = $request->file('img');
            $time = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$time}-{$file_name}";
            $img_url = "images/uploads/{$img_name}";

            // Upload File
            $img->move(public_path('images/uploads'),$img_name);

            // Delete Old File
            $filePath = $request->input('file_path');
            File::delete($filePath);

            // Update Product
            return Product::where('id',$product_id)->where('user_id',$user_id)->update([
                'category_id'=>$request->input('category_id'),
                'img_url'=>$img_url,
                'name'=>$request->input('name'),
                'type'=>$request->input('type'),
                'description'=>$request->input('description'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'is_active' => $request->input('is_active')
            ]);
        }
        else{
            return Product::where('id',$product_id)->where('user_id',$user_id)->update([
                'category_id'=>$request->input('category_id'),
                'name'=>$request->input('name'),
                'type'=>$request->input('type'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'is_active' => $request->input('is_active')
            ]);
        }

    }
}
