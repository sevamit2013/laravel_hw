<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asset Details') }}
        </h2>
    </x-slot>

    @php
        // Safely resolve related models that might be stored as IDs on the asset
        $assignedUser = $asset->user ? \App\Models\User::find($asset->user) : null;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Header row with title + back button --}}
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">
                            {{ $asset->description }}
                        </h1>

                        <a href="{{ route('assets.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Back to Assets') }}
                        </a>
                    </div>

                    {{-- Details grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <p><strong>{{ __('Asset Code:') }}</strong> {{ $asset->asset_code }}</p>
                            <p><strong>{{ __('Description:') }}</strong> {{ $asset->description }}</p>

                            <p>
                                <strong>{{ __('Category:') }}</strong>
                                {{ $asset->category?->description ?? 'N/A' }}
                            </p>

                            <p>
                                <strong>{{ __('Sub Category:') }}</strong>
                                {{ $asset->subCategory?->description ?? 'N/A' }}
                            </p>

                            <p>
                                <strong>{{ __('Location:') }}</strong>
                                {{ $asset->location?->location_name ?? $asset->location?->loc_code ?? 'N/A' }}
                            </p>

                            <p>
                                <strong>{{ __('User:') }}</strong>
                                {{ $assignedUser?->real_name ?? 'N/A' }}
                            </p>

                            <p>
                                <strong>{{ __('Assembly:') }}</strong>
                                {{ $asset->assembly?->description ?? 'N/A' }}
                            </p>
                        </div>

                        <div class="space-y-2">
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

                    {{-- Action buttons --}}
                    <div class="flex justify-end mt-8 space-x-3">
                        <a href="{{ route('assets.edit', $asset->asset_id) }}"
                           class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Edit Asset') }}
                        </a>

                        <form action="{{ route('assets.destroy', $asset->asset_id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this asset?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Delete Asset') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
