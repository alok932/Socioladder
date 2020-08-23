<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Image;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'              => 'required|max:255',
            'price'             => 'required|numeric',
            'discount_percent'  => 'required|integer',
            'description'       => 'required',
            'display_image'     => 'required|image',
        ]);

        // Upload product image
        $image_name = $this->uploadProductImage($request->file('display_image'));

        // Save Product
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_percent = $request->discount_percent;
        $product->description   = $request->description;
        $product->display_image = $image_name;
        $product->save();
        return redirect()->to('admin/products')->withSuccess('Product added succesfully');
    }

    private function uploadProductImage($uploaded_image)
    {
        $destinationPath = public_path('uploads/products');
        $img = Image::make($uploaded_image);
        $image_name = time().'.'.$uploaded_image->getClientOriginalExtension();
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$image_name);
        return $image_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name'              => 'required|max:255',
            'price'             => 'required|numeric',
            'discount_percent'  => 'required|integer',
            'description'       => 'required',
            'display_image'     => 'image',
        ]);

        // Upload product image
        if ($request->hasFile('display_image'))
            $image_name = $this->uploadProductImage($request->file('display_image'));

        $product->name = $request->name;
        $product->price = $request->price;
        $product->discount_percent = $request->discount_percent;
        $product->description   = $request->description;
        if(isset($image_name))
            $product->display_image = $image_name;
        $product->save();
        return redirect()->to('admin/products')->withSuccess('Product updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->back()->withSuccess('Product deleted succesfully');
    }

    /**
     * Toggle Product status
     * 
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus(Product $product)
    {
        $product->status = $product->status=='active'?'inactive':'active';
        $product->save();
        return redirect()->back()->withSuccess('Product updated succesfully');
    }

}
