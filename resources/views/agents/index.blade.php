<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Agent') }}
            </h2>

            @can('create', App\Models\Agent::class)
                <a href="{{ route('agents.create') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                    + Add New Agent
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- SUCCESS MESSAGE (UNIFIED STYLE) --}}
            @if(session('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    x-transition
                    class="mb-4 flex items-start justify-between gap-3 rounded-lg border border-green-200 bg-green-50 px-4 py-3 shadow-sm"
                >
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <span class="text-sm text-green-800 font-medium">
                            {{ session('success') }}
                        </span>
                    </div>

                    <button @click="show = false" class="text-green-700 hover:text-green-900">
                        ✕
                    </button>
                </div>
            @endif

            {{-- TABLE --}}
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

                                <td class="border px-4 py-2">
                                    <a href="{{ route('agents.show', $agent->id) }}"
                                       class="text-blue-500 hover:underline">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</x-app-layout>