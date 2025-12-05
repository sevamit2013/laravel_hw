<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-6 bg-white border-b border-gray-200">
 
   
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('assets.update', $asset->asset_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="asset_code" :value="__('Asset Code')" />
                                <x-text-input id="asset_code" class="block mt-1 w-full" type="text" name="asset_code" :value="old('asset_code', $asset->asset_code)" required autofocus />
                                <x-input-error :messages="$errors->get('asset_code')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $asset->description)" required />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="asset_category_id" :value="__('Asset Category')" />
                                <select name="asset_category_id" id="asset_category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($assetCategories as $category)
                                        <option value="{{ $category->category_id }}" {{ $asset->asset_category_id == $category->category_id ? 'selected' : '' }}>{{ $category->description }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('asset_category_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="asset_sub_category_id" :value="__('Asset Sub Category')" />
                                <select name="asset_sub_category_id" id="asset_sub_category_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($assetSubCategories as $subCategory)
                                        <option value="{{ $subCategory->sub_cat_id }}" {{ $asset->asset_sub_category_id == $subCategory->sub_cat_id ? 'selected' : '' }}>{{ $subCategory->description }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('asset_sub_category_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="location_id" :value="__('Location')" />
                                <select name="location_id" id="location_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->loc_code }}" {{ $asset->location_id == $location->loc_code ? 'selected' : '' }}>{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('location_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="user_id" :value="__('User')" />
                                <select name="user_id" id="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $asset->user == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="assembly_id" :value="__('Assembly')" />
                                <select name="assembly_id" id="assembly_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($assemblies as $assembly)
                                        <option value="{{ $assembly->assembly_id }}" {{ $asset->assembly_id == $assembly->assembly_id ? 'selected' : '' }}>{{ $assembly->description }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('assembly_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="manufacturer" :value="__('Manufacturer')" />
                                <x-text-input id="manufacturer" class="block mt-1 w-full" type="text" name="manufacturer" :value="old('manufacturer', $asset->manufacturer)" />
                                <x-input-error :messages="$errors->get('manufacturer')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="model" :value="__('Model')" />
                                <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model', $asset->model)" />
                                <x-input-error :messages="$errors->get('model')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="company_serial" :value="__('Company Serial')" />
                                <x-text-input id="company_serial" class="block mt-1 w-full" type="text" name="company_serial" :value="old('company_serial', $asset->company_serial)" />
                                <x-input-error :messages="$errors->get('company_serial')" class="mt-2" />
                            </div>
                            <div>
                                    <x-input-label for="purchase_date" :value="__('Purchase Date')" />
                                    <x-text-input id="purchase_date" class="block mt-1 w-full" type="date" name="purchase_date"
                                        :value="old('purchase_date', $asset->purchase_date ?? '')" />
                                    <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="purchase_cost" :value="__('Purchase Cost')" />
                                <x-text-input id="purchase_cost" class="block mt-1 w-full" type="number" step="0.01" name="purchase_cost" :value="old('purchase_cost', $asset->purchase_cost)" />
                                <x-input-error :messages="$errors->get('purchase_cost')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="warranty_expiration_date" :value="__('Warranty Expiration Date')" />
                                <x-text-input id="warranty_expiration_date" class="block mt-1 w-full" type="date" name="warranty_expiration_date"
                                    :value="old('warranty_expiration_date', $asset->warranty_expiration_date ?? '')" />
                                <x-input-error :messages="$errors->get('warranty_expiration_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="remark" :value="__('Remark')" />
                                <textarea name="remark" id="remark" rows="3" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('remark', $asset->remark) }}</textarea>
                                <x-input-error :messages="$errors->get('remark')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <x-text-input id="status" class="block mt-1 w-full" type="number" name="status" :value="old('status', $asset->status)" />
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Asset') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>