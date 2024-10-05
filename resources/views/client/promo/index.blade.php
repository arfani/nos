<x-client-layout>
    <h2 class="text-center text-xl sm:text-3xl uppercase font-bold tracking-wider">
        {{ $promo_data->title }} <i class="fa fa-tags text-red-500 text-2xl pb-1"></i>
    </h2>
    <p class="text-center pt-2 mb-8">{{ $promo_data->description }}</p>

    <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-2 justify-around" id="promo">
        @foreach ($promo as $product)
        <x-client.product-item :product="$product" />
        @endforeach
    </div>

    <div id="loading" style="display: none;">Loading...</div>
    <div class="w-full text-center my-2">
        <button id="load-more" data-page="{{ $promo->currentPage() }}" data-last-page="{{ $promo->lastPage() }}">Load
            more</button>
    </div>

    <x-client.features />
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#load-more').click(function () {
                var page = $(this).data('page');
                var lastPage = $(this).data('last-page');

                if (page < lastPage) {
                    $(this).data('page', page + 1);
                    $('#loading').show();

                    $.ajax({
                        url: `${window.location.href}?page=${page + 1}`,
                        // url: `{{ url('promo') }}?page=${page + 1}`,
                        method: 'GET',
                        success: function (data) {
                            $('#promo').append(data.html);
                            $('#loading').hide();

                            if (page + 1 >= lastPage) {
                                $('#load-more').hide();
                            }
                        },
                        error: function () {
                            $('#loading').hide();
                            alert('An error occurred while loading more promo.');
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