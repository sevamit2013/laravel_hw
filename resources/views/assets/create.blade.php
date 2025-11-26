<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('assets.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="asset_code" :value="__('Asset Code')" />
                                <x-text-input id="asset_code" class="block mt-1 w-full" type="text" name="asset_code" :value="old('asset_code')" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                            </div>
                            <div>
                                <x-input-label for="asset_category_id" :value="__('Asset Category')" />
                                <select name="asset_category_id" id="asset_category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($assetCategories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="asset_sub_category_id" :value="__('Asset Sub Category')" />
                                <select name="asset_sub_category_id" id="asset_sub_category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($assetSubCategories as $subCategory)
                                        <option value="{{ $subCategory->sub_cat_id }}">{{ $subCategory->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="location_id" :value="__('Location')" />
                                <select name="location_id" id="location_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->loc_code }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="user_id" :value="__('User')" />
                                <select name="user_id" id="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="assembly_id" :value="__('Assembly')" />
                                <select name="assembly_id" id="assembly_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($assemblies as $assembly)
                                        <option value="{{ $assembly->assembly_id }}">{{ $assembly->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="manufacturer" :value="__('Manufacturer')" />
                                <x-text-input id="manufacturer" class="block mt-1 w-full" type="text" name="manufacturer" :value="old('manufacturer')" />
                            </div>
                            <div>
                                <x-input-label for="model" :value="__('Model')" />
                                <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" />
                            </div>
                            <div>
                                <x-input-label for="company_serial" :value="__('Company Serial')" />
                                <x-text-input id="company_serial" class="block mt-1 w-full" type="text" name="company_serial" :value="old('company_serial')" />
                            </div>
                            <div>
                                <x-input-label for="purchase_date" :value="__('Purchase Date')" />
                                <x-text-input id="purchase_date" class="block mt-1 w-full" type="date" name="purchase_date" :value="old('purchase_date')" />
                            </div>
                            <div>
                                <x-input-label for="purchase_cost" :value="__('Purchase Cost')" />
                                <x-text-input id="purchase_cost" class="block mt-1 w-full" type="number" step="0.01" name="purchase_cost" :value="old('purchase_cost')" />
                            </div>
                            <div>
                                <x-input-label for="warranty_expiration_date" :value="__('Warranty Expiration Date')" />
                                <x-text-input id="warranty_expiration_date" class="block mt-1 w-full" type="date" name="warranty_expiration_date" :value="old('warranty_expiration_date')" />
                            </div>
                            <div>
                                <x-input-label for="remark" :value="__('Remark')" />
                                <textarea name="remark" id="remark" rows="3" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('remark') }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <x-text-input id="status" class="block mt-1 w-full" type="number" name="status" :value="old('status')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
