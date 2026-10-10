@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-medina focus:ring-medina rounded-xl shadow-sm text-gray-800 text-sm transition duration-150']) }}>
