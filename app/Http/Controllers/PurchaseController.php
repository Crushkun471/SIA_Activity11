<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Plant;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userType = auth()->user()->user_type;

        // Determine which user types this user can see
        $allowedTypes = match ($userType) {
            'user' => ['user'],
            'staff' => ['user', 'staff'],
            'admin' => ['user', 'staff', 'admin'],
            default => ['user'],
        };

        $query = Purchase::with(['plant', 'customer', 'user'])
            ->whereHas('user', function ($q) use ($allowedTypes) {
                $q->whereIn('user_type', $allowedTypes);
            });

        if ($search) {
            $query->where(function ($subquery) use ($search) {
                $subquery->whereHas('plant', fn($q) =>
                    $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('customer', fn($q) =>
                    $q->where('name', 'like', "%{$search}%"));
            });
        }

        $purchases = $query->paginate(10);

        return view('purchases.index', compact('purchases', 'search'));
    }

    public function create()
    {
        $plants = Plant::all();
        $customers = Customer::all();
        return view('purchases.create', compact('plants', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $plant = Plant::findOrFail($request->plant_id);
        $price = $plant->price;
        $total = $price * $request->quantity;

        Purchase::create([
            'customer_id' => $request->customer_id,
            'plant_id' => $plant->id,
            'price' => $price,
            'quantity' => $request->quantity,
            'total' => $total,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully!');
    }

    public function show(Purchase $purchase)
    {
        return view('purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        $plants = Plant::all();
        $customers = Customer::all();
        return view('purchases.edit', compact('purchase', 'plants', 'customers'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $plant = Plant::findOrFail($validated['plant_id']);
        $price = $plant->price;
        $total = $price * $validated['quantity'];

        $purchase->update([
            'plant_id' => $validated['plant_id'],
            'customer_id' => $validated['customer_id'],
            'quantity' => $validated['quantity'],
            'price' => $price,
            'total' => $total,
        ]);

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully.');
    }

    public function exportPdf()
    {
        $userType = auth()->user()->user_type;

        $allowedTypes = match ($userType) {
            'user' => ['user'],
            'staff' => ['user', 'staff'],
            'admin' => ['user', 'staff', 'admin'],
            default => ['user'],
        };

        $purchases = Purchase::with(['plant', 'customer', 'user'])
            ->whereHas('user', function ($q) use ($allowedTypes) {
                $q->whereIn('user_type', $allowedTypes);
            })
            ->get();

        $pdf = Pdf::loadView('purchases.pdf', compact('purchases'));
        return $pdf->download('purchase_report.pdf');
    }
}
