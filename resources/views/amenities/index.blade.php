<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Amenities List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @can('create', App\Models\Amenity::class)
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6 border border-gray-200">
                <h3 class="font-bold mb-4">Create New Amenity</h3>
                <form action="{{ route('amenities.store') }}" method="POST" class="flex gap-4">
                    @csrf
                    <div class="flex-1">
                        <x-text-input name="name" class="w-full" placeholder="WiFi, Pool, etc." required />
                    </div>
                    <x-primary-button>Save</x-primary-button>
                </form>
            </div>
            @endcan

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


            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-200">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold uppercase text-gray-500">Name</th>
                            <th class="px-6 py-3 text-right text-xs font-bold uppercase text-gray-500"> </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($amenities as $amenity)
                            <tr>
                                <td class="px-6 py-4">{{ $amenity->name }}</td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('amenities.destroy', $amenity->id) }}" method="POST" onsubmit="return confirm('Remove this amenity?')">
                                        @csrf
                                        @method('DELETE')
                                        @can('delete', $amenity)
                                        <button class="text-red-600 hover:underline text-sm">Delete</button>
                                        @endcan

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>