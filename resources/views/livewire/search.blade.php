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

    @if(($products || $users) && (count($users) + count($products) > 0))
        <div class="absolute card border-base-100 border w-full mt-2 z-1 bg-base-200">
            <div class="p-2">
                <div class="divider divider-start">Users</div>
                @if (count($users) == 0)
                    <div class="py-2 px-1 cursor-pointer bg-base-100 my-1 rounded text-center">
                        No users found
                    </div>
                @endif
                @foreach($users as $user)
                    <div class="py-2 px-1 cursor-pointer bg-base-100 my-1 rounded">
                        {{ $user->name }}
                    </div>
                @endforeach
                <div clasS="divider divider-start">Products</div>
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product->id) }}">
                        <div class="py-2 px-1 cursor-pointer bg-base-100 my-1 rounded">
                            {{ $product->name }}
                            <p class="text-xs">Art no: {{ $product->article_no }} | ID: {{ $product->id }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    @endif
</div>
