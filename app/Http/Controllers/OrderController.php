<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->paginate(5);

        return view('pages.order.index', compact('orders'), ['type_menu' => '']);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        return view('pages.dashboard', ['type_menu' => '']);
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('pages.order.edit', compact('order'), ['type_menu' => '']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shipping_resi' => 'string|max:255',
            'status' => 'string|max:255',
        ]);

        $order = Order::findOrFail($id);

        $order->update($request->all());

        return redirect()->route('order.index')->with('success', 'Order updated successfully');
    }


    public function destroy($id)
    {
        $order = order::findOrFail($id);
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order deleted successfully');
    }
}
