@extends('layouts.app')

@section('content')
    @component('_partials.page-layout')


        <div class="row pb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ __('Orders') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('orders.show', $order) }}">{{ $order->id }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

        <form name="create_order" action="{{ route('orders.update', $order) }}" method="POST" class="needs-validation" novalidate autocomplete="false">

            {{ csrf_field() }}
            @method('PUT')

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="customer_name">{{ __('Customer Name') }}</label>
                        <input type="text" name="company" class="form-control form-control-sm" id="customer_name" placeholder="Evans Cycles" required value="{{ old("customer_name") ?: $order->customer_name }}">
                        <div class="invalid-feedback">
                            {{ __('Customer name is required.') }}
                        </div>
                        <div class="valid-feedback">
                            {{ __('Looks good!') }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="customer_ref">{{ __('Customer Order Ref') }}</label>
                        <input type="text" name="customer_ref" class="form-control form-control-sm" id="customer_ref" placeholder="PO084284" required value="{{ old("customer_ref") ?: $order->customer_order_ref }}">
                        <div class="invalid-feedback">
                            {{ __('Customer order ref is required.') }}
                        </div>
                        <div class="valid-feedback">
                            {{ __('Looks good!') }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="own_ref">{{ __('Own Order Ref') }}</label>
                        <input type="text" name="own_ref" class="form-control form-control-sm" id="own_ref" placeholder="V11878" required value="{{ old("own_ref") ?: $order->own_order_ref }}">
                        <div class="invalid-feedback">
                            {{ __('Own orders order is required.') }}
                        </div>
                        <div class="valid-feedback">
                            {{ __('Looks good!') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row my-4">
                <div class="col-md-6">
                    <div class="border p-3">
                        @component('_partials.address-form', ['type' => 'billing', 'address' => $order])

                        @endcomponent
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="border p-3">
                        @component('_partials.address-form', ['type' => 'shipping', 'address' => $order])

                        @endcomponent
                    </div>
                </div>
            </div>


            <div class="mt-4">
                <product-add-component :existing-products="{{ $order->order_info ?: collect([]) }}" />
            </div>

            <button type="submit" class="btn btn-outline-success btn-sm mt-5">{{ __('Save Order') }}</button>

        </form>

    @endcomponent
@endsection
