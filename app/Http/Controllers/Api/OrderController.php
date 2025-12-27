<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
