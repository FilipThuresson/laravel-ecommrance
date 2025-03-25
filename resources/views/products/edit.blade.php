<x-app-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="px-4">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="w-full flex justify-between items-center">
                <span class="flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <button class="btn btn-primary">Save & exit</button>
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
                            <input type="text" name="name" class="input input-bordered w-full" placeholder="Product Name" value="{{ old('name', $product->name) }}">
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
                            <input type="text" name="article_no" class="input input-bordered w-full" placeholder="Unique Article Number" value="{{ old('article_no', $product->article_no) }}">
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
                            <input type="number" name="price" step="0.01" class="input input-bordered w-full" placeholder="Enter Price" value="{{ old('price', $product->price) }}">
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('price')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-control mt-2">
                            <label class="cursor-pointer flex items-center gap-2">
                                <input type="checkbox" name="active" class="toggle" @checked(old('active', $product->active)) />
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
                            <textarea name="short_description" class="textarea textarea-bordered w-full resize-none" rows="10" placeholder="Short Summary">{{ old('short_description', $product->short_description) }}</textarea>
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
                            <textarea name="description" class="textarea textarea-bordered w-full resize-none" rows="15" placeholder="Product Description">{{ old('description', $product->description) }}</textarea>
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('description')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div x-show="activeTab === 2">
                        <div x-data="imageUploader({ images: {{ \Illuminate\Support\Js::from($product->images->map(fn($img) => [
                            'id' => $img->id,
                            'path' => asset('storage/' . $img->path)
                        ])) }} })">

                            <div class="flex gap-2 mb-4">
                                <template x-for="(image, index) in previews" :key="image.id || image.path">
                                    <div class="relative h-24 border border-base-100 rounded cursor-move"
                                         draggable="true"
                                         @dragstart="dragStart($event, index)"
                                         @dragover="dragOver($event)"
                                         @drop="drop($event, index)">

                                        <img :src="image.path || image" class="w-full h-full object-cover">

                                        <button type="button" @click="removeImage(index, image)" class="absolute top-0 right-0 text-error p-1">
                                            <i class="iconoir-trash"></i>
                                        </button>

                                        <input type="hidden" name="image_orders[]" :value="image.order">
                                        <input type="hidden" name="image_ids[]" :value="image.id || ''">
                                    </div>
                                </template>
                            </div>

                            <template x-for="id in removedImages" :key="id">
                                <input type="hidden" name="removed_images[]" :value="id">
                            </template>

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
            function imageUploader({ images = [] }) {
                return {
                    previews: images.map((img, index) => ({
                        id: img.id,
                        path: img.path,
                        order: index + 1  // Ensure order is assigned from the start
                    })),
                    removedImages: [],
                    draggedImage: null,

                    handleFileSelect(event) {
                        [...event.target.files].forEach((file) => {
                            let reader = new FileReader();
                            reader.onload = e => {
                                this.previews.push({
                                    id: null,
                                    path: e.target.result,
                                    order: this.previews.length + 1 // Assign order dynamically
                                });
                                this.updateOrder(); // Ensure correct order after adding
                            };
                            reader.readAsDataURL(file);
                        });
                    },

                    removeImage(index, image) {
                        if (image.id) {
                            this.removedImages.push(image.id);
                        }
                        this.previews.splice(index, 1);
                        this.updateOrder(); // Recalculate order after removal
                    },

                    updateOrder() {
                        this.previews = this.previews.map((image, index) => ({
                            ...image,
                            order: index + 1 // Ensure order starts at 1
                        }));
                    },

                    dragStart(event, index) {
                        this.draggedImage = this.previews[index];
                        event.dataTransfer.effectAllowed = "move";
                    },

                    dragOver(event) {
                        event.preventDefault(); // Allow drop
                    },

                    drop(event, index) {
                        event.preventDefault();
                        if (this.draggedImage) {
                            let draggedIndex = this.previews.findIndex(img => img === this.draggedImage);

                            // Remove dragged image and reinsert at new position
                            this.previews.splice(draggedIndex, 1);
                            this.previews.splice(index, 0, this.draggedImage);

                            this.updateOrder();
                            this.draggedImage = null;
                        }
                    }
                };
            }
        </script>
    @endpush
</x-app-layout>
