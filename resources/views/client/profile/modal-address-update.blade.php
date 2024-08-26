<x-ar.modal name="address-form-update" :show="$errors->address_update->isNotEmpty()">
    <form method="post" :action="'{{ route('profile.update_address', '') }}/' + (data ? data.id : '{{ old('id') }}')"
        class="p-6 update-form">
        @csrf
        @method('PATCH')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Tambah Alamat') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ubah data alamat Anda') }}
        </p>

        <input type="hidden" name="id" x-bind:value="data ? data.id : '{{ old('id') }}'">

        <div class="mt-6">
            <x-input-label for="name" value="{{ __('Nama') }}" />
            <x-text-input name="name" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Rumah, Kantor, Kampus') }}" required x-bind:value="`{{ old('name') }}`
                !== '' ? `{{ old('name') }}` : data?.name" {{-- tidak bisa gunakan shortcut dari x-bind (yaitu : )
                disini karena menggunakan blade component, jadi pake x-bind saja --}} />
            <x-input-error :messages="$errors->address_update->get('name')" class="mt-2" />
        </div>

        <div class="flex flex-col my-4">
            <x-input-label for="address" class="mb-2" value="{{ __('Alamat') }}" />
            <textarea name="address" rows="3" class="my-input bg-primary/5 rounded"
                placeholder="Jalan kenangan no. 1001 blok A" required x-bind:value="`{{ old('address') }}`
                !== '' ? `{{ old('address') }}` : data?.address"></textarea>
            <x-input-error :messages="$errors->address_update->get('address')" class="mt-2" />
        </div>

        <div class="flex flex-col my-4">
            <x-input-label for="area_id" class="mb-2" value="{{ __('Daerah (Kecamatan/Kota/Kabupaten/Provinsi)') }}" />
            <select name="area_id" class="area_id" x-init="
            $watch('show', (value) => {
            if (value) {
                    let areaId = document.querySelector('form.update-form .area_id');

                    let option = new Option(data.area_name, data.area_id, true, true);
                    areaId.appendChild(option);
                }
        })
                    " required>
            </select>
        </div>

        <div class="mt-6">
            <x-input-label for="noteForCurrier" value="{{ __('Catatan untuk kurir') }}" />
            <x-text-input name="noteForCurrier" type="text" class="mt-1 block w-full"
                placeholder="{{ __('Depan Masjid') }}" x-bind:value="`{{ old('noteForCurrier') }}`
                !== '' ? `{{ old('noteForCurrier') }}` : data?.noteForCurrier" />
            <x-input-error :messages="$errors->address_update->get('noteForCurrier')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="recipient" value="{{ __('Penerima') }}" />
            <x-text-input name="recipient" type="text" class="mt-1 block w-full" placeholder="{{ __('Fulan') }}"
                required x-bind:value="`{{ old('recipient') }}`
                !== '' ? `{{ old('recipient') }}` : data?.recipient" />
            <x-input-error :messages="$errors->address_update->get('recipient')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="hp" value="{{ __('HP') }}" />
            <x-text-input name="hp" type="text" class="mt-1 block w-full" placeholder="{{ __('081xxx') }}" required
                x-bind:value="`{{ old('hp') }}`
                !== '' ? `{{ old('hp') }}` : data?.hp" />
            <x-input-error :messages="$errors->address_update->get('hp')" class="mt-2" />
        </div>

        <div class="mt-6 flex gap-2 items-center">
            <input type="checkbox" name="isMain" value="1" :checked="data?.isMain ? true : false" /> <label
                for="isMain">{{ __('Utama') }}</label>
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