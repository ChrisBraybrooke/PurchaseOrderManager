@extends('print-templates.layout')

@section('title')
    Print Order: {{ $order->id }} Invoice
@endsection

@section('name')
    {{ __('Invoice') }}
@endsection

@section('top-left')


@endsection

@section('top-right')
    <span class="address_line"><strong>Invoice #:</strong> {{ $order->id }}</span>
    <span class="address_line"><strong>{{ __('Purchase Order Number') }}:</strong> {{ $order->customer_order_ref }} </span>
    <span class="address_line"><strong>{{ __('Vendor Number') }}:</strong> {{ $order->own_order_ref }} </span>
    <span class="address_line"><strong>Created:</strong> {{ $order->created_at->format('d/m/y') }}</span>
    <span class="address_line"><strong>Due:</strong> {{ $order->created_at->format('d/m/y') }}</span>
@endsection

@section('shipping')
    <strong>Shipping Address</strong> <br>
    @if($order->shipping_address_line1)<span class="address_line">{{ $order->shipping_address_line1 }}</span>@endif
    @if($order->shipping_address_line2)<span class="address_line">{{ $order->shipping_address_line2 }}</span>@endif
    @if($order->shipping_address_town)<span class="address_line">{{ $order->shipping_address_town }}</span>@endif
    @if($order->shipping_address_county)<span class="address_line">{{ $order->shipping_address_county }}</span>@endif
    @if($order->shipping_address_postcode)<span class="address_line">{{ $order->shipping_address_postcode }}</span>@endif
    @if($order->shipping_address_country)<span class="address_line">{{ $order->shipping_address_country }}</span>@endif
@endsection

@section('billing')
    <strong>Billing Address</strong> <br>
    @if($order->billing_address_line1)<span class="address_line">{{ $order->billing_address_line1 }}</span>@endif
    @if($order->billing_address_line2)<span class="address_line">{{ $order->billing_address_line2 }}</span>@endif
    @if($order->billing_address_town)<span class="address_line">{{ $order->billing_address_town }}</span>@endif
    @if($order->billing_address_county)<span class="address_line">{{ $order->billing_address_county }}</span>@endif
    @if($order->billing_address_postcode)<span class="address_line">{{ $order->billing_address_postcode }}</span>@endif
    @if($order->billing_address_country)<span class="address_line">{{ $order->billing_address_country }}</span>@endif
@endsection

@section('details-row')
    <td style="padding-top: 40px" colspan="2">
        <strong>Payment Method</strong>: {{ $order->payment_method }}
    </td>
@endsection

@section('details-row-2')
    <td colspan="2">
        <strong>Email</strong>:  {{ $order->customer_email }}
    </td>
@endsection

@section('details-row-3')
    <td style="padding-bottom: 40px" colspan="2">
        <strong>Telephone</strong>: {{ $order->customer_phone }}
    </td>
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

    <td>
        Unit Price
    </td>

    <td>
        Total
    </td>
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

            <td>
                {{ ($order->cart['currency'] ?? '£') . ($item['unit_price'] ?? '') }}
            </td>

            <td>
                {{ ($order->cart['currency'] ?? '£') . ($item['total'] ?? '') }}
            </td>
        </tr>
    @endforeach
@endsection

@section('totals')
    @foreach ($order->totals ?? [] as $key => $total)
        <tr class="total @if ($loop->last) last @endif">
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $key }}: </td>
            <td>
                {{ $order->cart['currency'] ?? '£' . $total }}
            </td>
        </tr>
    @endforeach
@endsection

@section('bottom')
  <div class="ac_details" style="text-align: center;">
      Sort Code: <strong>010969</strong> Account No: <strong>61646962</strong> Account Name: <strong>Northern Albion Ltd</strong>
  </div>

@endsection
