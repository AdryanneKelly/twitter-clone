@props(['route', 'title' => null, 'icon'])


<a href="{{ $route }}"
    class="bg-transparent hover:bg-gray-200 hover:bg-opacity-10 rounded-full p-3 pr-6 max-w-fit space-x-2">
    <div class="flex items-center space-x-4">
        <div>
            <x-dynamic-component :component="'icons.' . $icon" />

        </div>
        @if ($title)
            <div class="font-bold text-lg">
                {{ $title }}
            </div>
        @endif
    </div>
</a>
