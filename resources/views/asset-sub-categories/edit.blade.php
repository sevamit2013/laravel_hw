<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Asset Sub Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('asset-sub-categories.update', $assetSubCategory->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <x-label for="description" :value="__('Description')" />
                                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $assetSubCategory->description)" required autofocus />
                            </div>
                            <div>
                                <x-label for="asset_category_id" :value="__('Asset Category')" />
                                <select name="asset_category_id" id="asset_category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($assetCategories as $category)
                                        <option value="{{ $category->id }}" {{ $assetSubCategory->asset_category_id == $category->id ? 'selected' : '' }}>{{ $category->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="inactive" id="inactive" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ $assetSubCategory->inactive ? 'checked' : '' }}>
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
