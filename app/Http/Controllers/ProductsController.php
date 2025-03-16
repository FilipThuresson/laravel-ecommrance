<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Product;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        //
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
        if (!auth()->user()->can('edit product')) {
            Session::flash('error_message', 'You do not have permission to edit products');
            return back();
        }

        $title = "Edit product";
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
        if (!auth()->user()->can('edit product')) {
            Session::flash('error_message', 'You do not have permission to delete products');
            return redirect(route('products.index'));
        }

        $product->delete();
        Session::flash('success_message', 'Product deleted successfully');
        return redirect(route('products.index'));
    }
}
