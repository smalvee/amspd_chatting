<div>
    @foreach ($languages as $language)
        <a href="{{ route('language.switch', $language) }}" class="{{ $language === $currentLocale ? 'text-danger' : '' }}">
            {{ strtoupper($language) }}
        </a>
    @endforeach
</div>
