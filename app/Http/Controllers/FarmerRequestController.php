<?php

namespace App\Http\Controllers;

use App\Models\FarmerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmerRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'farmer') {
            $farmerRequests = Auth::user()->farmerRequests()->with('supplier')->latest()->get();
        } else {
            // Suppliers can see all broadcasts
            $farmerRequests = FarmerRequest::with(['user', 'supplier'])->latest()->get();
        }

        return view('farmer_requests.index', compact('farmerRequests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'farmer') {
            return redirect()->route('dashboard')->with('error', 'Only farmers can broadcast needs.');
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
            'urgency' => 'required|in:low,medium,high',
            'notes' => 'nullable|string',
        ]);

        Auth::user()->farmerRequests()->create([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'urgency' => $request->urgency,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('farmer-requests.index')->with('success', 'Your need has been broadcast successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FarmerRequest $farmerRequest)
    {
        // Only the owner can delete their request
        if (Auth::id() !== $farmerRequest->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $farmerRequest->delete();

        return redirect()->route('farmer-requests.index')->with('success', 'Broadcast removed successfully.');
    }

    /**
     * Mark the broadcast as fulfilled by a supplier.
     */
    public function fulfill(FarmerRequest $farmerRequest)
    {
        if (Auth::user()->role !== 'supplier') {
            abort(403, 'Only suppliers can fulfill broadcasts.');
        }

        $farmerRequest->update([
            'status' => 'fulfilled',
            'fulfilled_by' => Auth::id(),
        ]);

        return redirect()->route('farmer-requests.index')->with('success', 'You have marked this broadcast as fulfilled!');
    }
}
