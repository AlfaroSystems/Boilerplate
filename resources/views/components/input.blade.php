@props(['disabled' => false, 'type' => 'text', 'label' => null])

<div class="mb-4">
    @if($label)
        <label class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">
            {{ $label }}
        </label>
    @endif

    <input type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'w-full px-4 py-2 bg-white dark:bg-[#161615] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-lg text-[#1b1b18] dark:text-white placeholder-[#A1A09A] focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all disabled:opacity-50 disabled:cursor-not-allowed'
]) !!}>
</div>