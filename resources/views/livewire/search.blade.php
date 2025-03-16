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
        <div class="absolute card border-base-100 border w-full mt-2">
            <div class="p-2">
                <div class="divider divider-start">Users</div>
                @foreach($results as $result)
                    <div class="py-2 px-1 cursor-pointer bg-base-100 my-1 rounded">
                        {{ $result->name }}
                    </div>
                @endforeach
                <div clasS="divider divider-start">Products</div>
            </div>

        </div>
    @endif
</div>
