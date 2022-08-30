<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|unique:products',
            'product_code' => 'required|string|unique:products',
        ]);
        $product = Product::create($request->all());
        return response()->json([
            'Data' => new ProductResource($product),
            'Message' => 'new product has been created',
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
        ]);
        $product->update($request->all());
        return response()->json([
            'Data' => new ProductResource($product),
            'Message' => 'new product has been updated',
        ], 201);
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'Data' => new ProductResource($product),
        ], 200);
    }
    public function shows()
    {
        $product = Product::get();
        return response()->json([
            'Data' => new ProductResource($product),
        ], 200);
    }
}
