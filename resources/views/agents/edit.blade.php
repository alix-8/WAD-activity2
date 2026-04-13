<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Agent Profile') }}: {{ $agent->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="{{ route('agents.update', $agent->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $agent->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="license_no" :value="__('License Number')" />
                        <x-text-input id="license_no" class="block mt-1 w-full" type="text" name="license_no" :value="old('license_no', $agent->license_no)" 
                            maxlength="6" 
                        required />
                        <x-input-error :messages="$errors->get('license_no')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone_no" :value="__('Phone Number')" />
                        <x-text-input id="phone_no" class="block mt-1 w-full" type="text" name="phone_no" :value="old('phone_no', $agent->phone_no)" 
                            maxlength="11" 
                            placeholder="09123456789"
                        required />
                        <x-input-error :messages="$errors->get('phone_no')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6 pt-4 border-t border-gray-100">
                        <a href="{{ route('agents.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4 transition">
                            Cancel
                        </a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>