<div class="relative {{ $width }}">
    <span class="w-full">
        <label class="input w-full">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" wire:model.live="search" required placeholder="Search"/>
        </label>
    </span>

    @if($results && count($results) > 0)
        <div class="absolute bg-white border mt-2 w-full shadow-md p-2">
            @foreach($results as $result)
                <div class="p-2 hover:bg-gray-200 cursor-pointer">
                    {{ $result->name }}
                </div>
            @endforeach
        </div>
    @endif
</div>
