{{-- UNTUK WALTU LELANG --}}

@props(['endtime'])

<div class="grid grid-flow-col gap-1 text-center auto-cols-max absolute text-sm bottom-3 countdown-container hover:opacity-30 transition-opacity duration-500"
    data-endtime={{ $endtime }}>
    <div class="flex flex-col p-2 bg-neutral rounded text-neutral-content">
        <span class="countdown font-mono days">
            <span style="--value:0;"></span>
        </span>
        hari
    </div>
    <div class="flex flex-col p-2 bg-neutral rounded text-neutral-content">
        <span class="countdown font-mono hours">
            <span style="--value:0;"></span>
        </span>
        jam
    </div>
    <div class="flex flex-col p-2 bg-neutral rounded text-neutral-content">
        <span class="countdown font-mono minutes">
            <span style="--value:0;"></span>
        </span>
        menit
    </div>
    <div class="flex flex-col p-2 bg-neutral rounded text-neutral-content">
        <span class="countdown font-mono seconds">
            <span style="--value:0;"></span>
        </span>
        detik
    </div>
</div>
