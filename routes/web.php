<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardOrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Models\CategoryModel;
use App\Models\ProductsModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $product = ProductsModel::where('is_featured', 1)->paginate(10);
    $category = CategoryModel::where('is_active', "1")->get();
    return view('web.index', compact('category', 'product'));
})->name("index")->middleware('auth');


// Route::get("/myorder", function () {
//     return view("web.MyOrders");
// })->name('myorder');






Route::get("/latestproduct", function () {
    $products = ProductsModel::orderBy('created_at', 'desc')
        ->take(10)
        ->get();
    return view("web.LatestPhones",compact('products'));
})->name("latestproduct")->middleware('auth');




Route::get("/about", function () {
    return view("web.about");
})->name("about")->middleware('auth');




Route::get('admin/notification', function () {
    return view('dash.notifications');
})->name('notification')->middleware('auth');





Route::get('/all-product', [PostController::class, 'filter'])->name('products.filter')->middleware('auth');

Route::get('/category/{id?}',[categoryController::class,'getcategorybyid'])->name("cat.get")->middleware('auth');


Route::middleware(['auth', "role:admin"])->group(function () {
    // Route::get('/admin', function () {
    //     return view('dash.index');
    // })->name('admin');


    Route::get('/admin', [DashboardOrderController::class, 'dashboard'])->name('admin');


    Route::get("/admin/add-category", [categoryController::class, 'create'])->name('admin.category');
    Route::get("/admin/show-category", [categoryController::class, 'index'])->name('admin.showcategory');
    Route::post("/admin/add-category", [categoryController::class, 'store'])->name("stor.category");
    Route::get('/category', [categoryController::class, 'index'])->name('admin.category.index');


    Route::get('admin/category/edit/{id}', [categoryController::class, 'edit'])->name('admin.category.edit');


    Route::put('admin/category/update/{id}', [categoryController::class, 'update'])->name('admin.category.update');


    Route::delete("/admin/delete/{id}", [categoryController::class, 'delete'])->name("delete.category");





    Route::get("/admin/show-post", [PostController::class, 'index'])->name("show.post");

    Route::get("/admin/add-post", [PostController::class, 'create'])->name("admin.post");
    Route::post("/admin/add-post", [PostController::class, 'store'])->name("admin.addpost");





    Route::get('admin/post/edit/{id}', [PostController::class, 'edit'])->name('product.edit');

    Route::put('/post/update/{id}', [PostController::class, 'update'])->name('product.update');

    Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->name('product.delete');




    Route::post('/admin/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/admin/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::delete('admin/brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');












    Route::delete('/admin/notifications/{id}', function ($id) {
        // العثور على الإشعار التابع للمستخدم الحالي وحذفه
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 44);
    });
























    Route::delete('/admin/notifications/delete-all', function () {
        auth()->user()->notifications()->delete();
        return response()->json(['success' => true]);
    });
});



Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}', [AddToCartController::class, 'add'])
        ->name('cart.add');


    Route::get('/myorder', [AddToCartController::class, 'index'])
        ->name('cart.index');




    Route::delete('/cart/item/{id}', [AddToCartController::class, 'deleteCartItem'])
        ->name('cart.item.delete');




    Route::get('/My-request', [AddToCartController::class, 'myOrders'])
        ->name('cart.request');

    Route::middleware('auth')->group(function () {

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');


        Route::get('/order-success/{id}', [CheckoutController::class, 'success'])->name('order.success');










        Route::get('/admin/orders', [DashboardOrderController::class, 'index'])->name('dash.orders.index');
        Route::delete('/admin/orders/{id}', [DashboardOrderController::class, 'destroy'])->name("dash.orders.destroy");
        Route::patch('/dash/orders/{id}/update-status', [DashboardOrderController::class, 'updateStatus'])->name('dash.orders.updateStatus');
    });
});






Route::get('/contact', [ContactController::class, 'create'])->name('contact.create')->middleware('auth');

Route::get('admin/get-contact', [ContactController::class, 'index'])->name('contact.get')->middleware('auth');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('auth');

Route::delete('/admin/contact/{id}', [ContactController::class, 'destroy'])
    ->name('delete.contact')->middleware('auth');














Route::middleware('auth')->group(function(){

    Route::get('/admin/settings', [SettingController::class,'edit'])->name('settings.edit');
Route::post('/admin/settings', [SettingController::class,'update'])->name('settings.update');

});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});













Route::fallback(function(){
   return view('web.notfound');
});


















require __DIR__ . '/auth.php';
