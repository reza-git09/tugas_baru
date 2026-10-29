<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $request->input('total', 50000),
        ]);

        // ... setelah proses simpan order berhasil ...
        event(new OrderPlaced($order, auth()->user()));

        return back()->with('success', 'Order berhasil dibuat');
    }
}