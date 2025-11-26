<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asset Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">{{ $asset->description }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>{{ __('Asset Code:') }}</strong> {{ $asset->asset_code }}</p>
                            <p><strong>{{ __('Description:') }}</strong> {{ $asset->description }}</p>
                            <p><strong>{{ __('Category:') }}</strong> {{ $asset->category->description }}</p>
                            <p><strong>{{ __('Sub Category:') }}</strong> {{ $asset->subCategory->description }}</p>
                            <p><strong>{{ __('Location:') }}</strong> {{ $asset->location->location_name }}</p>
                            <p><strong>{{ __('User:') }}</strong> {{ $asset->user ? $asset->user->name : 'N/A' }}</p>
                            <p><strong>{{ __('Assembly:') }}</strong> {{ $asset->assembly ? $asset->assembly->description : 'N/A' }}</p>
                            <p><strong>{{ __('Manufacturer:') }}</strong> {{ $asset->manufacturer }}</p>
                            <p><strong>{{ __('Model:') }}</strong> {{ $asset->model }}</p>
                            <p><strong>{{ __('Company Serial:') }}</strong> {{ $asset->company_serial }}</p>
                            <p><strong>{{ __('Purchase Date:') }}</strong> {{ $asset->purchase_date }}</p>
                            <p><strong>{{ __('Purchase Cost:') }}</strong> {{ $asset->purchase_cost }}</p>
                            <p><strong>{{ __('Warranty Expiration Date:') }}</strong> {{ $asset->warranty_expiration_date }}</p>
                            <p><strong>{{ __('Remark:') }}</strong> {{ $asset->remark }}</p>
                            <p><strong>{{ __('Status:') }}</strong> {{ $asset->status }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('assets.edit', $asset->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                            {{ __('Edit Asset') }}
                        </a>
                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this asset?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete Asset') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
