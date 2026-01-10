<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * CREATE NEW ORDER (CHECKOUT)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'customer_phone'   => 'required|string|max:20',
            'delivery_address' => 'required|string',
            'products'         => 'required|array',
            'total_amount'     => 'required|numeric',
            'currency'         => 'nullable|string|max:10',
        ]);

        $order = Order::create([
            'user_id'          => $request->user()->id,
            'customer_name'    => $validated['customer_name'],
            'customer_email'   => $validated['customer_email'],
            'customer_phone'   => $validated['customer_phone'],
            'delivery_address' => $validated['delivery_address'],
            'products'         => $validated['products'],
            'total_amount'     => $validated['total_amount'],
            'currency'         => $validated['currency'] ?? 'LKR',
            'status'           => 'pending',
        ]);

        return response()->json([
            'message' => 'Order placed successfully',
            'order'   => $order
        ], 201);
    }

    /**
     * DELETE ORDER (ADMIN ONLY)
     */
    public function destroy(Request $request, $id)
    {
        abort_unless(
            $request->user()->tokenCan('products:manage'),
            403,
            'Unauthorized'
        );

        Order::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Order deleted successfully'
        ]);
    }
}
