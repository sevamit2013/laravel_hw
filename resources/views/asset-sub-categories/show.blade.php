<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asset Sub Category Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">{{ $asset_sub_category->description }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>{{ __('Description:') }}</strong> {{ $asset_sub_category->description }}</p>
                            <p><strong>{{ __('Category:') }}</strong> {{ $asset_sub_category->category->description }}</p>
                            <p><strong>{{ __('Inactive:') }}</strong> {{ $asset_sub_category->inactive ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        {{-- ✅ CORRECT: Pass the $asset_sub_category object --}}
<a href="{{ route('asset-sub-categories.edit', $asset_sub_category) }}" 
    class="btn btn-primary">
    Edit Sub-Category
</a>
                        {{-- ✅ CORRECT: Pass the $asset_sub_category object --}}
<form method="POST" action="{{ route('asset-sub-categories.destroy', $asset_sub_category) }}"
    onsubmit="return confirm('Are you sure you want to delete this sub-category?');">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">Delete</button>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
