<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-secondary text-secondary-content overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 [&>div]:mb-2">
                    <h2 class="text-2xl uppercase mb-4">Data <b>{{$data->name}}</b></h2>

                    <div>Nama : <strong>{{$data->name}}</strong></div>
                    <div>Logo : <img src="{{Storage::url($data->logo)}}" alt="logo {{ $data->logo }}" width="150"></img></div>
                    <div>Link : <strong>{{$data->link}}</strong></div>

                    <a href="{{route('brand.index')}}" class="py-2 px-4 bg-gray-500 text-gray-50 text-center mt-6 rounded inline-block">{{__('Kembali')}}</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
        var canvas = document.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas);

        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear(); // otherwise isEmpty() might return incorrect value
        }

        window.addEventListener("resize", resizeCanvas);

        resizeCanvas();

        context = canvas.getContext('2d');

        function setImageToCanvas() {
            base_image = new Image();
            base_image.src = "{{Storage::url(isset($data) ? $data->signature : '')}}";
            base_image.onload = function() {
                context.drawImage(base_image, 0, 0);
            }
        }

        setImageToCanvas()
    </script>
</x-app-layout>