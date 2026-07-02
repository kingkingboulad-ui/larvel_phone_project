<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
       
            $brands = Brand::all();
            return view('dash.brand', compact('brands'));
       
    }

    public function store(Request $request)
    {
       
            $request->validate([
                'name' => 'required|string|max:255',
                'is_active' => 'required|boolean',
            ]);

            Brand::create([
                'name' => $request->name,
                'is_active' => $request->is_active,
            ]);

            return redirect()->back()->with('success', 'Brand created successfully');
       
    }
    public function destroy($id)
    {
     
            $brand = Brand::findOrFail($id);
            $brand->delete();

            return redirect()->back()->with('success', 'Brand deleted successfully');
       
    }
}
