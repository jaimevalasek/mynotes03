@if ($errors->any())
{{--    <div class="alert alert-warning">--}}
{{--        @foreach ($errors->all() as $error)--}}
{{--            <p>{{ $error }}</p>--}}
{{--        @endforeach--}}
{{--    </div>--}}

    <div class="noty_bar noty_type__error noty_theme__unify--v1 g-mb-25">
        <div class="noty_body">
            <div class="g-mr-20">
                <div class="noty_body__icon">
                    <i class="hs-admin-alert"></i>
                </div>
            </div>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    </div>

@endif

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif