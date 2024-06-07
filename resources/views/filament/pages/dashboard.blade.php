<x-filament-panels::page>
    <div class="grid sm:grid-flow-col justify-between items-center">
        <div>
            <h3 class="font-medium text-xl dark:text-slate-50">Selamat datang kembali, <span>{{auth()->user()->name}}</span> 👋</h3>
            <p class="text-slate-400">{{__('label.dashboard_sub_heading')}}</p>
        </div>
        <button type="button" class="
            group block w-full mt-8 sm:mt-0 rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 
            hover:bg-sky-500 hover:ring-sky-500
            dark:bg-[#0F172A] 
            transition ease-in-out delay-150 sm:hover:-translate-y-1 sm:hover:scale-110 duration-300
            "
            wire:click="mountAction('create')"
            >
          <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-purple-600 group-hover:stroke-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
            </svg>
        
            <h3 class=" group-hover:text-white text-sm font-semibold text-gray-700 dark:text-gray-200">Daftarkan anak saya</h3>
          </div>
          <p class="text-slate-500 group-hover:text-white text-sm">Klik disini untuk mulai mengisi data peserta didik.</p>
        </button>
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
    @if($students->count())
    <div class="relative mt-4">
        <div class="absolute inset-0 flex items-center">
            <div class="h-px w-full bg-gray-200 dark:bg-white/10"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="bg-white px-6 text-sm font-medium leading-6 text-gray-500 dark:bg-[#020420] dark:text-gray-400">
                {{__('label.all_student')}}
            </span>
        </div>
    </div>
    <div class="grid justify-between items-center mt-4 gap-2 grid-cols-2 sm:grid-cols-3">
        @foreach ($students as $student)    
            <div wire:key="{{$student->id}}" class="py-8 px-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 dark:bg-[#0F172A] cursor-pointer w-full">
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

    <x-filament-actions::modals />
</x-filament-panels::page>
