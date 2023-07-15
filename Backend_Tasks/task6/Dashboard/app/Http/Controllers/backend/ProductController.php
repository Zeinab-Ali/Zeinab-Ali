<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\traits\media;

class ProductController extends Controller
{
    use media;
    public function index()
    {
        //get all users
        $products = DB::table('products')
            ->select('id', 'name_en', 'name_ar', 'price', 'code', 'status', 'quantity', 'created_at')
            ->get();

        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
        $brands = DB::table('brands')->get(); //select *

        $subcategories = DB::table('subcategories')->select('id', 'name_en')->where('status', 1)->get();

        return view('backend.products.create', compact('brands', 'subcategories'));
    }

    public function store(StoreProductRequest $request)
    {

        //upload photo
        $photoName = $this->upload_photo($request->image, 'products');
        //insert in DB
        $data = $request->except('_token', 'image', 'page');
        $data['image'] = $photoName;
        DB::table('products')->insert($data);
        //redirect
        if ($request->page == 'back') {
            return redirect()->back()->with('success', 'sucessfull operation');
        } else {
            return redirect()->route('products.index')->with('success', 'sucessfull operation');
        }
    }

    public function edit($id)
    {
        $brands = DB::table('brands')->get(); //select *
        $subcategories = DB::table('subcategories')->select('id', 'name_en')->where('status', 1)->get();
        $product = DB::table('products')->where('id', $id)->first();
        return view('backend.products.edit', compact('product', 'brands', 'subcategories'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
    

        $data = $request->except('_token', 'image', 'page', 'method');

        if ($request->has('image')) {

            //delete old image
            $oldPhotoName = DB::table('products')->select('image')->where('id', $id)->first()->image;
            $photoPath = public_path('/dist/img/products/').$oldPhotoName;

            $this->delete_photo($photoPath);

            //upload photo
            $photoName = $this->upload_photo($request->image, 'products');
            $data['iamge'] = $photoName;
        }
        DB::table('products')
            ->where('id', $id)
            ->update($data);

        if ($request->update) {
            return redirect()->route('products.index')->with('success', 'sucessfull operation');
        }
    }
    public function destroy($id)
    {
        //delete image
        $PhotoName = DB::table('products')->select('image')->where('id', $id)->first()->image;

        $photoPath = public_path('/dist/img/products/').$PhotoName;
       $this->delete_photo($photoPath);

        //delete product
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'sucessfull operation');

    }
}
