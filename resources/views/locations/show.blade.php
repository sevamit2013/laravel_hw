<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Location Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">{{ $location->location_name }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>{{ __('Location Code:') }}</strong> {{ $location->loc_code }}</p>
                            <p><strong>{{ __('Location Name:') }}</strong> {{ $location->location_name }}</p>
                            <p><strong>{{ __('Parent Location:') }}</strong> {{ $location->parent ? $location->parent->location_name : 'N/A' }}</p>
                            <p><strong>{{ __('Inactive:') }}</strong> {{ $location->inactive ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('locations.edit', $location->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                            {{ __('Edit Location') }}
                        </a>
                        <form action="{{ route('locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this location?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete Location') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
