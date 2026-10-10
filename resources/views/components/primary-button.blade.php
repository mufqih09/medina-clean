<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-medina hover:bg-[#3baad3] active:bg-[#2da0ca] border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-wider shadow-sm focus:outline-none focus:ring-2 focus:ring-medina focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 cursor-pointer']) }}>
    {{ $slot }}
</button>
