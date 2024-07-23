<div class="sm:mx-6 lg:mx-8">
    @if (Session::get('success'))
        <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.500ms x-init="setTimeout(() => show = false, 5000)"
            class="toast toast-top toast-end mt-10">
            <div role="alert" class="alert alert-success mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ Session::get('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex">
        <div class="tooltip" data-tip="Tambah data">
            <a href="{{ route($routeName . '.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
            </a>
        </div>

        <span class="ml-auto mb-3">
            <form class="flex [&_option]:bg-secondary" id="form_search">
                <div class="tooltip" data-tip="Data per halaman">
                    <select id="numbRows" name="numbRows" class="my-input mr-2">
                        <option value="5" @if ($numbRows == '5') selected @endif>5
                        </option>
                        <option value="10" @if ($numbRows == '10') selected @endif>10
                        </option>
                        <option value="25" @if ($numbRows == '25') selected @endif>25
                        </option>
                        <option value="50" @if ($numbRows == '50') selected @endif>50
                        </option>
                        <option value="100" @if ($numbRows == '100') selected @endif>100
                        </option>
                    </select>
                </div>
                <div class="inline-block whitespace-nowrap tooltip" data-tip="Pencarian">

                    @if (count($queryParams) === 1)
                        {{-- JIKA QUERY PARAMS (PARAMETER UNTUK SEARCH) HANYA SATU  --}}
                        <input type="text" id="search" name="{{ key($queryParams) }}" class="my-input"
                            placeholder="Cari berdasarkan {{ key($queryParams) }}"
                            @isset($validated[key($queryParams)]) value="{{ $validated[key($queryParams)] }}" @endisset>
                    @else
                        @if (count($queryParams) > 1)
                            {{-- JIKA QUERY PARAMS (PARAMETER UNTUK SEARCH) LEBIH DARI SATU  --}}
                            <div class="tooltip" data-tip="Cari">
                                <select id="search-by" class="my-input mr-2">
                                    @foreach (array_keys($queryParams) as $item)
                                        <option {{-- value="{{ $validated[$item] }}" @isset($validated[$item]) selected @endisset --}} value="{{ $item }}"
                                            @isset($validated[$item]) selected @endisset>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="inline-block my-input whitespace-nowrap">
                                <input type="text" id="search"
                                    class="border-transparent focus:outline-none focus:ring-0 focus:border-transparent bg-transparent"
                                    @foreach (array_keys($queryParams) as $item)
                                    @isset($validated[$item]) value="{{ $validated[$item] }}" @endisset 
                                    @endforeach
                                    >
                            </div>
                        @endif
                    @endif
                    <button type="submit"
                        class="bg-primary/70 hover:bg-primary btn btn-circle btn-sm hover:scale-105 text-primary-content">
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
                    @foreach ($headers as $header)
                        <th @class(['text-center' => $header === 'Aksi'])>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $rowKey => $row)
                    <tr class="odd:bg-primary/5">
                        <td>{{ ++$indexNumber }}</td>
                        @foreach ($row as $k => $cell)
                            @if ($k === 'id')
                                @continue
                            @endif

                            <td>
                                @if (isset($specialCol) && $k === $specialCol['colName'] && $specialCol['type'] === 'list')
                                    <ol class="list-decimal">
                                        @foreach ($cell as $item)
                                            <li class="border-b border-primary mb-2 pb-1">{{ $item }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    {{ $cell }}
                                @endif
                            </td>
                        @endforeach
                        <td class="flex justify-evenly gap-2">
                            @if (Route::has($routeName . '.destroy'))
                                <div class="tooltip" data-tip="Delete">
                                    <form action="{{ route($routeName . '.destroy', $row['id']) }}" method="post"
                                        class="inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete"
                                            data-tooltip-target="tooltip-delete-{{ $row['id'] }}">
                                            <i class="fa fa-trash text-red-600"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if (Route::has($routeName . '.edit'))
                                <div class="tooltip" data-tip="Edit">
                                    <a href="{{ route($routeName . '.edit', $row['id']) }}"
                                        data-tooltip-target="tooltip-edit-{{ $row['id'] }}">
                                        <i class="fa fa-pen text-blue-600"></i>
                                    </a>
                                </div>
                            @endif
                            @if (Route::has($routeName . '.show'))
                                <div class="tooltip" data-tip="Lihat">
                                    <a href="{{ route($routeName . '.show', $row['id']) }}">
                                        <i class="fa fa-eye text-teal-600"></i>
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $data->links() !!}
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
                        `Cari berdasarkan ${searchBy ? searchBy.options[searchBy.selectedIndex].text : "nama"}`)
                    searchInput.setAttribute('name', searchBy && searchBy.value)
                }

                updateSearchInpurAttr()
                searchBy && searchBy.addEventListener('change', function() {
                    updateSearchInpurAttr()
                    searchInput.value = null
                    searchInput.focus()
                })
                // END UPDATE SEARCH INPUT PLACEHOLDER

                // SUBMIT SEARCH AFTER NUMBER OF ROWS FILTER CHANGED
                const numbRows = document.getElementById('numbRows')
                const submitForm = document.getElementById('form_search')

                numbRows.addEventListener('change', function(e) {
                    submitForm.submit()
                })

            })()
        </script>
    @endpush
