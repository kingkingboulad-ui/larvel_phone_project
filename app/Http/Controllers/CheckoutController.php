<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        // جلب سلة المستخدم الحالي مع المنتجات
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();

        // حماية: إذا كانت السلة فارغة، نرجعه إلى صفحة السلة مع رسالة تنبيه
        // تأكد أن اسم الراوت صحيح لديك (مثلاً 'cart.index' أو الراوت الخاص بسلتك)
        if (!$cart || $cart->items->count() === 0) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $items = $cart->items;
        // حساب المجموع الإجمالي ديناميكياً من جدول المنتجات
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('web.checkout', compact('items', 'total'));
    }

    public function process(Request $request)
    {
        // التحقق من صحة البيانات المدخلة من العميل
        $request->validate([
            'phone' => 'required|string|min:7',
            'address' => 'required|string|min:10',
        ]);

        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->back()->with('error', 'No items in cart.');
        }

        // استخدام Transaction لضمان تنفيذ كل العمليات معاً أو إلغائها كاملة في حال حدوث خطأ
        DB::beginTransaction();
        try {
            $total = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);

            // 1. إنشاء الطلب الرئيسي (مطابق تماماً لـ fillable الخاص بموديل Order لديك)
            $order = Order::create([
                'user_id'     => Auth::id(),
                'phone'       => $request->phone,
                'address'     => $request->address,
                'total_price' => $total,
                'status'      => 'pending', // حالة افتراضية للطلب
                'notes'       => $request->notes ?? null
            ]);

            // 2. نقل العناصر من السلة وتثبيتها بالفاتورة (Order Items)
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $cartItem->product_id, 
                    'quantity'   => $cartItem->quantity,
                    'price'      => $cartItem->product->price, 
                ]);
            }

            $admins = User::where('role', 'admin')->get();

            // إرسال الإشعار الفوري لكل الأدمنز
            foreach ($admins as $admin) {
                $admin->notify(new NewOrderNotification($order));
            }
            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return redirect()->route('order.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            // طباعة الخطأ الفعلي لمعرفة المشكلة بالتحديد إذا فشل مجدداً
            return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::findOrFail($id);
        return view('web.success', compact('order'));
    }
}