<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Property List') }}
            </h2>
            <a href="{{ route('properties.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                + Add New Property
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Title</th>
                            <th class="border px-4 py-2 text-left">Price</th>
                            <th class="border px-4 py-2 text-left">Type</th>
                            <th class="border px-4 py-2 text-left">Agent</th>
                            <th class="border px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $property->title }}</td>
                                
                                <td class="border px-4 py-2">Php{{ number_format($property->price, 2) }}</td>
                                
                                <td class="border px-4 py-2">{{ $property->type ?? 'N/A' }}</td>
                                
                                <td class="border px-4 py-2">
                                    {{ $property->agent->name ?? 'Unassigned' }}
                                    <span class="text-xs text-gray-400 block">ID: {{ $property->agent_id }}</span>
                                </td>
                                
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('properties.show', $property->id) }}" class="text-blue-500 hover:underline">View</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if(method_exists($properties, 'links'))
                    <div class="mt-4">
                        {{ $properties->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>