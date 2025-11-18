<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-orange-800 leading-tight">
                🛒 My Grocery List
            </h2>
            <div class="text-sm text-orange-600">
                Welcome, {{ Auth::user()->name }}!
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:grocery-list />
            </div>
        </div>
    </div>
</x-app-layout>
