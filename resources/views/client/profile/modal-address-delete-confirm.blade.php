<x-ar.modal name="confirm-address-deletion">
    <form method="post" :action="'{{ route('profile.destroy_address', '') }}/' + data?.id" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Hapus alamat ?') }}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Hapus') }}
            </x-danger-button>
        </div>
    </form>
</x-ar.modal>
