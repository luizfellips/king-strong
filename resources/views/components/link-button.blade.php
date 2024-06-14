@props(['route'])

<a href="{{ $route }}">
    <button type="button" class="button-24 transition-colors text-white font-semibold rounded-md py-2 mt-5 px-4 w-full">{{ $slot }}</button>
</a>
