<div>
    @if (session()->has('message'))
        <div class="alert alert-{{ session('class-type') ?? 'dark' }}" role="alert">{{ session('message') }}</div>
    @endif
</div>
