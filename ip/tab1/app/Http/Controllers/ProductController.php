<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function addProduct() {
        return view('add_product');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();

        if ($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $image_name = time().rand(1,99). '_img.' . $image->getClientOriginalExtension();
                $image->move('upload/images/product', $image_name);

                $product_image = new ProductImage();
                $product_image->name = $image_name;
                $product_image->product_id = $product->id;

                $product_image->save();
            }
        }

        return redirect()->route('view.products')->with('success', 'Product added successfully.');
    }

    public function storeUsingAjax(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();

        if ($request->hasFile('images')) {
            foreach($request->images as $image) {
                $image_name = time().rand(1,99). '_img.' . $image->getClientOriginalExtension();
                $image->move('upload/images/product', $image_name);

                $product_image = new ProductImage();
                $product_image->name = $image_name;
                $product_image->product_id = $product->id;

                $product_image->save();
            }
        }

        return response()->json(['status'=>'success', 'message'=>'Product added successfully.']);
    }

    public function editUsingAjax($edit_id) {
        $product = Product::find($edit_id);
        $product_images = ProductImage::where('product_id', '=', $edit_id)->get();
        
        if ($product->count() > 0) {
            return response()->json(['status'=>'success', 'product_data'=>$product, 'product_images_data'=>$product_images]);
        } else {
            return response()->json(['status'=>'fail', 'message'=>'Product not available for edit.']);
        }
    }

    public function countProductImagesAjax($product_id) {
        $img_count = ProductImage::where('product_id', '=', $product_id)->count('id');
        
        if($img_count > 0) {
            return response()->json(['status'=>'success', 'message'=>'Product has images.']);
        }else if ($img_count == 0) {
            return response()->json(['status'=>'noimage', 'message'=>'Product does not have images.']);
        }
    }

    public function deleteUsingAjax($delete_id) {
        if(Product::find($delete_id)->delete()) {
            return response()->json(['status'=>'success', 'message'=>'Product deleted successfully.']);
        } else {
            return response()->json(['status'=>'fail', 'message'=>'Something went wrong in deletion.']);
        }
    }

    public function show() {
        $data = Product::all();

        //$data = Product::join('product_images', 'products.id', '=', 'product_images.product_id')
                //->get(['products.*', 'product_images.name as product_image']);

        return view('view_products', compact('data'));
    }

    public function viewProductImages($product_id) {

        $data = ProductImage::where('product_id', '=', $product_id)->get();

        return response()->json($data);
    }

    public function deleteImage($delete_id) {
        $product_image = ProductImage::find($delete_id);
        $old_image = $product_image->name;

        $product_image->delete();

        if(file_exists('upload/images/product/'.$old_image)) {
            unlink('upload/images/product/'.$old_image);
        }

        return response()->json(['status'=>'success', 'message'=>'Product image deleted successfully.']);
    }
}
