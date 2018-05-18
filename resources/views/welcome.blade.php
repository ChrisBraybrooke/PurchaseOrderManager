@extends('layouts.app')

@section('content')

<div class="container pt-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="text-center">Purchase Order Manager</h2>
            <p class="text-center">Simple purchase order management, delivered by Northern Albion.</p>

            @auth()
                <a href="{{ route('home') }}" class="btn btn-outline-primary mt-4">{{ __('Dashboard') }}</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary mt-4">{{ __('Login') }}</a>
            @endauth
        </div>
    </div>
</div>

@endsection
