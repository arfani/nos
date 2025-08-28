@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-primary/50 focus:border-primary focus:border-primary focus:ring-0 rounded-md shadow-sm']) !!}>
