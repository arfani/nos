<x-app-layout>
    <div class="sm:mx-6 lg:mx-8 p-6 py-10 rounded overflow-x-auto">
        <div class="flex">
            <a href="{{ route('bank-account.create') }}"
                class="bg-primary text-primary-content rounded px-4 py-2 mb-4 inline-block">
                <i class="fa fa-plus"></i>
            </a>

            <span class="ml-auto mb-3">
                <form class="flex [&_option]:bg-secondary">
                    <div class="tooltip" data-tip="Data per halaman">
                        <select name="numb_per_page" class="my-input mr-2">
                            <option value="5" @if ($numb_per_page == '5') selected @endif>5
                            </option>
                            <option value="10" @if ($numb_per_page == '10') selected @endif>10
                            </option>
                            <option value="25" @if ($numb_per_page == '25') selected @endif>25
                            </option>
                            <option value="50" @if ($numb_per_page == '50') selected @endif>50
                            </option>
                            <option value="100" @if ($numb_per_page == '100') selected @endif>100
                            </option>
                        </select>
                    </div>
                    <div class="inline-block my-input whitespace-nowrap">
                        <input type="text" id="search"
                            class="border-transparent focus:outline-none focus:ring-0 focus:border-transparent bg-transparent"
                            placeholder="Cari berdasarkan nama fitur"
                            @isset($validated['name'])value="{{ $validated['name'] }}" @endisset>
                        <button type="submit"
                            class="bg-primary/70 hover:bg-primary border border-primary py-1 px-2 rounded-full cursor-pointer hover:scale-105 text-primary-content">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="table bg-base-200">
                <thead>
                <tr class="bg-base-300">
                        <th class="text-center">No</th>
                        <th>Bank Name</th>
                        <th>Bank Code</th>
                        <th>Account Number</th>
                        <th>Account Name</th>
                        <th>Is Active</th>
                        <th>Notes</th>
                        <th>Logo</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr class="odd:bg-primary/5">
                            <td class="text-center">{{ ++$indexNumber }}</td>
                            <td>{{ $item->bank_name }}</td>
                            <td>{{ $item->bank_code }}</td>
                            <td>{{ $item->account_number }}</td>
                            <td>{{ $item->account_name }}</td>
                            <td>@if ($item->is_active)
                                <div class="fa fa-check text-green-500"></div>
                            @else
                                <div class="fa fa-x text-gray-400"></div>
                                @endif</td>
                            <td>{{ $item->notes }}</td>
                            <td><img src="{{ $item->logo !== null ? Storage::url($item->logo) : asset('assets/images/image-not-found.webp') }}"
                                    alt="Logo {{ $item->name }}" width="100" /></td>
                            <td class="flex justify-evenly">
                                <div class="tooltip" data-tip="Delete">
                                    <form action="{{ route('bank-account.destroy', $item->id) }}" method="post"
                                        class="inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete"
                                            data-tooltip-target="tooltip-delete-{{ $item->id }}">
                                            <i class="fa fa-trash text-red-600"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="tooltip" data-tip="Edit">
                                    <a href="{{ route('bank-account.edit', $item->id) }}" class="mx-2"
                                        data-tooltip-target="tooltip-edit-{{ $item->id }}">
                                        <i class="fa fa-pen text-blue-600"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div
                class="[&_p]:!text-secondary-content [&_.bg-white]:bg-primary [&_.bg-white]:text-primary-content mt-10">
                {!! $data->links() !!}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            (function() {
                const deleteBtn = document.querySelectorAll('button.delete')

                deleteBtn.forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        const isDeleteConfirmed = confirm('Apakah Anda yakin ingin menghapus item ini ?')
                        // jika konfirmasi ditolak maka batalkan submit
                        if (!isDeleteConfirmed) {
                            e.preventDefault()
                        }
                    })
                })

                // UPDATE SEARCH INPUT PLACEHOLDER
                const searchInput = document.getElementById('search')
                const searchBy = document.getElementById('search-by')

                function updateSearchInpurAttr() {
                    searchInput.setAttribute('placeholder',
                        `Cari berdasarkan ${searchBy.options[searchBy.selectedIndex].text}`)
                    searchInput.setAttribute('name', searchBy.value)
                }

                updateSearchInpurAttr()
                searchBy.addEventListener('change', function() {
                    updateSearchInpurAttr()
                    searchInput.value = null
                    searchInput.focus()
                })
                // END UPDATE SEARCH INPUT PLACEHOLDER
            })()
        </script>
    @endpush
</x-app-layout>
