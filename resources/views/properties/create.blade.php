<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="{{ route('properties.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Property Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="type" :value="__('Property Type')" />
                            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" placeholder="e.g., Condo, House" required />
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="agent_id" :value="__('Assign Agent')" />
                        <select id="agent_id" name="agent_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">-- Select Existing Agent --</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }} (License: {{ $agent->license_no }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('agent_id')" class="mt-2" />
                    </div>

                    <div class="mt-6 border-t pt-4">
                        <h3 class="text-md font-medium text-gray-700 mb-4">{{ __('Address Details') }}</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="mb-4">
                                <x-input-label for="house_number" :value="__('House Number')" />
                                <x-text-input id="house_number" class="block mt-1 w-full" type="text" name="house_number" :value="old('house_number')" required />
                                <x-input-error :messages="$errors->get('house_number')" class="mt-2" />
                            </div>

                            <div class="mb-4 md:col-span-2">
                                <x-input-label for="street" :value="__('Street')" />
                                <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required />
                                <x-input-error :messages="$errors->get('street')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4 border-t pt-4">
                        <a href="{{ route('properties.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                        <x-primary-button>
                            {{ __('Save Property') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>