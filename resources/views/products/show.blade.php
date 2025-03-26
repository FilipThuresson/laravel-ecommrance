<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="px-4">
        <div class="w-full flex justify-between items-center">
            <span class="text-base-content">
                <h1 class="font-bold text-xl"> {{ $product->name }} </h1>
                <span>
                    <p class="text-sm">Art No: {{ $product->article_no }} | ID: {{ $product->id }} </p>
                </span>
            </span>
            <span class="flex gap-2">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('products.index') }}" class="btn btn-error">Back</a>
            </span>
        </div>

        <div class="divider"></div>

        <div class="m-6 flex">
            <div class="w-1/4">
                <h3 class="text-lg">
                    {{ $product->short_description }}
                </h3>
                <div class="divider"></div>
                <p class="text-md">
                    {{ $product->description }}
                </p>
            </div>

            <div class="w-1/2">
                <div class="carousel w-full">
                    @foreach($product->images as $idx => $image)
                        <div id="img{{ $idx }}" class="carousel-item w-full mx-6 py-6 relative">
                            <img
                                src="{{ asset('storage/' . $image->path) }}"
                                class="h-64 mx-auto" />
                            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                                <a href="#img{{ $idx == 0 ? count($product->images) - 1 : $idx - 1 }}" class="btn btn-circle">❮</a>
                                <a href="#img{{ $idx == count($product->images) - 1 ? 0 : $idx + 1 }}" class="btn btn-circle">❯</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex w-full justify-center gap-2 py-2">
                    @foreach($product->images as $idx => $image)
                        <a href="#img{{ $idx }}" class="btn btn-xs">{{ $idx + 1 }}</a>
                    @endforeach
                </div>
            </div>

            <div class="w-1/4 px-4">
                <div>
                    <h3 class="text-xl"> Inventory </h3>
                    <div>
                        @foreach($product->inventory as $inventory)
                            <div class="flex justify-between text-sm">
                                <span>{{ $inventory->location->name }}</span>
                                <span class="flex items-center gap-1 min-w-[50px] justify-end">
                                    <i class="{{ $inventory->quantity > 0 ? 'iconoir-check text-success' : 'iconoir-xmark text-error' }}"></i>
                                    <span class="w-6 text-right">{{ $inventory->quantity > 50 ? '25+' : $inventory->quantity }}</span>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="divider"></div>
                <span>
                    <div class="flex justify-between items-center">
                        <span class="text-xl">Price:</span>
                        <span class="text-md px-2">{{ $product->price }} {{ config('app.currency') }}</span>
                    </div>
                </span>
            </div>
        </div>
    </div>
</x-app-layout>
