<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="px-4">
        <form action="{{ route('products.store') }}" method="post">
            @csrf
            <div class="w-full flex justify-between items-center">
                <span class="flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <button class="btn btn-primary">Save & exit</button>
                </span>
                <a href="{{ route('products.index') }}" class="btn btn-error">Back</a>
            </div>
            <div class="divider"></div>
            <div x-data="{ activeTab: 1 }">
                <!-- Tab List -->
                <div class="tabs tabs-border">
                    <button
                        type="button"
                        @click="activeTab = 1"
                        :class="activeTab === 1 ? 'tab-active [--tab-bg:base-200]' : '[--tab-bg:base-300]'"
                        class="tab"
                    >
                        General info
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 2"
                        :class="activeTab === 2 ? 'tab-active [--tab-bg:base-200]' : '[--tab-bg:base-300]'"
                        class="tab"
                    >
                        Media
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 3"
                        :class="activeTab === 3 ? 'tab-active [--tab-bg:base-200]' : '[--tab-bg:base-300]'"
                        class="tab"
                    >
                        Related products
                    </button>
                </div>

                <!-- Tab Content -->
                <div class="p-4 rounded-lg bg-base-200">
                    <div x-show="activeTab === 1">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text" name="name" class="input input-bordered w-full" placeholder="Product Name">
                        </div>

                        <div class="form-control mt-2">
                            <label class="label">
                                <span class="label-text">Article No</span>
                            </label>
                            <input type="text" name="article_no" class="input input-bordered w-full" placeholder="Unique Article Number">
                        </div>

                        <div class="form-control mt-2">
                            <label class="label">
                                <span class="label-text">Price</span>
                            </label>
                            <input type="number" name="price" step="0.01" class="input input-bordered w-full" placeholder="Enter Price">
                        </div>

                        <div class="form-control mt-2">
                            <label class="cursor-pointer flex items-center gap-2">
                                <input type="checkbox" name="active" class="toggle" checked>
                                <span class="label-text">Active</span>
                            </label>
                        </div>

                        <div class="form-control mt-2">
                            <label class="label">
                                <span class="label-text">Short Description</span>
                            </label>
                            <textarea name="short_description" class="textarea textarea-bordered w-full resize-none" rows="10" placeholder="Short Summary"></textarea>
                        </div>

                        <div class="form-control mt-2">
                            <label class="label">
                                <span class="label-text">Description</span>
                            </label>
                            <textarea name="description" class="textarea textarea-bordered w-full resize-none" rows="15" placeholder="Product Description"></textarea>
                        </div>
                    </div>
                    <div x-show="activeTab === 2">

                    </div>
                    <div x-show="activeTab === 3">

                    </div>
                </div>
            </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

</x-app-layout>
