<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="px-4">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="w-full flex justify-between items-center">
                <span class="flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <button class="btn btn-primary" name="save_exit" value="1">Save & exit</button>
                </span>
                <a href="{{ route('products.index') }}" class="btn btn-error">Back</a>
            </div>
            <div class="divider"></div>
            <div x-data="{ activeTab: 1 }">
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

                <div class="p-4 rounded-lg bg-base-200">
                    <div x-show="activeTab === 1">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Name</span>
                            </label>
                            <input type="text" name="name" class="input input-bordered w-full" placeholder="Product Name" value="{{ old('name') }}">
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('name')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control mt-2">
                            <label class="label">
                                <span class="label-text">Article No</span>
                            </label>
                            <input type="text" name="article_no" class="input input-bordered w-full" placeholder="Unique Article Number" value="{{ old('article_no') }}">
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('article_no')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control mt-2">
                            <label class="label">
                                <span class="label-text">Price</span>
                            </label>
                            <input type="number" name="price" step="0.01" class="input input-bordered w-full" placeholder="Enter Price" value="{{ old('price') }}">
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('price')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control mt-2">
                            <label class="cursor-pointer flex items-center gap-2">
                                <input type="checkbox" name="active" class="toggle" @checked(old('active')) />
                                <span class="label-text">Active</span>
                            </label>
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('active')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control mt-2">
                            <label class="label">
                                <span class="label-text">Short Description</span>
                            </label>
                            <textarea name="short_description" class="textarea textarea-bordered w-full resize-none" rows="10" placeholder="Short Summary">{{ old('short_description') }}</textarea>
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('short_description')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control mt-2">
                            <label class="label">
                                <span class="label-text">Description</span>
                            </label>
                            <textarea name="description" class="textarea textarea-bordered w-full resize-none" rows="15" placeholder="Product Description">{{ old('description') }}</textarea>
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('description')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div x-show="activeTab === 2">
                        <div x-data="imageUploader()">
                            <div class="flex gap-2 mb-4">
                                <!-- Image previews with drag-and-drop -->
                                <template x-for="(image, index) in previews" :key="image.id || image.path">
                                    <div class="relative h-24 border border-base-100 rounded cursor-move"
                                         draggable="true"
                                         @dragstart="dragStart($event, index)"
                                         @dragover.prevent
                                         @drop="drop($event, index)">

                                        <img :src="image.path || image" class="w-full h-full object-cover">

                                        <!-- Remove button -->
                                        <button type="button" @click="removeImage(index, image)" class="absolute top-0 right-0 text-error p-1">
                                            <i class="iconoir-trash"></i>
                                        </button>

                                        <!-- Hidden inputs for order and ID -->
                                        <input type="hidden" name="image_orders[]" :value="index + 1">
                                        <input type="hidden" name="image_ids[]" :value="image.id || ''">
                                    </div>
                                </template>
                            </div>

                            <!-- Hidden input for removed images -->
                            <template x-for="id in removedImages" :key="id">
                                <input type="hidden" name="removed_images[]" :value="id">
                            </template>

                            <!-- File input -->
                            <input name="files[]" type="file" multiple @change="handleFileSelect" class="file-input"/>
                        </div>

                    </div>
                    <div x-show="activeTab === 3">

                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            function imageUploader() {
                return {
                    previews: [], // Stores { id, path }
                    removedImages: [], // Stores removed image IDs
                    draggedIndex: null, // Tracks dragged item index

                    handleFileSelect(event) {
                        [...event.target.files].forEach(file => {
                            let reader = new FileReader();
                            reader.onload = e => {
                                this.previews.push({ id: null, path: e.target.result });
                            };
                            reader.readAsDataURL(file);
                        });
                    },

                    removeImage(index, image) {
                        if (image.id) {
                            this.removedImages.push(image.id);
                        }
                        this.previews.splice(index, 1);
                    },

                    dragStart(event, index) {
                        this.draggedIndex = index;
                        event.dataTransfer.effectAllowed = "move";
                    },

                    drop(event, index) {
                        if (this.draggedIndex === null || this.draggedIndex === index) return;

                        // Swap positions
                        let movedItem = this.previews.splice(this.draggedIndex, 1)[0];
                        this.previews.splice(index, 0, movedItem);

                        this.draggedIndex = null;
                    }
                };
            }
        </script>
    @endpush
</x-app-layout>
