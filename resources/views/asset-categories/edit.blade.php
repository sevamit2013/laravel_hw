<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Asset Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('asset-categories.update', $assetCategory->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-label for="description" :value="__('Description')" />
                                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $assetCategory->description)" required autofocus />
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="is_software" id="is_software" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ $assetCategory->is_software ? 'checked' : '' }}>
                                <x-label for="is_software" :value="__('Is Software')" class="ml-2" />
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="inactive" id="inactive" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ $assetCategory->inactive ? 'checked' : '' }}>
                                <x-label for="inactive" :value="__('Inactive')" class="ml-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
