<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\User;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


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

        $order->update([
            'status' => $request->status,
            'shipping_resi' => $request->shipping_resi,
        ]);

        if ($request->status == 'on_delivery') {
            $this->sendNotificationToUser($order->first()->user_id, 'Paket dikirim dengan nomor resi ini: ' . $request->shipping_resi);
        }

        return redirect()->route('order.index')->with('success', 'Order updated successfully');
    }


    public function destroy($id)
    {
        $order = order::findOrFail($id);
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order deleted successfully');
    }

    public function sendNotificationToUser($userId, $message)
    {
        // Dapatkan FCM token user dari tabel 'users'
        $user = User::find($userId);
        $token = $user->fcm_id;

        // Kirim notifikasi ke perangkat Android
        $messaging = app('firebase.messaging');
        $notification = Notification::create('Apple Store', $message);

        $message = CloudMessage::withTarget('token', $token)
            ->withNotification($notification);

        $messaging->send($message);
    }
}
