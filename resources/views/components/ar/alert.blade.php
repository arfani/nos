{{-- ALERT SETELAH SUBMIT FORM, SUKSES ATAU ERROR --}}
@if (Session::get('success'))
    <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.500ms x-init="setTimeout(() => show = false, 5000)"
        class="toast toast-top toast-end mt-10 z-50">
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
@if (Session::get('error'))
    <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.500ms 
        x-init="setTimeout(() => show = false, 5000)" 
        class="toast toast-top toast-end mt-10 z-50">
        <div role="alert" class="alert alert-error mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ Session::get('error') }}</span>
        </div>
    </div>
@endif

{{-- ERROR VALIDASI FORM --}}
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div x-data="{ show: true }" x-show="show" x-transition:leave.duration.500ms x-init="setTimeout(() => show = false, 5000)"
            class="toast toast-top toast-end mt-10 z-50">
            <div role="alert" class="alert alert-error mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $error }}</span>
            </div>
        </div>
    @endforeach
@endif
