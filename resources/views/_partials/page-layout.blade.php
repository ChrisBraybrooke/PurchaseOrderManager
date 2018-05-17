<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row pb-4">
                <div class="col">
                    @component('_partials.alert')
                    @endcomponent
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger my-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </div>
    </div>
</div>
