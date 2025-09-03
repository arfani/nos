<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-xl uppercase mb-4 font-bold">{{ isset($data) ? 'Ubah' : 'Tambah' }} Data
                    {{ __('Bank Account') }}</h2>
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-red-700 rounded-lg bg-red-300 dark:bg-gray-800 dark:text-red-400 w-fit"
                        role="alert">
                        @foreach ($errors->all() as $error)
                            <span class="font-medium block"><i
                                    class="fas fa-circle-exclamation mr-2"></i>{{ $error }}</span>
                        @endforeach
                    </div>
                @endif
                <form action="{{ isset($data) ? route('bank-account.update', $data) : route('bank-account.store') }}" method="POST" enctype="multipart/form-data"
                    id="main">
                    @csrf

                    @isset($data)
                        @method('PUT')
                    @endisset
                    <div class="form-container flex flex-col">
                        <div class="form-content">

                            {{-- Bank Name --}}
                            <div class="flex flex-col mb-4">
                                <label for="bank_name" class="font-semibold mb-2">Bank Name</label>
                                <input type="text" id="bank_name" name="bank_name"
                                    class="my-input bg-primary/5 rounded w-fit border-transparent border-b border-b-primary 
                                           focus:ring-transparent focus:border-transparent focus:border-b-primary"
                                    value="{{ old('bank_name', $data->bank_name ?? '') }}" required autofocus>
                            </div>
                        
                            {{-- Bank Code --}}
                            <div class="flex flex-col mb-4">
                                <label for="bank_code" class="font-semibold mb-2">Bank Code</label>
                                <input type="text" id="bank_code" name="bank_code"
                                    class="my-input bg-primary/5 rounded w-fit border-transparent border-b border-b-primary 
                                           focus:ring-transparent focus:border-transparent focus:border-b-primary"
                                    value="{{ old('bank_code', $data->bank_code ?? '') }}" required>
                            </div>
                        
                            {{-- Account Number --}}
                            <div class="flex flex-col mb-4">
                                <label for="account_number" class="font-semibold mb-2">Account Number</label>
                                <input type="text" id="account_number" name="account_number"
                                    class="my-input bg-primary/5 rounded w-fit border-transparent border-b border-b-primary 
                                           focus:ring-transparent focus:border-transparent focus:border-b-primary"
                                    value="{{ old('account_number', $data->account_number ?? '') }}" required>
                            </div>
                        
                            {{-- Account Name --}}
                            <div class="flex flex-col mb-4">
                                <label for="account_name" class="font-semibold mb-2">Account Name</label>
                                <input type="text" id="account_name" name="account_name"
                                    class="my-input bg-primary/5 rounded w-fit border-transparent border-b border-b-primary 
                                           focus:ring-transparent focus:border-transparent focus:border-b-primary"
                                    value="{{ old('account_name', $data->account_name ?? '') }}" required>
                            </div>
                        
                            {{-- Is Active --}}
                            <div class="flex flex-col mb-4">
                                <label for="is_active" class="font-semibold mb-2">Status</label>
                                <select id="is_active" name="is_active"
                                    class="my-input bg-primary/5 rounded border-transparent border-b border-b-primary
                                           focus:ring-transparent focus:border-transparent focus:border-b-primary">
                                    <option value="1" @selected(old('is_active', $data->is_active ?? 1) == 1)>Aktif</option>
                                    <option value="0" @selected(old('is_active', $data->is_active ?? 1) == 0)>Non Aktif</option>
                                </select>
                            </div>
                        
                            {{-- Notes --}}
                            <div class="flex flex-col mb-4">
                                <label for="notes" class="font-semibold mb-2">Notes</label>
                                <textarea id="notes" name="notes" rows="3"
                                    class="my-input bg-primary/5 rounded border-transparent border-b border-b-primary 
                                           focus:ring-transparent focus:border-transparent focus:border-b-primary">{{ old('notes', $data->notes ?? '') }}</textarea>
                            </div>
                        
                            {{-- Logo --}}
                            <div class="flex flex-col mb-4">
                                <label for="logo" class="font-semibold mb-2">Logo</label>
                                <input type="file" id="logo" name="logo"
                                    class="my-input bg-primary/5 rounded border-transparent border-b border-b-primary 
                                           focus:ring-transparent focus:border-transparent focus:border-b-primary">
                                @if(isset($data) && $data->logo)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $data->logo) }}" alt="Logo {{ $data->bank_name }}" class="h-10">
                                    </div>
                                @endif
                            </div>
                        
                        </div>
                        

                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('bank-account.index') }}"
                                class="py-2 px-4 bg-gray-500 text-gray-50 text-center mt-6 rounded">{{ __('Kembali') }}</a>
                            <button type="submit"
                                class="py-2 px-4 bg-primary text-primary-content mt-6 rounded">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            (function() {
                const form = document.querySelector('form#main')
                const submitBtn = document.querySelector('button[type="submit"]')

                form.addEventListener('submit', function() {
                    submitBtn.setAttribute('disabled', true)
                })
            })()
        </script>
    @endpush
</x-app-layout>
