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
                    method="POST" id="main">
                    @csrf
                    @isset($data)
                        @method('PUT')
                    @endisset

                    <div class="form-container flex flex-col gap-4">
                        <div class="notes">
                            <span>Catatan :</span>
                            <x-ar.required-label /> wajib diisi
                        </div>

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
                                    <div class="flex flex-col mb-4">
                                        <label for="sku" class="font-semibold mb-2">SKU</label>
                                        <input type="text" id="sku" name="sku"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('sku', isset($data) ? $data->sku : '') }}">
                                    </div>
                                </div>

                                <div class="flex gap-2 [&>div]:flex-1 flex-wrap">
                                    <div class="flex flex-col mb-4">
                                        <label for="stock" class="font-semibold mb-2">Stok</label>
                                        <input type="number" id="stock" name="stock" min="0"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('stock', isset($data) ? $data->stock : '') }}">
                                    </div>
                                    <div class="flex flex-col mb-4">
                                        <label for="price" class="font-semibold mb-2">Harga</label>
                                        <input type="number" id="price" name="price" min="0"
                                            step="1000" class="my-input bg-primary/5 rounded"
                                            value="{{ old('price', isset($data) ? $data->price : '') }}">
                                    </div>
                                    <div class="flex flex-col mb-4">
                                        <label for="weight" class="font-semibold mb-2">Berat</label>
                                        <input type="number" id="weight" name="weight" min="0"
                                            step="1000" class="my-input bg-primary/5 rounded"
                                            value="{{ old('weight', isset($data) ? $data->weight : '') }}">
                                    </div>

                                    <div class="flex flex-col mb-4 items-center">
                                        <label for="price" class="font-semibold mb-2">Status</label>
                                        <div class="flex">
                                            @include('components_custom.toggle-active-product', [
                                                'name' => 'active',
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

                        <template x-if="variantMode">
                            <div class="form-content-with-variant">
                                <div class="flex gap-2 flex-col sm:flex-row sm:items-end mb-4">
                                    <div class="flex flex-col flex-1">
                                        <label for="name" class="font-semibold mb-2">Nama Produk
                                            <x-ar.required-label />
                                        </label>
                                        <input type="text" id="name" name="name"
                                            class="my-input bg-primary/5 rounded"
                                            value="{{ old('name', isset($data) ? $data->name : '') }}" required
                                            autofocus>
                                    </div>
                                </div>

                                <div class="flex flex-col mb-4">
                                    <label for="desc" class="font-semibold mb-2">Deskripsi</label>
                                    <textarea name="desc" id="desc" rows="3" class="my-input bg-primary/5 rounded">{{ old('desc', isset($data) ? $data->desc : '') }}</textarea>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-end mb-4 mt-8">
                                    <div class="flex flex-col flex-1">
                                        <label for="variant" class="font-semibold mb-2">Tipe Varian</label>
                                        <select name="variant" id="variant" x-ref="variant">
                                            <option></option>
                                            @foreach ($variants as $item)
                                                <option value="{{ $item->variant }}">{{ $item->variant }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex justify-center mx-4">
                                        @include('components.ar.button-add-variant')
                                    </div>
                                </div>

                                <div class="flex flex-col flex-1 text-black mb-4">
                                    <select multiple="multiple" id="variant_values" x-ref="variant_values"></select>
                                </div>

                                <!-- Daftar tipe varian yang ditambahkan -->
                                <div class="variant-list mt-4">
                                    <template x-for="(values, key) in variants" :key="key">
                                        <div class="flex items-center mb-2">
                                            <div class="mr-2 p-1" x-text="key"></div>
                                            <select x-model="variants[key]" multiple="multiple"
                                                class="tipe-variant-edit mr-2 bg-gray-200 p-1 rounded"
                                                @change="editVariantValues(key, $event.target.selectedOptions)"
                                                x-init="initSelect2($el)" x-effect="updateSelect2($el, variants[key])">
                                                {{-- <template x-for="option in values" :key="option">
                                                    <option :value="option" x-text="option"></option>
                                                </template> --}}
                                            </select>
                                            <button @click="removeVariant(key)"
                                                class="bg-red-500 text-white px-2 py-1 rounded ml-2"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </template>
                                </div>

                                <div
                                    class="variant-fields-container flex flex-col border border-primary px-4 py-6 overflow-auto rounded">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Varian</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Berat</th>
                                                <th>SKU</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="combination in variantCombinations"
                                                :key="combination.join('-')">
                                                <tr class="text-center">
                                                    <td x-text="combination.join(' - ')"></td>
                                                    <td>
                                                        <input type="number" name="stock_variant[]" min="0"
                                                            class="my-input bg-primary/5 rounded w-24">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price_variant[]" min="0"
                                                            class="my-input bg-primary/5 rounded w-40">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="weight_variant[]" min="0"
                                                            class="my-input bg-primary/5 rounded">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sku_variant[]"
                                                            class="my-input bg-primary/5 rounded">
                                                    </td>
                                                    <td>
                                                        @include(
                                                            'components_custom.toggle-active-product',
                                                            ['name' => 'active_variant[]']
                                                        )
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>

                        {{-- CATEGORIES --}}
                        <div class="flex flex-col flex-1">
                            <label for="categories" class="font-semibold mb-2">Kategori</label>
                            <select name="categories[]" id="categories" multiple="multiple">
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('product.index') }}"
                                class="py-2 px-4 bg-gray-500 text-gray-50 text-center rounded">{{ __('Kembali') }}</a>
                            <button type="submit"
                                class="py-2 px-4 bg-primary text-primary-content rounded">Simpan</button>
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
                const form = document.querySelector('form#main')
                const submitBtn = document.querySelector('button[type="submit"]')

                form.addEventListener('submit', function() {
                    submitBtn.setAttribute('disabled', true)
                })

                $("#variant").select2({
                    theme: "classic",
                    tags: true,
                    allowClear: true,
                    placeholder: "Pilih varian"
                })

                $("#variant_values").select2({
                    theme: "classic",
                    tags: true,
                    placeholder: "Input nilai varian disini"
                })
                
                $("#categories").select2({
                    theme: "classic",
                    placeholder: "Pilih kategori"
                })

            })



            document.addEventListener('alpine:init', () => {
                Alpine.data('productForm', () => ({
                    variantMode: false,
                    variants: {}, // Mulai dengan objek kosong untuk varian dinamis
                    variantCombinations: [], // Array untuk menyimpan kombinasi varian

                    init() {
                        this.$watch('variants', () => {
                            this.generateCombinations();
                        });
                    },

                    addVariant() {
                        let variantKey = this.$refs.variant.value;
                        let variantValues = Array.from(this.$refs.variant_values.selectedOptions).map(
                            option => option.value);

                        if (variantKey && variantValues.length) {
                            this.variants = {
                                ...this.variants,
                                [variantKey]: variantValues
                            };

                            this.$nextTick(() => {
                                this.generateCombinations();
                            });
                        }
                    },
                    removeVariant(key) {
                        delete this.variants[key];
                        this.generateCombinations();
                    },
                    // editVariantKey(oldKey, newKey) {
                    //     if (newKey && oldKey !== newKey) {
                    //         this.variants[newKey] = this.variants[oldKey];
                    //         delete this.variants[oldKey];
                    //         this.generateCombinations();
                    //     }
                    // },
                    editVariantValues(key, selectedOptions) {
                        this.variants[key] = Array.from(selectedOptions).map(option => option.value);
                        this.generateCombinations();
                    },
                    generateCombinations() {
                        let keys = Object.keys(this.variants);
                        if (keys.length === 0) {
                            this.variantCombinations = [];
                            return;
                        }

                        let combinations = this.variants[keys[0]].map(value => [value]);

                        for (let i = 1; i < keys.length; i++) {
                            let currentKey = keys[i];
                            let currentValues = this.variants[currentKey];
                            let newCombinations = [];

                            for (let combination of combinations) {
                                for (let value of currentValues) {
                                    newCombinations.push([...combination, value]);
                                }
                            }

                            combinations = newCombinations;
                        }

                        this.variantCombinations = combinations;
                    },
                    initSelect2(el) {
                        $(el).select2({
                            theme: 'classic',
                            tags: true,
                            placeholder: 'Ubah nilai varian'
                        });
                    },
                    updateSelect2(el, options) {
                        options && $(el).empty().select2({
                            theme: 'classic',
                            tags: true,
                            placeholder: 'Ubah nilai varian',
                            data: options.map(option => ({
                                id: option,
                                text: option,
                                selected: true,
                            }))
                        });
                    }
                }));
            });
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
