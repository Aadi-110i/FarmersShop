<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Update the status of an incoming order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Verify that the logged-in user is a supplier and owns the product in the order
        if (Auth::user()->role !== 'supplier' || $order->product->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,dispatched,delivered,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order status updated to: ' . ucfirst($request->status));
    }
}
