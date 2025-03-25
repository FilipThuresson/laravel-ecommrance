<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $title = 'Products';
        $user = Auth::user();
        $products = Product::paginate(20);

        return view('products.index', compact('title', 'user', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('manage product')) {
            Session::flash('error_message', 'You do not have permission to edit products');
            return back();
        }

        $title = "Create a new product";
        return view('products.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {

        $data = $request->validated();
        $data['active'] = $request->has('active') ? true : false;
        $product = Product::create($data);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $path = $file->store('products', 'public');
                $order = $request->post('image_orders')[$index] ?? ($index + 1);

                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $product_image->path = $path;
                $product_image->user_id = Auth::id();
                $product_image->show_order = $order;
                $product_image->save();
            }
        }

        if ($request->save_exit) {
            return redirect(route('products.index'))->with('success_message', 'Product added successfully!');
        }

        return redirect()->back()->with('success_message', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if (!auth()->user()->can('manage product')) {
            Session::flash('error_message', 'You do not have permission to edit products');
            return back();
        }

        $title = "Edit product - " . $product->id;
        return view('products.edit', compact('product', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['active'] = $request->has('active') ? true : false;
        $product->update($data);

        // Handle removed images
        if ($request->post('removed_images')) {
            foreach ($request->post('removed_images') as $image_id) {
                $product_image = ProductImage::find($image_id);
                if ($product_image && $product_image->product_id === $product->id) {
                    $product_image->delete();
                }
            }
        }

        // Handle existing images' order
        if ($request->has('image_ids')) {
            foreach ($request->post('image_ids') as $index => $imageId) {
                if ($imageId) {
                    $product_image = ProductImage::find($imageId);
                    if ($product_image && $product_image->product_id === $product->id) {
                        $product_image->show_order = $request->post('image_orders')[$index];
                        $product_image->save();
                    }
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $path = $file->store('products', 'public');
                $order = $request->post('image_orders')[$index] ?? ($product->images()->max('show_order') + 1);

                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $product_image->path = $path;
                $product_image->user_id = Auth::id();
                $product_image->show_order = $order;
                $product_image->save();
            }
        }

        if ($request->save_exit) {
            return redirect(route('products.index'))->with('success_message', 'Product added successfully!');
        }

        return redirect(route('products.edit', $product->id))->with('success_message', 'Product added successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!auth()->user()->can('manage product')) {
            Session::flash('error_message', 'You do not have permission to delete products');
            return redirect(route('products.index'));
        }

        $product->delete();
        Session::flash('success_message', 'Product deleted successfully');
        return redirect(route('products.index'));
    }
}
