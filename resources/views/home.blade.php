@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <a class="btn btn-outline-primary btn-sm" href="{{ route('orders.create') }}">{{ __('New Order') }}</a>

        </div>
    </div>
</div>
@endsection
