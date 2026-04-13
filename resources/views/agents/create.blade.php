<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Agent') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="{{ route('agents.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Full Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="license_no" :value="__('License Number')" />
                        <x-text-input id="license_no" class="block mt-1 w-full" type="text" name="license_no" :value="old('license_no')" 
                            maxlength="6" 
                        required />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone_no" :value="__('Phone Number')" />
                        <x-text-input id="phone_no" class="block mt-1 w-full" type="text" name="phone_no" :value="old('phone_no')" 
                            maxlength="11" 
                            placeholder="09123456789"
                        required />
                        
                    </div>

                    <div class="flex items-center justify-end mt-4 border-t pt-4">
                        <a href="{{ route('agents.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                        <x-primary-button>
                            {{ __('Register Agent') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>