@extends('layouts.app')

@section('content')
    @component('_partials.page-layout')

        <div class="row pb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ __('Orders') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $order->id }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row pb-4">
            <div class="col">
                <p class="mb-0 pb-0 font-weight-bold">{{ __('Order') }}</p>
                <h4 class="pt-0 mt-0 text-primary font-weight-bold">{{ $order->id }} - {{ $order->customer_name }}</h4>
            </div>
            <div class="col text-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Print') }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">{{ __('Delivery Note') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Invoice') }}</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Download') }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">{{ __('Delivery Note PDF') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Invoice PDF') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Itemised CSV') }}</a>
                    </div>
                </div>
                <a href="{{ route('orders.edit', $order) }}" class="btn btn-outline-secondary btn-sm">{{ __('Edit Order') }}</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <p><span class="font-weight-bold">Purchase Order Number: </span>{{ $order->customer_order_ref }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="font-weight-bold">Vendor Number: </span>{{ $order->own_order_ref }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <p><span class="font-weight-bold">Date: </span>{{ $order->created_at }}</p>
            </div>
            <div class="col-md-6">
                <p><span class="font-weight-bold">Customer Ref: </span>{{ $order->customer_name }}</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="border p-4">
                    <p class="font-weight-bold">Bill To:</p>
                    <p class="my-0 py-0">{{ $order->billing_address_line1 }}</p>
                    <p class="my-0 py-0">{{ $order->billing_address_line2 }}</p>
                    <p class="my-0 py-0">{{ $order->billing_address_town }}</p>
                    <p class="my-0 py-0">{{ $order->billing_address_county }}</p>
                    <p class="my-0 py-0">{{ $order->billing_address_postcode }}</p>
                    <p class="my-0 py-0">{{ $order->billing_address_country }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border p-4">
                    <p class="font-weight-bold">Delivery To: @if ($order->use_billing_for_shipping)<span class="badge badge-success">{{ __('Same as billing') }}</span>@endif</p>
                    <p class="my-0 py-0">{{ $order->shipping_address_line1 }}</p>
                    <p class="my-0 py-0">{{ $order->shipping_address_line2 }}</p>
                    <p class="my-0 py-0">{{ $order->shipping_address_town }}</p>
                    <p class="my-0 py-0">{{ $order->shipping_address_county }}</p>
                    <p class="my-0 py-0">{{ $order->shipping_address_postcode }}</p>
                    <p class="my-0 py-0">{{ $order->shipping_address_country }}</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-hover bg-white">
                    <thead>
                        <tr>
                            <th scope="col">Product Code</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                  <tbody>
                      @foreach ($order->order_info ?? [] as $key => $product)
                          <tr>
                              <td>{{ $product['code'] ?? '' }}</td>
                              <td>{{ $product['description'] ?? '' }}</td>
                              <td>{{ $product['quantity'] ?? '' }}</td>
                              <td>{{ env('SITE_CURRENCY', '£') }}{{ $product['unit_price'] ?? '' }}</td>
                              <td>{{ env('SITE_CURRENCY', '£') }}{{ $product['total'] ?? '' }}</td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
        </div>

        <div class="row py-4">
            <div class="col-md-12">
                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                  @method('DELETE')
                  @csrf

                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete order') }}</button>
                </form>
            </div>
        </div>


    @endcomponent
@endsection
