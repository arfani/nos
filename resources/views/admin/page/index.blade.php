<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-xl uppercase mb-4 font-bold">Halaman {{ $form_name }}</h2>
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 rounded-lg bg-red-300 dark:bg-gray-800 dark:text-red-400 w-fit"
                        role="alert">
                        @foreach ($errors->all() as $error)
                            <span class="font-medium block"><i
                                    class="fas fa-circle-exclamation mr-2"></i>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif
                <form action="{{ $update_route }}" method="POST" id="main">
                    @csrf
                    @method('PATCH')

                    <div class="form-container flex flex-col">
                        <div class="form-content">
                            <div class="flex flex-col mb-4">
                                <label for="title" class="font-semibold mb-2">Judul</label>
                                <input type="text" id="title" name="title"
                                    class="my-input bg-primary/5 rounded w-fit border-transparent border-b border-b-primary 
            focus:ring-transparent focus:border-transparent focus:border-b-primary"
                                    value="{{ old('title', $data->title) }}" required autofocus>
                            </div>

                            <div id="toolbar">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-video"></button>
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
                            <div id="editor" class="bg-white text-black [&>.ql-editor]:min-h-52">
                                {!! $data->content !!}
                            </div>

                            <input type="hidden" id="content" name="content">
                        </div>

                        <div class="">
                            <button type="submit"
                                class="w-full py-2 px-4 bg-primary text-primary-content mt-6 rounded">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
        <style>
            .ql-toolbar {
                background-color: ghostwhite
            }
        </style>
    @endpush
    @push('scripts')
        <script src="https://cdn.quilljs.com/1.2.2/quill.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/kensnyder/quill-image-resize-module@3411c9a7/image-resize.min.js"></script>
        <script>
            (function() {
                const form = document.querySelector('form#main')
                const submitBtn = document.querySelector('button[type="submit"]')

                form.addEventListener('submit', function() {
                    submitBtn.setAttribute('disabled', true)

                    var editorContent = document.querySelector('#editor .ql-editor').innerHTML;
                    document.getElementById('content').value = editorContent;
                })

                const editor = new Quill('#editor', {
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

            })()
        </script>
    @endpush
</x-app-layout>
