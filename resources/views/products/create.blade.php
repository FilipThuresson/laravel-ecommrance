<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div>

        <div class="w-full">
            <div x-data="{ tab: 1 }" class="p-5 flex w-9/10">
                <!-- Tabs Content -->
                <div class="flex-1">
                    <div x-show="tab === 1">
                        <h3 class="text-xl px-1">
                            Product information
                        </h3>
                        <div class="divider"></div>
                    </div>
                    <div x-show="tab === 2">
                        <h3 class="text-xl">
                            Product media
                        </h3>
                        <div class="divider"></div>
                    </div>
                    <div x-show="tab === 3">
                        <h3 class="text-xl">
                            Product description
                        </h3>
                        <div class="divider"></div>
                    </div>
                </div>

                <!-- Tab Controls -->
                <div class="flex flex-col space-y-2 items-center justify-center fixed right-1/10 top-1/2 -translate-y-1/2">
                    <button @click="tab = 1" :class="tab === 1 ? 'btn btn-accent' : 'btn'">1</button>
                    <button @click="tab = 2" :class="tab === 2 ? 'btn btn-accent' : 'btn'">2</button>
                    <button @click="tab = 3" :class="tab === 3 ? 'btn btn-accent' : 'btn'">3</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
