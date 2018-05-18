@extends('layouts.app')

@section('content')
    @component('_partials.page-layout')

        <a class="btn btn-outline-primary btn-sm" href="{{ route('orders.create') }}">{{ __('New Order') }}</a>

        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Customer Order Ref</th>
                    <th scope="col">Own Order Ref</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
          <tbody>
              @foreach ($orders as $key => $order)

                  <tr>
                      <td>{{ $order->id }}</td>
                      <td>{{ $order->created_at->format('d/m/y') }}</td>
                      <td>{{ $order->customer_name }}</td>
                      <td>{{ $order->customer_order_ref }}</td>
                      <td>{{ $order->own_order_ref }}</td>
                      <td>
                          <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">{{ __('View') }}</a>
                          <div class="btn-group">
                              <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  {{ __('Print') }}
                              </button>
                              <div class="dropdown-menu">
                                  <print-order-button :order="{{ $order->toJson() }}" type="delivery-note">
                                      <a slot-scope="props" @click="props.print" class="dropdown-item">{{ __('Delivery Note') }}</a>
                                  </print-order-button>
                                  <print-order-button :order="{{ $order->toJson() }}" type="invoice">
                                      <a slot-scope="props" @click="props.print" class="dropdown-item">{{ __('Invoice') }}</a>
                                  </print-order-button>
                              </div>
                          </div>
                      </td>
                  </tr>

              @endforeach
          </tbody>
        </table>

        {{ $orders->links() }}

    @endcomponent
@endsection
