{{-- NOTE : $data adalah DATA PRODUK --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-base-300 text-base-content overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 product-form" x-data="productForm">
                <div class="flex flex-col items-center sm:flex-row sm:justify-between sm:items-stretch">
                    <h2 class="text-xl uppercase mb-6 font-bold">{{ isset($data) ? 'Ubah' : 'Tambah' }}
                        {{ __('Produk') }}</h2>
                    <div>
                        @include('components.ar.variant-toggle')
                    </div>
                </div>

                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 rounded-lg bg-red-300 dark:bg-gray-800 dark:text-red-400 w-fit"
                        role="alert">
                        @foreach ($errors->all() as $error)
                            <span class="font-medium block"><i
                                    class="fas fa-circle-exclamation mr-2"></i>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif

                <form action="{{ isset($data) ? route('product.update', $data) : route('product.store') }}"
                    method="POST" id="main" enctype="multipart/form-data" @submit.prevent="submit">
                    @csrf
                    @isset($data)
                        @method('PUT')
                    @endisset

                    <div class="form-container flex flex-col gap-4">
                        <x-ar.note-required-fields />

                        <template x-if="!variantMode">
                            <div class="form-content-without-variant">
                                <div class="flex flex-wrap gap-2 [&>div]:flex-1">
                                    <div class="flex flex-col mb-4">
                                        <label for="name" class="font-semibold mb-2">Nama Produk
                                            <x-ar.required-label />
                                        </label>
                                        <input type="text" id="name" name="name"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('name', isset($data) ? $data->name : '') }}" required
                                            autofocus>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <div class="flex flex-col mb-4">
                                        <label for="discount" class="font-semibold mb-2">Discount <div class="tooltip ml-1" data-tip="Promo akan aktif jika ada diskon"><i class="fa fa-circle-exclamation"></i></div></label>
                                        <input type="number" id="discount" name="discount" min="0"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('discount', isset($data) ? $data->promo->discount : 0) }}">
                                    </div>
                                    <div class="flex flex-col mb-4 flex-1">
                                        <label for="sku" class="font-semibold mb-2">SKU</label>
                                        <input type="text" id="sku" name="sku"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('sku', isset($data) ? $data->product_variant[0]->sku : '') }}">
                                    </div>
                                </div>

                                <div class="flex gap-2 [&>div]:flex-1 flex-wrap">
                                    <div class="flex flex-col mb-4">
                                        <label for="stock" class="font-semibold mb-2">Stok</label>
                                        <input type="number" id="stock" name="stock" min="0"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('stock', isset($data) ? $data->product_variant[0]->stock : 0) }}">
                                    </div>
                                    <div class="flex flex-col mb-4">
                                        <label for="price" class="font-semibold mb-2">Harga</label>
                                        <input type="number" id="price" name="price" min="0"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('price', isset($data) ? $data->product_variant[0]->price : 0) }}">
                                    </div>
                                    <div class="flex flex-col mb-4">
                                        <label for="weight" class="font-semibold mb-2">Berat</label>
                                        <input type="number" id="weight" name="weight" min="0"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('weight', isset($data) ? $data->product_variant[0]->weight : 0) }}">
                                    </div>

                                    <div class="flex flex-col mb-4 items-center">
                                        <label for="price" class="font-semibold mb-2">Status</label>
                                        <div class="flex">
                                            @include('components_custom.toggle-active-product', [
                                                'name' => 'active',
                                                'checked' => isset($data)
                                                    ? ($data->product_variant[0]->active
                                                        ? 'checked'
                                                        : '')
                                                    : 'checked',
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col">
                                    <label for="desc" class="font-semibold mb-2">Deskripsi</label>
                                    <textarea name="desc" id="desc" rows="3" class="my-input bg-primary/5 rounded">{{ old('desc', isset($data) ? $data->desc : '') }}</textarea>
                                </div>
                            </div>
                        </template>

                        {{-- MODE VARIANT --}}
                        @include('admin.product.form.variant-fields')
                        {{-- MODE VARIANT END --}}

                        {{-- CATEGORIES --}}
                        <div class="flex flex-col flex-1 text-black">
                            <label for="categories" class="font-semibold mb-2 text-base-content">Kategori</label>
                            <select name="categories[]" id="categories" multiple="multiple">
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @isset($data)
                                        @foreach ($data->category->pluck('id') as $currentCategoryId)
                                        @if ($currentCategoryId === $category->id)
                                        selected
                                        @endif
                                        @endforeach
                                        @endisset>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- BRAND --}}
                        <div class="flex flex-col flex-1 text-black">
                            <label for="brand" class="font-semibold mb-2 text-base-content">Brand</label>
                            <select name="brand" id="brand">
                                <option></option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        @isset($data)
                                        @if ($data->brand_id === $brand->id)
                                        selected
                                        @endif
                                        @endisset>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PICTURES --}}
                        <div class="flex flex-col flex-1">
                            <label for="product_pictures" class="font-semibold mb-2 text-base-content">Foto
                                Produk</label>
                            <div class="tooltip text-left w-fit" data-tip="Bisa memilih beberapa gambar">
                                <input type="file" name="product_pictures[]" id="product_pictures" multiple />
                            </div>
                        </div>
                        {{-- PICTURES PREVIEW --}}
                        <div class="flex gap-2 flex-1 flex-wrap pic-preview-container">
                        </div>
                        {{-- PICTURES PREVIEW ON EDIT --}}
                        <div class="flex gap-2 flex-1 flex-wrap pic-preview-container-on-edit">
                        </div>

                        <input type="hidden" name="deleted_pictures" id="deleted_pictures">

                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('product.index') }}"
                                class="py-2 px-4 bg-gray-500 text-gray-50 text-center rounded">{{ __('Kembali') }}</a>
                            <button type="submit"
                                :class="{ 'py-2 px-4 bg-primary text-primary-content rounded': true, 'bg-primary/25 cursor-not-allowed': isSubmitting }"
                                :disabled="isSubmitting">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(function() {
                //pictures preview
                const pictures = document.querySelector('#product_pictures')
                const deletedPicturesInput = document.querySelector('#deleted_pictures');

                let deletedPictures = [];

                // Fungsi untuk menampilkan gambar
                function displayPicture(src, id = null, containerClassname) {
                    const picPreviewContainer = document.querySelector(containerClassname)
                    const pictureWrapper = document.createElement('div');
                    pictureWrapper.classList.add('picture-wrapper');

                    const img = document.createElement('img');
                    img.src = src;
                    img.classList.add('border', 'border-primary', 'border-dashed', 'max-w-52');
                    pictureWrapper.appendChild(img);

                    if (id !== null) {
                        const removeBtn = document.createElement('button');
                        removeBtn.innerHTML = '<i class="fa fa-trash text-error"></i>';
                        removeBtn.classList.add('remove-btn');
                        removeBtn.addEventListener('click', function() {
                            picPreviewContainer.removeChild(pictureWrapper);
                            deletedPictures.push(id);
                            deletedPicturesInput.value = JSON.stringify(deletedPictures);
                        });
                        pictureWrapper.appendChild(removeBtn);
                    }

                    picPreviewContainer.appendChild(pictureWrapper);
                }

                pictures.addEventListener('change', function(e) {
                    const picPreviewContainer = document.querySelector('.pic-preview-container')
                    picPreviewContainer.innerHTML = ''

                    const files = Array.from(e.target.files);

                    // Memproses setiap file yang dipilih
                    files.forEach(file => {
                        const oFReader = new FileReader();
                        oFReader.readAsDataURL(file);

                        oFReader.onload = function(oFREvent) {
                            displayPicture(oFREvent.target.result, null, '.pic-preview-container');
                        }
                    }) //end forEach
                })

                @isset($data)
                    const currentPictures = @json($data->product_pictures);

                    currentPictures.forEach(picture => {
                        const path = '{{ Storage::url('') }}' + picture.path
                        displayPicture(path, picture.id,
                            '.pic-preview-container-on-edit'); // Pastikan properti 'path' dan 'id' benar

                    });
                @endisset
            })
        </script>
    @endpush

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2 {
                width: 100% !important;
            }
        </style>
    @endpush
</x-app-layout>
