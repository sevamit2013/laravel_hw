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

                    <form action="{{ route('asset-sub-categories.update', $asset_sub_category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">

                            {{-- Parent Category --}}
                            <div>
                                <x-input-label for="asset_category_id" :value="__('Asset Category')" />
                                <select id="asset_category_id"
                                        name="asset_category_id"
                                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        required>
                                    <option value="">{{ __('Select Category') }}</option>
                                    @foreach ($assetCategories as $category)
                                        <option value="{{ $category->category_id }}"
                                            {{ old('asset_category_id', $asset_sub_category->asset_category_id) == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->description }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('asset_category_id')" class="mt-2" />
                            </div>

                            {{-- Description --}}
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input
                                    id="description"
                                    class="block mt-1 w-full"
                                    type="text"
                                    name="description"
                                    :value="old('description', $asset_sub_category->description)"
                                    required
                                />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            {{-- Inactive --}}
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="inactive"
                                    id="inactive"
                                    value="1"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    {{ old('inactive', $asset_sub_category->inactive) ? 'checked' : '' }}
                                >
                                <x-input-label for="inactive" :value="__('Inactive')" class="ml-2" />
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
