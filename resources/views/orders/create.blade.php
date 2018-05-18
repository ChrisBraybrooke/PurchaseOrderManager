@extends('layouts.app')

@section('content')
    @component('_partials.page-layout')

            <div class="row pb-4">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ __('Orders') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('New Order') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row pb-4">
                <div class="col">
                    <p class="mb-0 pb-0 font-weight-bold">{{ __('New') }}</p>
                    <h4 class="pt-0 mt-0 text-primary font-weight-bold">{{ __('Order') }}</h4>
                </div>
            </div>


            <form name="create_order" action="{{ route('orders.store') }}" method="POST" class="needs-validation" novalidate autocomplete="false">

                {{ csrf_field() }}

                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="customer_name">{{ __('Customer Name') }}</label>
                            <input type="text" name="company" class="form-control form-control-sm" id="customer_name" placeholder="Evans Cycles" required>
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
                            <input type="text" name="customer_ref" class="form-control form-control-sm" id="customer_ref" placeholder="PO084284" required>
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
                            <input type="text" name="own_ref" class="form-control form-control-sm" id="own_ref" placeholder="V11878" required>
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
                            @component('_partials.address-form', ['type' => 'billing'])

                            @endcomponent
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border p-3">
                            @component('_partials.address-form', ['type' => 'shipping'])

                            @endcomponent
                        </div>
                    </div>
                </div>


                <div class="mt-4">
                    <product-add-component />
                </div>

                <button type="submit" class="btn btn-outline-success btn-sm mt-5">{{ __('Create Order') }}</button>

            </form>

    @endcomponent
@endsection


@push('scripts')
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>
@endpush
