@extends('print-templates.layout')

@section('title')
    Print Order: {{ $order->id }} Delivery Note
@endsection

@section('name')
    {{ __('Delivery Note') }}
@endsection

@section('top-left')
    <strong>{{ __('Delivery To') }}</strong> <br>
    @if($order->shipping_address_line1)<span class="address_line">{{ $order->shipping_address_line1 }}</span>@endif
    @if($order->shipping_address_line2)<span class="address_line">{{ $order->shipping_address_line2 }}</span>@endif
    @if($order->shipping_address_town)<span class="address_line">{{ $order->shipping_address_town }}</span>@endif
    @if($order->shipping_address_county)<span class="address_line">{{ $order->shipping_address_county }}</span>@endif
    @if($order->shipping_address_postcode)<span class="address_line">{{ $order->shipping_address_postcode }}</span>@endif
    @if($order->shipping_address_country)<span class="address_line">{{ $order->shipping_address_country }}</span>@endif

    <hr style="margin-bottom: 10px; margin-top: 10px">

    <span class="address_line"><strong>{{ __('Purchase Order Number') }}:</strong> {{ $order->customer_order_ref }} </span>
    <span class="address_line"><strong>{{ __('Vendor Number') }}:</strong> {{ $order->own_order_ref }} </span>
    <span class="address_line"><strong>{{ __('Customer Ref') }}:</strong> {{ $order->customer_name }} </span>
    <span class="address_line"><strong>{{ __('Date') }}:</strong> {{ $order->created_at->Format('d/m/y') }} </span>
@endsection

@section('top-right')
    <span class="address_line"><strong>{{ __('Purchase Order Number') }}:</strong> {{ $order->customer_order_ref }} </span>
    <span class="address_line"><strong>{{ __('Vendor Number') }}:</strong> {{ $order->own_order_ref }} </span>
    <span class="address_line"><strong>{{ __('Customer Ref') }}:</strong> {{ $order->customer_name }} </span>
    <span class="address_line"><strong>{{ __('Date') }}:</strong> {{ $order->created_at->Format('d/m/y') }} </span>
@endsection


@section('product-headings')
    <td>
        Code
    </td>

    <td>
        Description
    </td>

    <td>
        Quantity
    </td>
@endsection

@section('products-spacer')
<div style="height: 200px;">

</div>
@endsection

@section('products')
    @foreach ($order->order_info as $key => $item)
        <tr class="item @if ($loop->last) last @endif">
            <td>
                {{ $item['code'] ?? '' }}
            </td>

            <td>
                {{ $item['description'] ?? '' }}
            </td>

            <td>
                {{ $item['quantity'] ?? '' }}
            </td>
        </tr>
    @endforeach
@endsection
