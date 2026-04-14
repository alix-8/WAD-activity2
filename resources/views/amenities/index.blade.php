<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Amenities List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
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

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-200">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-xs font-bold uppercase text-gray-500">Name</th>
                            <th class="px-6 py-3 text-right text-xs font-bold uppercase text-gray-500">Actions</th>
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
                                        <button class="text-red-600 hover:underline text-sm">Delete</button>
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