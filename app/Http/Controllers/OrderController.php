<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderProductResource;
use App\Http\Resources\OrderProductResourceCollection;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrderProductResourceCollection
     */
    public function index()
    {
        return new OrderProductResourceCollection(Order::orderByDesc('created_at')->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $data = $request->all();

        if ($request->file('custom_print_photo')) {
            $name = time() . '_' . $request->custom_print_photo->getClientOriginalName();
            $request->file('custom_print_photo')->storeAs('/custom_image', $name, 'public');
            $data['custom_print_photo'] = time() . '_' . $request->custom_print_photo->getClientOriginalName();
        }

        $order = Order::create($data);

        return new OrderProductResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderProductResource
     */
    public function show(Order $order): OrderProductResource
    {
        return new OrderProductResource($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return OrderProductResource
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'delivery_date' => 'date',
            'preparation_date' => 'date'
        ]);

        $preparation_date = $request->preparation_date;
        $delivery_date = $request->delivery_date;

        if ($preparation_date <= $order->created_at) {
            return response()->json(["status" => "error", "message" => "Hazırlanma tarixi sifariş tarixindən sonra olmalıdır"], 200);
        }
        if ($delivery_date <= $preparation_date) {
            return response()->json(["status" => "error", "message" => "Çatdırılma tarixi hazırlanma tarixindən sonra olmalıdır"], 200);
        }

        $order->update($request->all());

        return new OrderProductResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
