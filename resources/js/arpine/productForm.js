// DATA ALPINEJS FOR FORM PRODUCT
export default () => ({
    variantMode: false,
    variants: {}, // Mulai dengan objek kosong untuk varian dinamis
    variantCombinations: [], // Array untuk menyimpan kombinasi varian
    productVariants: [], // Data untuk menyimpan varian produk lengkap dengan stok, harga, berat, SKU, dll. (edit mode)
    isSubmitting: false,
    colorOptions: ['Merah', 'Biru', 'Hijau', 'Kuning', 'Putih', 'Hitam', 'Jingga', 'Ungu', 'Cokelat', 'Abuabu', 'Pink', 'Toska', 'Biru langit', 'Biru laut', 'Biru muda', 'Biru tua', 'Hijau muda', 'Hijau tua', 'Merah muda', 'Merah tua', 'Emas', 'Perak', 'Marun', 'Lavender', 'Cyan', 'Indigo', 'Lemon', 'Mocca', 'Peach', 'Olive', 'Nila', 'Amber', 'Coral'],
    sizeOptions: ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'],
    setVariantMode(mode) {
        this.variantMode = mode
    },
    setVariants(variants) {
        this.variants = JSON.parse(variants); // Parsing JSON to object
    },
    initializeProductVariants(productVariants) {
        this.productVariants = JSON.parse(productVariants);
    },
    init() {
        this.$watch('variantCombinations', (val) => {
            console.log('VARIANTS:', this.variants);
            console.log('VARIANT COMBINATION:', val);
        })

        $("#categories").select2({
            theme: "classic",
            tags: true,
            placeholder: "Pilih kategori"
        })

        $("#brand").select2({
            theme: "classic",
            placeholder: "Pilih brand"
        })

        this.$watch('variants', () => {
            this.generateCombinations();
        });

        this.$watch('variantMode', (val) => {
            if (val) {
                document.getElementById('variant-container').scrollIntoView({ behavior: 'smooth' });
            }

            new Quill('#description-editor', {
                modules: {
                    toolbar: {
                        container: '#toolbar', // Selector for toolbar container
                    },
                    imageResize: {
                        displaySize: true
                    }
                },
                theme: 'snow'
            })

            $("#variant").select2({
                theme: "classic",
                tags: true,
                allowClear: true,
                placeholder: "Pilih varian"
            }).on('change', (e) => {
                // kosongkan variant values
                $(this.$refs.variant_values).empty().trigger('change');

                // ISI VARIANT VALUES DENGAN WARNA WARNI JIKA TIPE VARIAN YANG DIPILIH ADALAH 'WARNA'
                if ($(e.target).val() == 'Warna') {
                    this.colorOptions.forEach(color => {
                        $(this.$refs.variant_values).append(new Option(color, color, false, false)).trigger('change');
                    });
                }

                // ISI VARIANT VALUES DENGAN UKURAN-UKURAN JIKA TIPE VARIAN YANG DIPILIH ADALAH 'UKURAN'
                if ($(e.target).val() == 'Ukuran') {
                    this.sizeOptions.forEach(size => {
                        $(this.$refs.variant_values).append(new Option(size, size, false, false)).trigger('change');
                    });
                }

                this.$nextTick(() => {
                    $(this.$refs.variant_values).select2('focus');
                });

            })

            $("#variant_values").select2({
                theme: "classic",
                tags: true,
                placeholder: "Input nilai varian disini"
            })

        })
    },
    submit() {
        if(this.variantMode){
            let keys = Object.keys(this.variants);
            if (keys.length === 0) { //JIKA TIDAK ADA VARIANT
                alert('Jika Anda mengaktifkan mode varian, maka tambahkan minimal 1 data varian !')
                return;
            }
        }
        
        this.isSubmitting = true;
        // set deskripsi editor ke hidden input agar ikut tersubmit form
        const editorContent = document.querySelector('#description-editor .ql-editor').innerHTML;
        document.getElementById('description').value = editorContent;
        this.$el.submit();
    },
    addVariant() {
        this.productVariants = [];
        let variantKey = this.$refs.variant.value;

        let variantValues = Array.from(this.$refs.variant_values.selectedOptions).map(
            option => option.value);

        if (!variantKey) {
            alert('Pilih tipe varian dulu!');
            this.$nextTick(() => {
                $(this.$refs.variant).select2('open'); //blm work ini
            })
            // $('#variant').select2('open');
            return
        }

        if (variantValues.length == 0) {
            alert('Buat nilai varian dulu!');
            this.$refs.variant_values.focus();
            return
        }

        if (variantKey && variantValues.length) {
            this.variants = {
                ...this.variants,
                [variantKey]: variantValues
            };

            this.$nextTick(() => {
                this.generateCombinations();
            });

            // reset select options variants
            $(this.$refs.variant_values).empty().trigger('change');
            $(this.$refs.variant).val(null).trigger('change');
        }
    },
    removeVariant(key) {
        delete this.variants[key];
        this.generateCombinations();
    },
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

        // Gabungkan key varian dengan nilai untuk membuat kombinasi yang unik
        let combinations = this.variants[keys[0]].map(value => [`${keys[0]}: ${value}`]);

        for (let i = 1; i < keys.length; i++) {
            let currentKey = keys[i];
            let currentValues = this.variants[currentKey];
            let newCombinations = [];

            for (let combination of combinations) {
                for (let value of currentValues) {
                    newCombinations.push([...combination, `${currentKey}: ${value}`]);
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
        }).on('change', (e) => {
            this.editVariantValues($(el).data('key'), e.target.selectedOptions);
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
});
//END ALPINEJS