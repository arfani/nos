@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-secondary text-secondary-content border-primary/50 focus:border-primary focus:border-primary focus:ring-0 text-primary-content rounded-md shadow-sm']) !!}>
