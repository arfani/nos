<x-ar.modal name="address-form-store" :show="$errors->address_store->isNotEmpty()">
    <form method="post" action="{{ route('profile.store_address') }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Tambah Alamat') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Lengkapi data alamat Anda.') }}
        </p>

        <div class="mt-6">
            <x-input-label for="name" value="{{ __('Nama') }}" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Rumah, Kantor, Kampus') }}" required value="{{ old('name') }}"
                {{-- tidak bisa gunakan shortcut dari x-bind (yaitu : ) disini karena menggunakan blade component, jadi pake x-bind saja --}} />
            <x-input-error :messages="$errors->address_store->get('name')" class="mt-2" />
        </div>

        <div class="flex flex-col my-4">
            <x-input-label for="address" class="mb-2" value="{{ __('Alamat') }}" />
            <textarea name="address" id="address" rows="3" class="my-input bg-primary/5 rounded"
                placeholder="Jalan kenangan no. 1001 blok A" required>{{ old('address') }}</textarea>
            <x-input-error :messages="$errors->address_store->get('address')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="noteForCurrier" value="{{ __('Catatan unuk kurir') }}" />
            <x-text-input id="noteForCurrier" name="noteForCurrier" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Depan Masjid') }}" value="{{ old('noteForCurrier') }}" />
            <x-input-error :messages="$errors->address_store->get('noteForCurrier')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="recipient" value="{{ __('Penerima') }}" />
            <x-text-input id="recipient" name="recipient" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Fulan') }}" required value="{{ old('recipient') }}" />
            <x-input-error :messages="$errors->address_store->get('recipient')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="hp" value="{{ __('HP') }}" />
            <x-text-input id="hp" name="hp" type="text" class="mt-1 block w-full"
                placeholder="{{ __('081xxx') }}" required value="{{ old('hp') }}" />
            <x-input-error :messages="$errors->address_store->get('hp')" class="mt-2" />
        </div>

        <div class="mt-6 flex gap-2 items-center">
            <input type="checkbox" name="isMain" id="isMain" value="1"
                :checked="data?.isMain ? true : false" /> <label for="isMain">{{ __('Utama') }}</label>
        </div>
        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <div class="tooltip" data-tip="Simpan">
                <x-primary-button class="ms-3">
                    <i class="fa fa-paper-plane"></i>
                </x-primary-button>
            </div>
        </div>
    </form>
</x-ar.modal>
