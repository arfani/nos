    <div class="features bg-base-200 rounded shadow-md py-10 mb-14 flex">
        <ul class="steps steps-vertical sm:steps-horizontal mx-auto">
            @foreach ($features as $item)
                <li data-content="★" class="step step-primary">
                    {{ $item->name }}
                </li>
            @endforeach
        </ul>
    </div>
