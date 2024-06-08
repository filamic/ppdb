<x-filament-panels::page>

    <img src="/img/banner.png" alt="">
    <div class="grid sm:grid-flow-col justify-between items-center">
        <div>
            <h3 class="font-medium text-xl dark:text-slate-50">{{__('label.welcome_back')}}, <span>{{auth()->user()->name}}</span> 👋</h3>
            <p class="text-slate-400">{{__('label.dashboard_sub_heading')}}</p>
        </div>
    </div>
    <div class="grid sm:grid-flow-col gap-4 sm:gap-4">
        <!-- <button type="button" class="
            group block w-full sm:mt-0 rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 
            hover:bg-sky-500 hover:ring-sky-500
            dark:bg-[#0F172A] 
            transition ease-in-out delay-150 sm:hover:-translate-y-1 sm:hover:scale-110 duration-300
            text-left
            "
            wire:click="mountAction('create')"
        >
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-purple-600 group-hover:stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>
                <h3 class=" group-hover:text-white text-sm font-semibold text-gray-700 dark:text-gray-200">Judul</h3>
            </div>
            <p class="text-slate-500 group-hover:text-white text-sm">deskripti</p>
        </button> -->

        <x-forms.button 
            title="{{__('label.create_student')}}" 
            action="create" 
            description="{{__('label.create_student_description')}}" 
        >
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-purple-600 group-hover:stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>
            </x-slot>
        </x-forms.button>
        
        <x-forms.button 
            title="{{__('label.create_parent')}}" 
            action="createGuardian"
            description="{{__('label.create_parent_description')}}" 
        >
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-purple-600 group-hover:stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </x-slot>
        </x-forms.button>

        <x-forms.button 
            title="{{__('label.create_student_file')}}" 
            action="createUserAttachment" 
            description="{{__('label.create_student_file_description')}}" 
        >
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-purple-600 group-hover:stroke-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </x-slot>
        </x-forms.button>
    </div>
    
    <div class="relative mt-4">
        <div class="absolute inset-0 flex items-center">
            <div class="h-px w-full bg-gray-200 dark:bg-white/10"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="bg-white px-6 text-sm font-medium leading-6 text-gray-500 dark:bg-[#020420] dark:text-gray-400">
                *********
            </span>
        </div>
    </div>

    @if(!$students->count())
        <div class="flex flex-col justify-center items-center mt-4">
            <div class="flex justify-center items-center">
                <img src="/img/undraw_no_data.svg" alt="" class="w-40 h-40">
            </div>
            <h1 class="mt-6 font-medium text-2xl text-center mb-3  text-gray-700 dark:text-gray-200">{{__('label.dashboard_empty_state_title')}}</h1>
            <p class="text-gray-500 text-center">{{__('label.dashboard_empty_state_desc')}}</p>
        </div>
    @endif
    
    
    <div class="flex flex-col gap-10 sm:flex-row justify-between" x-data="{ activeContent: 1 }">
        @if($students->count())
        <ul class="fi-sidebar-group-items flex flex-col gap-y-1">
            <li class="fi-sidebar-item flex flex-col gap-y-1 cursor-pointer" @click="activeContent = 1" :class="{ 'fi-active fi-sidebar-item-active': activeContent === 1 }">
                <a class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75" :class="{'hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 bg-gray-100 dark:bg-white/5': activeContent === 1}">
                    <div x-show="activeContent === 1">
                        <span class="fi-sidebar-item-icon h-6 w-6 text-gray-400 dark:text-gray-500" >
                            <span class="flex h-full w-full items-center justify-center">
                                <span class="flex h-4 w-4 items-center justify-center rounded-full bg-primary-200 dark:bg-primary-500/40">
                                    <span class="h-2 w-2 rounded-full bg-primary-600 dark:bg-primary-400"></span>
                                </span>
                            </span>
                        </span>
                    </div>
                    <div x-show="!(activeContent === 1)">
                        <span class="fi-sidebar-item-icon h-6 w-6 text-gray-400 dark:text-gray-500">
                            <span class="flex h-full w-full items-center justify-center">
                                <span class="flex h-4 w-4 items-center justify-center rounded-full">
                                    <span class="h-2 w-2 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                                </span>
                            </span>
                        </span>
                    </div>
                    <span class="fi-sidebar-item-label flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200" :class="{ 'text-primary-600 dark:text-primary-400': activeContent === 1 }">
                        {{__('label.show_data')}} {{__('label.student')}}
                    </span>
                </a>
            </li>

            <li class="fi-sidebar-item flex flex-col gap-y-1 cursor-pointer" @click="activeContent = 2" :class="{ 'fi-active fi-sidebar-item-active': activeContent === 2 }">
                <a class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 outline-none transition duration-75" :class="{'hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 bg-gray-100 dark:bg-white/5': activeContent === 2}">
                    <div x-show="activeContent === 2">
                        <span class="fi-sidebar-item-icon h-6 w-6 text-gray-400 dark:text-gray-500" >
                            <span class="flex h-full w-full items-center justify-center">
                                <span class="flex h-4 w-4 items-center justify-center rounded-full bg-primary-200 dark:bg-primary-500/40">
                                    <span class="h-2 w-2 rounded-full bg-primary-600 dark:bg-primary-400"></span>
                                </span>
                            </span>
                        </span>
                    </div>
                    <div x-show="!(activeContent === 2)">
                        <span class="fi-sidebar-item-icon h-6 w-6 text-gray-400 dark:text-gray-500">
                            <span class="flex h-full w-full items-center justify-center">
                                <span class="flex h-4 w-4 items-center justify-center rounded-full">
                                    <span class="h-2 w-2 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                                </span>
                            </span>
                        </span>
                    </div>
                    <span class="fi-sidebar-item-label flex-1 truncate text-sm font-medium text-gray-700 dark:text-gray-200"  :class="{ 'text-primary-600 dark:text-primary-400': activeContent === 2 }">
                        {{__('label.show_data')}} {{__('label.guardian')}}
                    </span>
                </a>
            </li>
        </ul>
        @endif
        @if($students->count())
            <div class="w-full grid justify-between items-center mt-4 gap-2 grid-cols-2 sm:grid-cols-2 sm:mt-0"  x-show="activeContent === 1">
                @foreach ($students as $student)
                    <div wire:key="{{$student->id}}" class="py-8 px-6 max-w-sm mx-auto rounded-xl space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 w-full" >
                        <img class="block h-24 rounded-full sm:shrink-1 mx-auto" src="{{$student->sex_img}}" alt="{{$student->name}}" />
                        <div class="text-center space-y-2 sm:text-left">
                            <div class="space-y-0.5">
                                <p class="text-md text-gray-700 font-semibold dark:text-gray-200">
                                    {{$student->name}} 
                                </p>
                                <p class="text-slate-500 font-medium text-xs">
                                    {{$student->class_level_proposed_name}}
                                </p>
                            </div>
                            <x-filament::badge size="xs"
                                icon="heroicon-m-arrow-path"
                                class="inline-flex items-center rounded-md bg-gray-50 px-2 p-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                Proses Verifikasi
                            </x-filament::badge>
                        </div>
                        <div class="grow flex justify-center sm:justify-end gap-4">
                            {{ ($this->editAction)(['student' => $student->id]) }}
                            {{ ($this->deleteAction)(['student' => $student->id]) }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        @if($guardians->count())
            <div class="w-full grid justify-between items-center mt-4 gap-2 grid-cols-2 sm:grid-cols-3 sm:mt-0" x-show="activeContent === 2">
                @foreach ($guardians as $guardian)
                    <div wire:key="{{$guardian->id}}" class="py-8 px-6 max-w-sm mx-auto rounded-xl space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 w-full" >
                        <div class="text-center space-y-2 sm:text-left">
                            <div class="space-y-0.5">
                                <p class="text-md text-gray-700 font-semibold dark:text-gray-200">
                                    {{$guardian->name}} 
                                </p>
                                <p class="text-slate-500 font-medium text-xs">
                                    {{$guardian->phone_numbers}}
                                </p>
                            </div>
                            <x-filament::badge size="xs"
                                icon="heroicon-m-user"
                                class="inline-flex items-center rounded-md bg-gray-50 px-2 p-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                {{$guardian->guardian_type_name}}
                            </x-filament::badge>
                        </div>
                        <div class="grow flex justify-center sm:justify-end gap-4">
                            {{ ($this->guardianEditAction)(['guardian' => $guardian->id]) }}
                            {{ ($this->guardianDeleteAction)(['guardian' => $guardian->id]) }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
    <x-filament-actions::modals />
</x-filament-panels::page>
