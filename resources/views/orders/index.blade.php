@extends('layouts.app')

@section('content')
    @component('_partials.page-layout')

        <a class="btn btn-outline-primary btn-sm" href="{{ route('orders.create') }}">{{ __('New Order') }}</a>

        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">ID</th>
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
                      <td>{{ $order->customer_name }}</td>
                      <td>{{ $order->customer_order_ref }}</td>
                      <td>{{ $order->own_order_ref }}</td>
                      <td>
                          <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">{{ __('View') }}</a>
                          <a href="{{ $order->print_url }}" class="btn btn-sm btn-outline-secondary">{{ __('Print') }}</a>
                      </td>
                  </tr>

              @endforeach
          </tbody>
        </table>

        {{ $orders->links() }}

    @endcomponent
@endsection
