<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * VIEW PRODUCTS (admin + user)
     */
    public function index()
    {
        return response()->json([
            'products' => Products::all()
        ], 200);
    }

    /**
     * CREATE PRODUCT (admin only)
     */
    public function store(Request $request)
    {
        abort_unless(
            $request->user()->tokenCan('products:manage'),
            403,
            'Unauthorized'
        );

        $product = Products::create($request->all());

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }

    /**
     * UPDATE PRODUCT (admin only)
     */
    public function update(Request $request, $id)
    {
        abort_unless(
            $request->user()->tokenCan('products:manage'),
            403,
            'Unauthorized'
        );

        $product = Products::findOrFail($id);
        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ], 200);
    }

    /**
     * DELETE PRODUCT (admin only)
     */
    public function destroy(Request $request, $id)
    {
        abort_unless(
            $request->user()->tokenCan('products:manage'),
            403,
            'Unauthorized'
        );

        Products::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
