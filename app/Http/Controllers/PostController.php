<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CategoryModel;
use App\Models\ProductsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $product = ProductsModel::paginate(10);
        return view('dash.showproduct', compact('product'));
    }


    public function create()
    {

        $categories = CategoryModel::pluck('name', 'id');
        $brand = Brand::get();
        return view('dash.add-product', compact('categories',  "brand"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = new ProductsModel();

        $product->title = $request->title;

        $product->description = $request->description;
        $product->price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->is_featured = $request->is_featured;
        $product->category_id = $request->category_id;

        // image upload
        if ($request->hasFile('image')) {

            $fileName = time() . '_' . uniqid() . '.' . $request->file('image')->extension();

            $path = $request->file('image')->storeAs(
                'products',
                $fileName,
                'public'
            );

            $product->image = $path;
        }

        $product->save();

        return back()->with('success', 'Product added successfully');
    }

    public function filter(Request $request)
    {
        $products = ProductsModel::query();

        // Filter by category
        if ($request->filled('category')) {
            $products->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $products->whereIn('brand_id', $request->brand);
        }

        // Filter by minimum price
        if ($request->filled('min_price')) {
            $products->where('price', '>=', $request->min_price);
        }

        // Filter by maximum price
        if ($request->filled('max_price')) {
            $products->where('price', '<=', $request->max_price);
        }

        // Sort
        switch ($request->sort) {

            case 'price_asc':
                $products->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $products->orderBy('price', 'desc');
                break;

            case 'featured':
                $products->orderBy('is_featured', 'desc');
                break;

            default:
                $products->latest();
                break;
        }

        $products = $products->paginate(12)->withQueryString();

        $categories = CategoryModel::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('web.allproduct', compact('products', 'categories', 'brands'));
    }










    public function edit($id)
    {
        $product = ProductsModel::findOrFail($id);

        $categories = CategoryModel::pluck('name', 'id');
        $brand = Brand::all();

        return view('dash.editproduct', compact('product', 'categories', 'brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = ProductsModel::findOrFail($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->is_featured = $request->is_featured;

        if ($request->hasFile('image')) {


            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $fileName = time() . '_' . uniqid() . '.' . $request->image->extension();

            $path = $request->image->storeAs(
                'products',
                $fileName,
                'public'
            );

            $product->image = $path;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = ProductsModel::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
