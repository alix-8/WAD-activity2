<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Property Details') }}: {{ $property->name }}
            </h2>
            <a href="{{ route('properties.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Information</h3>
                        <div class="space-y-3">
                            <p><span class="font-bold text-gray-700">Price:</span> ${{ number_format($property->price, 2) }}</p>
                            <p><span class="font-bold text-gray-700">Type:</span> {{ $property->type }}</p>
                            <p>
                                <span class="font-bold text-gray-700">Address:</span> 
                                {{ $property->address->street ?? 'No Street' }}, {{ $property->address->city ?? 'No City' }}
                            </p>
                        </div>

                        <div class="mt-8">
                            <div class="flex space-x-4">
                                <a href="{{ route('properties.edit', $property->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-6 rounded shadow transition">
                                    Edit Property
                                </a>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded shadow transition">
                                        Delete Property
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Assigned Agent</h3>
                        @if($property->agent)
                            <div class="mb-6">
                                <p class="font-bold text-indigo-700 text-lg">{{ $property->agent->name }}</p>
                                <p class="text-sm text-gray-600">License: {{ $property->agent->license_no }}</p>
                                <a href="{{ route('agents.show', $property->agent->id) }}" class="text-blue-600 hover:underline text-sm">View Agent Profile &rarr;</a>
                            </div>
                        @else
                            <p class="text-gray-500 italic mb-6">No agent assigned to this property.</p>
                        @endif

                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Amenities</h3>
                        @if($property->amenities && $property->amenities->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($property->amenities as $amenity)
                                    <span class="bg-white border border-gray-300 px-3 py-1 rounded-full text-sm text-gray-700 shadow-sm">
                                        {{ $amenity->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">No amenities listed.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>