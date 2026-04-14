<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Real Estate Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500 uppercase font-bold">Total Properties</p>
                    <p class="text-2xl font-semibold">{{ $stats['total_properties'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500 uppercase font-bold">Active Agents</p>
                    <p class="text-2xl font-semibold">{{ $stats['total_agents'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500 uppercase font-bold">Amenities</p>
                    <p class="text-2xl font-semibold">{{ $stats['total_amenities'] }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500 uppercase font-bold">Portfolio Value</p>
                    <p class="text-2xl font-semibold">Php{{ number_format($stats['total_value'], 2) }}</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>