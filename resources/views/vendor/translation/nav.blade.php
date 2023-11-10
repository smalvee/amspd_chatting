<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card"
        style="background-image:url(../../assets/img/icons/spot-illustrations/corner-4.png);"></div>
    <!--/.bg-holder-->
    <div class="card-body position-relative">
        <div class="row flex-between-center">
            <div class="col-md">
              <h5 class="mb-2 mb-md-0">{{ config('app.name') }}</h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('languages.index') }}" class="btn btn-falcon-primary btn-sm {{ set_active('') }}{{ set_active('/create') }}">
                    @include('translation::icons.globe')
                    {{ __('translation::translation.languages') }}
                </a>
                <a href="{{ route('languages.translations.index', config('app.locale')) }}" class="btn btn-falcon-primary btn-sm {{ set_active('*/translations') }}">
                    @include('translation::icons.translate')
                    {{ __('translation::translation.translations') }}
                </a>
            </div>
          </div>
    </div>
</div>


{{-- <nav class="header">

    <h1 class="text-lg px-6">{{ config('app.name') }}</h1>

    <ul class="flex-grow justify-end pr-2">
        <li>
            <a href="{{ route('languages.index') }}" class="{{ set_active('') }}{{ set_active('/create') }}">
                @include('translation::icons.globe')
                {{ __('translation::translation.languages') }}
            </a>
        </li>
        <li>
            <a href="{{ route('languages.translations.index', config('app.locale')) }}" class="{{ set_active('*/translations') }}">
                @include('translation::icons.translate')
                {{ __('translation::translation.translations') }}
            </a>
        </li>
    </ul>

</nav> --}}
