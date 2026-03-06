@props(['type' => 'success', 'message'])

@php
    $classes = match($type) {
        'success' => 'border-emerald-500/30 bg-emerald-500/10 text-emerald-300',
        'error'   => 'border-red-500/30 bg-red-500/10 text-red-300',
        'warning' => 'border-amber-500/30 bg-amber-500/10 text-amber-300',
        'info'    => 'border-blue-500/30 bg-blue-500/10 text-blue-300',
        default   => 'border-gray-500/30 bg-gray-500/10 text-gray-300',
    };

    $icon = match($type) {
        'success' => '✅',
        'error'   => '❌',
        'warning' => '⚠️',
        'info'    => 'ℹ️',
        default   => '💬',
    };
@endphp

<div class="mt-4 flex items-center gap-3 rounded-xl border px-4 py-3 {{ $classes }}"
     x-data="{ show: true }"
     x-show="show"
     x-init="setTimeout(() => show = false, 5000)"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <span class="text-lg">{{ $icon }}</span>
    <p class="flex-1 text-sm font-medium">{{ $message }}</p>
    <button @click="show = false" class="ml-2 text-current opacity-60 hover:opacity-100 transition">✕</button>
</div>
