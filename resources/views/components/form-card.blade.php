@props(['title', 'icon' => ''])

<div class="p-4 sm:p-6 bg-white rounded-lg shadow-md mb-6 sm:mb-8 border border-gray-200">
    <div class="flex items-center mb-6">
        @if($icon)
            <span class="text-2xl mr-3">{{ $icon }}</span>
        @endif
        <h2 class="text-xl font-semibold" style="color: var(--oxossi-main);">{{ $title }}</h2>
    </div>

    {{ $slot }}
</div>
