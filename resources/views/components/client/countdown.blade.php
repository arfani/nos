{{-- UNTUK WALTU LELANG --}}

@props(['endtime'])

<div class="grid grid-flow-col gap-1 text-center auto-cols-max absolute text-sm bottom-1/2 countdown-container"
    data-endtime={{ $endtime }}>
    <div class="flex flex-col p-2 bg-neutral rounded text-neutral-content">
        <span class="countdown font-mono days">
            <span style="--value:0;"></span>
        </span>
        days
    </div>
    <div class="flex flex-col p-2 bg-neutral rounded text-neutral-content">
        <span class="countdown font-mono hours">
            <span style="--value:0;"></span>
        </span>
        hours
    </div>
    <div class="flex flex-col p-2 bg-neutral rounded text-neutral-content">
        <span class="countdown font-mono minutes">
            <span style="--value:0;"></span>
        </span>
        min
    </div>
    <div class="flex flex-col p-2 bg-neutral rounded text-neutral-content">
        <span class="countdown font-mono seconds">
            <span style="--value:0;"></span>
        </span>
        sec
    </div>
</div>
