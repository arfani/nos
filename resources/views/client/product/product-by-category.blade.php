<x-client-layout>
    <h2 class="text-center text-3xl uppercase font-bold tracking-wider">{{ __('Produk ') . '"' . $category . '"' }}</h2>
    <p class="text-center mb-8 mt-2">
        {{ __('Halaman ini hanya menampilkan produk dengan kategori ')}} <strong>"{{ $category }}"</strong></p>
    <div class="flex flex-wrap justify-around" id="products_by_category">
        @foreach ($products as $product)
        <x-client.product-item :product="$product" />
        @endforeach
    </div>

    <div id="loading" style="display: none;">Loading...</div>
    <div class="w-full text-center my-2">
        <button id="load-more" data-page="{{ $products->currentPage() }}"
            data-last-page="{{ $products->lastPage() }}">Load
            more</button>
    </div>

    <x-client.features />
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            console.log(window.location.href, 'route');
            
            $('#load-more').click(function () {
                var page = $(this).data('page');
                var lastPage = $(this).data('last-page');

                if (page < lastPage) {
                    $(this).data('page', page + 1);
                    $('#loading').show();

                    $.ajax({
                        url: `${window.location.href}?page=${page + 1}`,
                        method: 'GET',
                        success: function (data) {
                            $('#products_by_category').append(data.html);
                            $('#loading').hide();

                            if (page + 1 >= lastPage) {
                                $('#load-more').hide();
                            }
                        },
                        error: function () {
                            $('#loading').hide();
                            alert('An error occurred while loading more auction.');
                        }
                    });
                } else {
                    $('#load-more').hide();
                }
            });
        });
    </script>
    @endpush
</x-client-layout>