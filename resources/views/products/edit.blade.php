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
                        <div x-data="fileUpload()" class="p-4">
                            <!-- Drag & Drop Box -->
                            <div
                                class="border-2 border-dashed p-6 text-center cursor-pointer rounded-lg"
                                @dragover.prevent
                                @drop="dropFiles($event)"
                                @click="$refs.fileInput.click()"
                            >
                                <p class="text-gray-600">Drop files here or click to select</p>
                                <input type="file" name="files[]" multiple class="hidden" x-ref="fileInput" @change="selectFiles" accept="image/*">
                            </div>
                            <span class="text-base-content/60 flex items-center gap-2 px-1 text-[0.6875rem] text-error">
                                @error('files.*')
                                <span class="status status-error inline-block"></span>
                                {{ $message }}
                                @enderror
                            </span>

                            <!-- Image Previews with Remove Button -->
                            <div class="mt-4 flex flex-wrap gap-4">
                                <template x-for="(file, index) in files" :key="index">
                                    <div class="relative w-24 h-24 border rounded-lg overflow-hidden">
                                        <img :src="file.preview" class="w-full h-full object-cover">
                                        <button
                                            @click="removeFile(index)"
                                            class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full px-2 py-1"
                                        >
                                            ✕
                                        </button>
                                    </div>
                                </template>
                            </div>
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
            function fileUpload() {
                return {
                    files: [],
                    selectFiles(event) {
                        this.updateFileInput(event.target.files);
                    },
                    dropFiles(event) {
                        this.updateFileInput(event.dataTransfer.files);
                    },
                    updateFileInput(newFiles) {
                        let fileInput = this.$refs.fileInput;
                        let dataTransfer = new DataTransfer();

                        // Preserve existing files
                        Array.from(fileInput.files).forEach(file => dataTransfer.items.add(file));

                        // Add only new unique files and generate previews
                        Array.from(newFiles).forEach(file => {
                            if (![...dataTransfer.files].some(existingFile => existingFile.name === file.name && existingFile.size === file.size)) {
                                file.preview = URL.createObjectURL(file);
                                dataTransfer.items.add(file);
                            }
                        });

                        fileInput.files = dataTransfer.files;
                        this.syncFileList();
                    },
                    removeFile(index) {
                        let fileInput = this.$refs.fileInput;
                        let dataTransfer = new DataTransfer();

                        // Remove the selected file
                        this.files.splice(index, 1);

                        // Update the file input with the remaining files
                        this.files.forEach(file => {
                            let matchingFile = Array.from(fileInput.files).find(f => f.name === file.name && f.size === file.size);
                            if (matchingFile) dataTransfer.items.add(matchingFile);
                        });

                        fileInput.files = dataTransfer.files;
                    },
                    syncFileList() {
                        this.files = Array.from(this.$refs.fileInput.files).map(file => ({
                            name: file.name,
                            size: file.size,
                            preview: URL.createObjectURL(file)
                        }));
                    }
                };
            }
        </script>
    @endpush
</x-app-layout>
