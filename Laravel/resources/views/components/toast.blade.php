<div
    x-data="{ show: false, expanded: false, message: '', type: '' }"
    @toast.window="
        message = $event.detail.message;
        type = $event.detail.type || 'info';
        show = true;
        setTimeout(() => expanded = true, 300);
        setTimeout(() => expanded = false, 3300);
        setTimeout(() => show = false, 3600);
    "
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-y-4 opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="-translate-y-4 opacity-0"
    class="fixed {{ $topcss ?? 'top-[140px]' }} right-5 z-50"
    aria-live="assertive"
>
    <div
        class="flex items-center overflow-hidden shadow-lg transition-all duration-500 ease-in-out rounded-full h-12"
        x-bind:class="{
            'w-12 justify-center p-2': !expanded,
            'max-w-xs px-4 py-2 justify-start gap-3': expanded,
            'bg-gradient-to-r from-green-500 to-emerald-600 text-white': type === 'success',
            'bg-gradient-to-r from-red-500 to-rose-600 text-white': type === 'error',
            'bg-gradient-to-r from-yellow-400 to-amber-500 text-white': type === 'warning',
            'bg-gradient-to-r from-blue-500 to-indigo-600 text-white': type === 'info'
        }"
        x-bind:style="expanded ? 'width: 16rem;' : 'width: 3rem;'"
    >
        <!-- Icon -->
        <div class="w-6 h-6 shrink-0" x-html="{
            success: `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7' /></svg>`,
            error: `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' /></svg>`,
            warning: `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 9v2m0 4h.01M5.07 19h13.86c1.1 0 2-.9 2-2L12 4 3.07 17c0 1.1.9 2 2 2z' /></svg>`,
            info: `<svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z' /></svg>`
        }[type] || ''"></div>

        <!-- Message -->
        <span 
            x-show="expanded" 
            x-transition.opacity 
            x-text="message" 
            class="whitespace-nowrap text-sm font-medium"
        ></span>
    </div>
</div>
