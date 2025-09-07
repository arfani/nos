<x-ar.modal name="modal-auction" :show="$errors->auction_update->isNotEmpty()">
    <form id="auction-form" method="post" class="p-6" {{-- jika data.id ada berarti edit mode, jika tidak mode store --}} :action="'{{ route('auction.store') }}'">
        @csrf

        {{-- INPUT ID UNTUK MENDAPATKAN old('id') pada tag form --}}
        <input type="hidden" name="id" x-bind:value="data ? data.id : '{{ old('id') }}'">

        {{-- INPUT PRODUCT ID UNTUK DISIMPAN DI AUCTION SAAT STORE MODE --}}
        <input type="hidden" name="product_id" x-bind:value="data?.product_id || '{{ old('product_id') }}'">

        <h2 class="text-lg md:text-2xl font-medium text-gray-900 dark:text-gray-100 text-center tracking-widest">
            {{ __('LELANG') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-center">
            {{ __('Lengkapi data lelang !') }}
        </p>

        <div class="mt-6">
            <h2 x-text="data?.product_name || '{{ old('product_name') }}'" class="text-xl"></h2>
            <input type="hidden" name="product_name"
                x-bind:value="data ? data.product_name : '{{ old('product_name') }}'">
        </div>

        <div class="flex flex-col gap-2 my-4">
            <x-input-label for="active" value="{{ __('Aktif') }}" class="w-fit" />
            <div class="checkbox-wrapper-51">
                {{-- <input type="hidden" value="0" name="active"> --}}
                <input id="active" type="checkbox" value="1" name="active"
                    :checked="data?.active || '{{ old('active') }}' ? true : false" />
                <label class="toggle" for="active">
                    <span>
                        <svg viewBox="0 0 10 10" height="10px" width="10px">
                            <path
                                d="M5,1 L5,1 C2.790861,1 1,2.790861 1,5 L1,5 C1,7.209139 2.790861,9 5,9 L5,9 C7.209139,9 9,7.209139 9,5 L9,5 C9,2.790861 7.209139,1 5,1 L5,9 L5,1 Z">
                            </path>
                        </svg>
                    </span>
                </label>
            </div>

        </div>

        <div class="mt-6">
            <x-input-label for="endtime" value="{{ __('Batas Waktu') }}" />
            <x-text-input name="endtime" type="datetime-local" class="mt-2" placeholder="{{ __('Batas Waktu') }}"
                x-bind:value="data?.endtime || `{{ old('endtime') }}`" {{-- tidak bisa gunakan shortcut dari x-bind (yaitu : ) disini karena menggunakan blade component, jadi pake x-bind saja --}} step="1" />
            <x-input-error :messages="$errors->auction_update->get('endtime')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="bid_start" value="{{ __('Harga Awal') }}" />
            <div class="flex mt-2">
                <span class="flex justify-center items-center p-2 border-b border-primary rounded-l font-bold">Rp</span>
                <x-text-input type="number" id="bid_start" name="bid_start" min="0"
                    class="my-input bg-primary/5 rounded-r rounded-l-none" placeholder="200000"
                    x-bind:value="data?.bid_start || `{{ old('bid_start') }}`" />
            </div>
            <x-input-error :messages="$errors->auction_update->get('bid_start')" class="mt-2" />
        </div>

        <div class="my-6">
            <x-input-label for="bid_increment" value="{{ __('Kelipatan') }}" />
            <div class="flex mt-2">
                <span class="flex justify-center items-center p-2 border-b border-primary rounded-l font-bold">Rp</span>
                <x-text-input type="number" id="bid_increment" name="bid_increment" min="0"
                    class="my-input bg-primary/5 rounded-r rounded-l-none" placeholder="10000"
                    x-bind:value="data?.bid_increment || `{{ old('bid_increment') }}`" />
            </div>
            <x-input-error :messages="$errors->auction_update->get('bid_increment')" class="mt-2" />
        </div>

        {{-- KETENTUAN --}}
        <x-input-label for="rules" value="{{ __('Ketentuan') }}" />
        <div id="toolbar" class="mt-2 rounded-t">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
            <button class="ql-link"></button>
            {{-- <button class="ql-image"></button>
            <button class="ql-video"></button> --}}
            <select class="ql-color"></select>
            <select class="ql-background"></select>
            <button class="ql-script" value="sub"></button>
            <button class="ql-script" value="super"></button>
            <button class="ql-blockquote"></button>
            <button class="ql-code-block"></button>
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
            <button class="ql-indent" value="-1"></button>
            <button class="ql-indent" value="+1"></button>
            <button class="ql-direction" value="rtl"></button>
            <select class="ql-align"></select>
            <button class="ql-clean"></button>
        </div>
        <div id="rules-editor" class="my-input rounded-b [&>.ql-editor]:min-h-52"
            x-html="data?.rules ||'{{ old('rules') }}'">
        </div>

        <input type="hidden" id="rules" name="rules">
        {{-- KETENTUAN END --}}



        <div class="mt-6 flex justify-center gap-2">
            <x-secondary-button x-on:click="$dispatch('close')" class="font-normal">
                {{ __('Cancel') }}
            </x-secondary-button>

            <div class="tooltip" data-tip="Simpan">
                <x-primary-button class="h-full flex gap-1 font-bold">
                    <i class="fa fa-save"></i> Simpan
                </x-primary-button>
            </div>
        </div>
    </form>
</x-ar.modal>

@push('scripts')
    {{-- JQUERY  --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- QUILLJS --}}
    <script src="https://cdn.quilljs.com/1.2.2/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kensnyder/quill-image-resize-module@3411c9a7/image-resize.min.js"></script>
    <script>
        $(function() {

            // INI UNTUK HANDLE QUILLJS EDITOR SAAT KEMBALI KE FORM JIKA ADA VALIDASI ERROR 
            const editor = new Quill('#rules-editor', {
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

            const form = document.querySelector('#auction-form')
            form.addEventListener('submit', function() {
                var editorContent = document.querySelector('#rules-editor .ql-editor').innerHTML;
                document.getElementById('rules').value = editorContent;
            })
        })
    </script>
@endpush

@push('styles')
    {{-- QUILLJS --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <style>
        /* .ql-toolbar {
                    background-color: oklch(var(--p));
                    color: oklch(var(--pc));
                } */

        /* STYLE OF TOGGLE ACTIVE */
        .checkbox-wrapper-51 input[type="checkbox"] {
            visibility: hidden;
            display: none;
        }

        .checkbox-wrapper-51 .toggle {
            position: relative;
            display: block;
            width: 42px;
            height: 24px;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
            transform: translate3d(0, 0, 0);
        }

        .checkbox-wrapper-51 .toggle:before {
            content: "";
            position: relative;
            top: 1px;
            left: 1px;
            width: 40px;
            height: 22px;
            display: block;
            /* background: #c8ccd4; */
            border-radius: 12px;
            transition: background 0.2s ease;
        }

        .checkbox-wrapper-51 .toggle span {
            position: absolute;
            top: 0;
            left: 0;
            width: 24px;
            height: 24px;
            display: block;
            background: oklch(var(--s));
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(154, 153, 153, 0.75);
            transition: all 0.2s ease;
        }

        .checkbox-wrapper-51 .toggle span svg {
            margin: 7px;
            fill: none;
        }

        .checkbox-wrapper-51 .toggle span svg path {
            stroke: #c8ccd4;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 24;
            stroke-dashoffset: 0;
            transition: all 0.5s linear;
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked+.toggle:before {
            background: oklch(var(--p));
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked+.toggle span {
            transform: translateX(18px);
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked+.toggle span path {
            stroke: oklch(var(--sc));
            stroke-dasharray: 25;
            stroke-dashoffset: 25;
        }
    </style>
@endpush
