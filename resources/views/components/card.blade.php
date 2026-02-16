<div {{ $attributes->merge(['class' => 'bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg p-6 shadow-sm transition-colors']) }}>
    @isset($header)
        <div class="mb-4 pb-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <h3 class="text-lg font-semibold text-[#1b1b18] dark:text-white">{{ $header }}</h3>
        </div>
    @endisset

    <div class="text-[#1b1b18] dark:text-[#EDEDEC]">
        {{ $slot }}
    </div>
</div>