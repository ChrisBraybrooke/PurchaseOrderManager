@if ($type === 'shipping')
    <span id="same_as_billing_badge" class="badge badge-success mb-1" @if(!(isset($address) ? $address->use_billing_for_shipping : false) || (!old('use_billing_for_shipping') && old('shipping_address_line1'))) style="display:none;" @endif>{{ __('Same as billing') }}</span>
@endif

<div class="form-row">
    <div class="col">
        <div class="form-group">
            <input type="text" name="{{$type}}_address_line1" class="form-control form-control-sm {{$type}}_address_input" id="{{$type}}_address_line1" placeholder="{{ __(ucfirst($type) . " line 1") }}" value="{{ $address["{$type}_address_line1"] ?? old("{$type}_address_line1") }}" required @if(old('use_billing_for_shipping') && $type === 'shipping') disabled @endif>
            <div class="invalid-feedback">
                {{ __('Address line 1 is required.') }}
            </div>
            <div class="valid-feedback">
                {{ __('Looks good!') }}
            </div>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col">
        <div class="form-group">
            <input type="text" name="{{$type}}_address_line2" class="form-control form-control-sm {{$type}}_address_input" id="{{$type}}_address_line2" placeholder="{{ __(ucfirst($type) . " line 2") }}" value="{{ $address["{$type}_address_line2"] ?? old("{$type}_address_line2") }}" @if(old('use_billing_for_shipping') && $type === 'shipping') disabled @endif>
            <div class="invalid-feedback">
                {{--  --}}
            </div>
            <div class="valid-feedback">
                {{ __('Looks good!') }}
            </div>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col">
        <div class="form-group">
            <input type="text" name="{{$type}}_address_town" class="form-control form-control-sm {{$type}}_address_input" id="{{$type}}_address_town" placeholder="{{ __(ucfirst($type) . " town") }}" value="{{ $address["{$type}_address_town"] ?? old("{$type}_address_town") }}" required @if(old('use_billing_for_shipping') && $type === 'shipping') disabled @endif>
            <div class="invalid-feedback">
                {{ __('Address town is required.') }}
            </div>
            <div class="valid-feedback">
                {{ __('Looks good!') }}
            </div>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <input type="text" name="{{$type}}_address_county" class="form-control form-control-sm {{$type}}_address_input" id="{{$type}}_address_county" placeholder="{{ __(ucfirst($type) . " county") }}" value="{{ $address["{$type}_address_county"] ?? old("{$type}_address_county") }}" required @if(old('use_billing_for_shipping') && $type === 'shipping') disabled @endif>
            <div class="invalid-feedback">
                {{ __('Address county is required.') }}
            </div>
            <div class="valid-feedback">
                {{ __('Looks good!') }}
            </div>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col">
        <div class="form-group">
            <input type="text" name="{{$type}}_address_postcode" class="form-control form-control-sm {{$type}}_address_input" id="{{$type}}_address_postcode" placeholder="{{ __(ucfirst($type) . " postcode") }}" value="{{ $address["{$type}_address_postcode"] ?? old("{$type}_address_postcode") }}" required @if(old('use_billing_for_shipping') && $type === 'shipping') disabled @endif>
            <div class="invalid-feedback">
                {{ __('Address postcode is required.') }}
            </div>
            <div class="valid-feedback">
                {{ __('Looks good!') }}
            </div>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <input type="text" name="{{$type}}_address_country" class="form-control form-control-sm {{$type}}_address_input" id="{{$type}}_address_country" placeholder="{{ __(ucfirst($type) . " country") }}" value="{{ $address["{$type}_address_country"] ?? old("{$type}_address_country") }}" required @if(old('use_billing_for_shipping') && $type === 'shipping') disabled @endif>
            <div class="invalid-feedback">
                {{ __('Address country is required.') }}
            </div>
            <div class="valid-feedback">
                {{ __('Looks good!') }}
            </div>
        </div>
    </div>
</div>

@if ($type === 'billing')
    <div class="custom-control custom-checkbox">
        <input type="checkbox" name="use_billing_for_shipping" value="1" class="custom-control-input" id="use_billing_for_shipping" @if(old('use_billing_for_shipping')) checked @endif>
        <label class="custom-control-label" for="use_billing_for_shipping">{{ __('Use billing address for shipping?') }}</label>
    </div>
@endif


@push('scripts')
    @if ($type === 'billing')
        <script type="text/javascript">
            $('#use_billing_for_shipping').click(function() {
                $("#same_as_billing_badge").toggle(this.checked);
                $(".shipping_address_input").prop('disabled', this.checked);
            });
        </script>
    @endif
@endpush
