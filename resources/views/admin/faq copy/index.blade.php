<x-app-layout>
    <div class="py-12">
        <div class="sm:mx-6 lg:mx-8 p-6 py-10 bg-secondary text-secondary-content rounded overflow-x-auto">
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
                <a href="{{ route('faq.create') }}"
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
                        <div class="tooltip" data-tip="Cari Berdasarkan">
                            <select id="search-by" class="my-input mr-2">
                                <option value="question" @isset($validated['question']) selected @endisset>Pertanyaan
                                </option>
                                <option value="answer" @isset($validated['answer']) selected @endisset>Jawaban
                                </option>
                            </select>
                        </div>
                        <div class="inline-block my-input whitespace-nowrap">
                            <input type="text" id="search"
                                class="border-transparent focus:outline-none focus:ring-0 focus:border-transparent bg-transparent"
                                @isset($validated['question'])value="{{ $validated['question'] }}" @endisset
                                @isset($validated['answer'])value="{{ $validated['answer'] }}" @endisset>
                            <button type="submit"
                                class="bg-primary/70 hover:bg-primary border border-primary py-1 px-2 rounded-full cursor-pointer hover:scale-105 text-primary-content">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </span>
            </div>

            <table class="w-full mb-4 rounded">
                <thead>
                    <tr
                        class="text-left border-b leading-9 bg-primary text-primary-content border-b-yellow-100 [&>th]:p-2">
                        <th class="text-center">No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr
                            class="border-b odd:bg-white/5 odd:text-accent-content [&>td]:p-2 hover:bg-primary hover:text-primary-content">
                            <td class="text-center">{{ ++$indexNumber }}</td>
                            <td>{{ $item->question }}</td>
                            <td>{{ $item->answer }}</td>
                            <td class="flex justify-evenly">
                                <div class="tooltip" data-tip="Delete">
                                    <form action="{{ route('faq.destroy', $item->id) }}" method="post"
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
                                    <a href="{{ route('faq.edit', $item->id) }}" class="mx-2"
                                        data-tooltip-target="tooltip-edit-{{ $item->id }}">
                                        <i class="fa fa-pen text-blue-600"></i>
                                    </a>
                                </div>
                                <div class="tooltip" data-tip="Lihat">
                                    <a href="{{ route('faq.show', $item->id) }}"
                                        data-tooltip-target="tooltip-show-{{ $item->id }}">
                                        <i class="fa fa-eye text-teal-600"></i>
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
                    searchInput.setAttribute('placeholder', `Cari berdasarkan ${searchBy.options[searchBy.selectedIndex].text}`)
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
