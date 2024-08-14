<template x-if="variantMode">
    <div class="form-content-with-variant mt-4" id="variant-container">
        <div class="divider tracking-widest font-bold text-xl">VARIAN PRODUK</div>

        <div class="flex items-end mb-4 mt-8">
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
                        @click="editVariantValues(key, $event.target.selectedOptions)" x-init="initSelect2($el)"
                        x-effect="updateSelect2($el, variants[key])" :data-key="key">
                    </select>
                    <button @click="removeVariant(key)" class="bg-red-500 text-white px-2 py-1 rounded ml-2"><i
                            class="fa fa-trash"></i></button>
                </div>
            </template>
        </div>

        <div class="variant-fields-container flex flex-col border border-primary px-4 py-6 overflow-auto rounded">
            <table>
                <thead>
                    <tr>
                        <!-- Membuat header tabel dinamis berdasarkan keys dari variants -->
                        <template x-for="key in Object.keys(variants)" :key="key">
                            <th x-text="key" class="text-left"></th>
                        </template>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>SKU</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="combination in variantCombinations" :key="combination.join('-')">
                        <tr class="text-center">
                            <!-- Tampilkan nilai kombinasi dengan key -->
                            <template x-for="value in combination" :key="value">
                                <td x-text="value"></td>
                            </template>
                            <!-- Kolom tambahan untuk stok, harga, berat, SKU, dan status -->
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
                                <input type="text" name="sku_variant[]" class="my-input bg-primary/5 rounded">
                            </td>
                            <td>
                                <input id="active" type="checkbox" value="1" name="active_variant[]" />

                                {{-- @include(
                                    'components_custom.toggle-active-product',
                                    ['name' => 'active_variant[]']
                                ) --}}
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <!-- Hidden inputs for variants and variantCombinations -->
            <input type="hidden" name="variantData" :value="JSON.stringify(variants)">
            <input type="hidden" name="variantCombinationsData" :value="JSON.stringify(variantCombinations)">

        </div>
    </div>
</template>
