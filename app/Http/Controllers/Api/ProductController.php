<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Notification;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Notifications\NewProductNotification;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => true,
            'products' => $products
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->middleware('GenerateUser::generateuser');
        $data = $request->all();
        $product = Product::create($data);
        //Notification will be sent to user from the product observer and the new user is generated from the generateuser middleware by the user factory
        return response()->json([
            'status' => true,
            'message' => "Product Created successfully!",
            'product' => $product
        ], 200);


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }


    public function update(StoreProductRequest $request, Product $product)
    {
        dd($request->all);
        $product->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "Product updated successfully!",
            'product' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => "product Deleted successfully!",
        ], 200);
    }
}
