<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Agent') }}
            </h2>
            @can('create', App\Models\Agent::class)
            <a href="{{ route('agents.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                + Add New Agent
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">License Number</th>
                            <th class="border px-4 py-2">Phone Number</th>
                            <th class="border px-4 py-2">Property/ies Handled</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agents as $agent)
                            <tr>
                                <td class="border px-4 py-2">{{ $agent->name }}</td>
                                <td class="border px-4 py-2">{{ $agent->license_no }}</td>
                                <td class="border px-4 py-2">{{ $agent->phone_no }}</td>
                                <td class="border px-4 py-2">{{ $agent->properties->count() }}</td>
                                <!-- <td class="border px-4 py-2">{{ $agent->properties->pluck('name')->implode(', ') }}</td> -->
                                <td class="border px-4 py-2">
                                    <a href="{{ route('agents.show', $agent->id) }}" class="text-blue-500 hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>