@props([
    'title',
    'description',
    'icon',
    'action',
])

<div>
    <button 
        type="button" 
        class="
            group block w-full sm:mt-0 rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 
            hover:bg-sky-500 hover:ring-sky-500
            dark:bg-[#0F172A] 
            transition ease-in-out delay-150 sm:hover:-translate-y-1 sm:hover:scale-110 duration-300
            text-left
            "
        {{ $attributes }}
        wire:click="mountAction('{{$action}}')"
    >
        <div class="flex items-center space-x-3">
            {{ $icon }}
            <h3 class=" group-hover:text-white text-sm font-semibold text-gray-700 dark:text-gray-200">{{$title}}</h3>
        </div>
        <p class="text-slate-500 group-hover:text-white text-sm">{{$description}}</p>
    </button>
</div>