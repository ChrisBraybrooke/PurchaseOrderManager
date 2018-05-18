@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <nav class="nav flex-column">
                <a class="btn btn-primary btn-sm nav-link mb-3" href="{{ route('orders.create') }}"><span>{{ __('New Order') }}</span></a>
                <a class="btn btn-primary btn-sm nav-link mb-3" href="{{ route('orders.create') }}"><span>{{ __('New Product') }}</span></a>
                <a class="btn btn-primary btn-sm nav-link mb-3" href="{{ route('orders.create') }}"><span>{{ __('New Customer') }}</span></a>
                <a class="btn btn-primary btn-sm nav-link mb-3" href="{{ route('orders.create') }}"><span>{{ __('New Order') }}</span></a>
            </nav>
        </div>

        <div class="col-md-9">
            <div class="row pb-4">
                <div class="col-md-6">
                    <div class="border p-4">
                        <a class="font-weight-bold text-center d-block" href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border p-4">
                        <a class="font-weight-bold text-center d-block" href="{{ route('orders.index') }}">{{ __('Products') }}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="border p-4">
                        <a class="font-weight-bold text-center d-block" href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border p-4">
                        <a class="font-weight-bold text-center d-block" href="{{ route('orders.index') }}">{{ __('Products') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
