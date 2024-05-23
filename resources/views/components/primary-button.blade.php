<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary text-primary-content hover:bg-primary/70 border border-primary-content rounded-md font-semibold text-xs uppercase tracking-widest active:bg-primary/20 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
