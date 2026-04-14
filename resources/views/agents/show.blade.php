<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Agent Details') }}: {{ $agent->name }}
            </h2>
            <a href="{{ route('agents.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
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
                            <p><span class="font-bold text-gray-700">License Number:</span> {{ $agent->license_no }}</p>
                            <p><span class="font-bold text-gray-700">Phone Number:</span> {{ $agent->phone_no }}</p>
                        </div>

                        <div class="mt-8">
                            <div class="flex space-x-4">
                                <a href="{{ route('agents.edit', $agent->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-6 rounded shadow">
                                    Edit Agent Profile
                                </a>
                                <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded shadow">
                                        Delete Agent
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Properties Handled</h3>
                        
                        @if($agent->properties->count() > 0)
                            <ul class="list-disc ml-5 space-y-2">
                                @foreach($agent->properties as $property)
                                    <li>
                                        <a href="{{ route('properties.show', $property->id) }}" class="text-blue-600 hover:underline">
                                            {{ $property->name }} 
                                        </a>
                                        <span class="text-sm text-gray-500">{{ $property->title }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic">This agent is not currently handling any properties.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>