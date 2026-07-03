<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    public function index()
    {
        $getcategory = CategoryModel::get();

        return view('dash.showallcategory', compact('getcategory'));
    }

    public function create()
    {
        return view('dash.add-category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Category_Name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $category = new CategoryModel();

        $category->name = $request->Category_Name;
        $category->is_active = $request->status === 'active' ? 1 : 0;

        if ($request->hasFile('file')) {

            $fileName = time() . '_' . uniqid() . '.' . $request->file('file')->extension();

            $path = $request->file('file')->storeAs(
                'categories',
                $fileName,
                'public'
            );

            $category->file = $path;
        }

        $category->save();

        return redirect()->back()->with('success', 'Add Category success');
    }



    public function delete($id)
    {
        $category = CategoryModel::find($id);

        if (!$category) {
            return back()->with('error', 'Category not found');
        }

        // حذف الصورة إذا موجودة
        if ($category->file && file_exists(public_path('storage/' . $category->file))) {
            unlink(public_path('storage/' . $category->file));
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }






    public function edit($id)
    {
        $category = CategoryModel::findOrFail($id);
        return view('dash.editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = CategoryModel::findOrFail($id);

        $request->validate([
            'Category_Name' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $category->name = $request->Category_Name;
        $category->is_active = $request->status === 'active' ? 1 : 0;

        if ($request->hasFile('file')) {
            // حذف الصورة القديمة إذا كانت موجودة لمنع تراكم الملفات
            if ($category->file && Storage::disk('public')->exists($category->file)) {
                Storage::disk('public')->delete($category->file);
            }

            // رفع الصورة الجديدة
            $fileName = time() . '_' . uniqid() . '.' . $request->file('file')->extension();
            $path = $request->file('file')->storeAs(
                'categories',
                $fileName,
                'public'
            );
            $category->file = $path;
        }

        $category->save();

        return redirect()->route('admin.showcategory')->with('success', 'Category updated successfully');
        // ملاحظة: تأكد من تعديل اسم الـ Route بناءً على ملف الـ web.php لديك للعودة لصفحة الجدول الأساسية
    }



    public function getcategorybyid($id = null)
    {
        if (!$id) {
            return redirect()->back();
        }

        $category = CategoryModel::with('products')->findOrFail($id);

        return view('web.category', compact('category'));
    }
}
