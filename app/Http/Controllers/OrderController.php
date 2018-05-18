<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $this->validate($request, $order->getCreateRules());

        $customer_id = null;

        $order = $order->create([
            'customer_id' => $customer_id,
            'customer_name' => $request->company,
            'customer_order_ref' => $request->customer_ref,
            'own_order_ref' => $request->own_ref,
            'order_info' => $request->products,
            'shipping_cost' => $request->shipping_cost,

            'use_billing_for_shipping' => $request->has('use_billing_for_shipping') ? $request->use_billing_for_shipping : false,

            'shipping_address_line1' => $request->shipping_address_line1,
            'shipping_address_line2' => $request->shipping_address_line2,
            'shipping_address_town' => $request->shipping_address_town,
            'shipping_address_county' => $request->shipping_address_county,
            'shipping_address_postcode' => $request->shipping_address_postcode,
            'shipping_address_country' => $request->shipping_address_country,

            'billing_address_line1' => $request->billing_address_line1,
            'billing_address_line2' => $request->billing_address_line2,
            'billing_address_town' => $request->billing_address_town,
            'billing_address_county' => $request->billing_address_county,
            'billing_address_postcode' => $request->billing_address_postcode,
            'billing_address_country' => $request->billing_address_country,
        ]);

        return redirect()->route('orders.show', $order)->with('status', __("Order {$order->id} successfully created."));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->validate($request, $order->getCreateRules());

        $customer_id = null;

        $order->update([
            'customer_id' => $customer_id,
            'customer_name' => $request->company,
            'customer_order_ref' => $request->customer_ref,
            'own_order_ref' => $request->own_ref,
            'order_info' => $request->products,
            'shipping_cost' => $request->shipping_cost,

            'use_billing_for_shipping' => $request->has('use_billing_for_shipping') ? $request->use_billing_for_shipping : false,

            'shipping_address_line1' => $request->shipping_address_line1,
            'shipping_address_line2' => $request->shipping_address_line2,
            'shipping_address_town' => $request->shipping_address_town,
            'shipping_address_county' => $request->shipping_address_county,
            'shipping_address_postcode' => $request->shipping_address_postcode,
            'shipping_address_country' => $request->shipping_address_country,

            'billing_address_line1' => $request->billing_address_line1,
            'billing_address_line2' => $request->billing_address_line2,
            'billing_address_town' => $request->billing_address_town,
            'billing_address_county' => $request->billing_address_county,
            'billing_address_postcode' => $request->billing_address_postcode,
            'billing_address_country' => $request->billing_address_country,
        ]);

        return redirect()->route('orders.show', $order)->with('status', __("Order {$order->id} successfully updated."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('status', __('Order successfully deleted.'));
    }

    public function print(Request $request, Order $order)
    {
        $view_folder = 'print-templates';
        $view = "{$view_folder}/{$request->type}";

        if (view()->exists($view)) {
            if ($request->pdf) {
                $pdf = PDF::loadView($view, ['order' => $order]);
                return $pdf->download('invoice.pdf');
            }
            return view($view)->with(compact('order'));
        }
        return view('print-templates/invoice', compact('order'));
    }
}
