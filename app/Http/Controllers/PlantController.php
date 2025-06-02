<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $plants = Plant::all();
        $plants = Plant::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('temperature', 'like', "%{$search}%")
                  ->orWhere('water_requirement', 'like', "%{$search}%");
        })->orderBy('name')->paginate(10);

        return view('plants.index', compact('plants', 'search'));   
    
    }

    public function exportPdf(Request $request)
    {
        $search = $request->input('search');

        $plants = Plant::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('temperature', 'like', "%{$search}%")
                         ->orWhere('water_requirement', 'like', "%{$search}%");
        })->get();

        $pdf = Pdf::loadView('plants.pdf', compact('plants'));
        return $pdf->download('plants.pdf');
    }
    

    public function create()
    {
        return view('plants.create');
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'water_requirement' => 'required|integer|between:0,255',  // integer between 0 and 255
            'temperature' => 'required|integer',                     // integer type
            'planted_date' => 'required|date',
            'price' => 'required|numeric|min:0',                     // price validation
        ]);

        Plant::create($validated);

        return redirect()->route('plants.index');
    }


    public function show(Plant $plant)
    {
        return view('plants.show', compact('plant'));
    }

    public function edit(Plant $plant)
    {
        return view('plants.edit', compact('plant'));
    }

    public function update(Request $request, Plant $plant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'water_requirement' => 'required|string|max:255',
            'temperature' => 'required|string|max:255',
            'planted_date' => 'required|date',
            'price' => 'required|numeric|min:0', // ✅ Added price validation
        ]);

        $plant->update($validated);
        return redirect()->route('plants.index');
    }

    public function delete(Plant $plant)
    {
        return view('plants.delete', compact('plant'));
    }

    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully.');
    }
}
