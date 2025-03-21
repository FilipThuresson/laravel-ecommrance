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

        if ($request->hasFile('files') && $product) {
            $order = 1;
            foreach ($request->file('files') as $file) {
                $path = $file->store('products', 'public');
                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $product_image->path = $path;
                $product_image->user_id = Auth::id();
                $product_image->show_order = $order++;
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
        //
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
