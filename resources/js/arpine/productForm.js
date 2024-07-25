// DATA ALPINEJS FOR FORM PRODUCT
export default () => ({
    variantMode: false,
    variants: {}, // Mulai dengan objek kosong untuk varian dinamis
    variantCombinations: [], // Array untuk menyimpan kombinasi varian
    isSubmitting: false,

    init() {
        this.$watch('variants', () => {
            this.generateCombinations();
        });

        this.$nextTick(() => {
            $("#categories").select2({
                theme: "classic",
                tags: true,
                placeholder: "Pilih kategori"
            })
            
            $("#brand").select2({
                theme: "classic",
                placeholder: "Pilih brand"
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
        })
    },
    submit(){
        this.isSubmitting = true;
        this.$el.submit();
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
});
//END ALPINEJS