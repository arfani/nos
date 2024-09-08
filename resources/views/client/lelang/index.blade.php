<x-client-layout>
    <h2 class="text-center text-3xl uppercase font-bold tracking-wider">
        {{ $auction_data->title }} <i class="fa fa-hammer fa-flip-horizontal text-blue-500 text-2xl pb-1"></i>
    </h2>
    <p class="mt-2 mb-8 text-center">
        {{ $auction_data->description }}
    </p>
    <div class="flex flex-wrap justify-around" id="auction">
        @foreach ($auction as $product)
            <x-client.product-item :product="$product" />
        @endforeach
    </div>

    <div class="w-full text-center my-2">
        <button id="load-more" data-page="{{ $auction->currentPage() }}" data-last-page="{{ $auction->lastPage() }}">Load
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
                        url: `{{ url('lelang') }}?page=${page + 1}`,
                        method: 'GET',
                        success: function (data) {
                            $('#auction').append(data.html);
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
