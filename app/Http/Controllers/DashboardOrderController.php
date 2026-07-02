<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardOrderController extends Controller
{

    public function index()
    {

        $orders = Order::with('user')->latest()->get();

        return view('dash.showallorder', compact('orders'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', "Order #{$id} status updated to {$request->status} successfully!");
    }





    public function dashboard()
    {
        $ordersPerMonth = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = array_fill(0, 12, 0);

        $usersCount = User::count();
        $productsCount = ProductsModel::count();
        $ordersCount = Order::count();


        foreach ($ordersPerMonth as $order) {
            $data[$order->month - 1] = $order->total;
        }

        return view('dash.index', compact(
            'usersCount',
            'productsCount',
            'ordersCount',
            "labels",
            'data'
        ));
    }




    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return back()->with('success', 'Order deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
