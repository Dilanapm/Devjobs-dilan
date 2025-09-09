<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis vacantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('mensaje'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 uppercase">
                    <strong class="font-bold">{{ __('Éxito') }}</strong>
                    <span class="block sm:inline">{{ session('mensaje') }}</span>
                </div>
            @endif
            
            <livewire:mostrar-vacantes />
        </div>
    </div>
</x-app-layout>
