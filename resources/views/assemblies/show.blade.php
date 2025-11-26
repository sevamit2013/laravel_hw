<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assembly Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">{{ $assembly->description }}</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>{{ __('Assembly Code:') }}</strong> {{ $assembly->assembly_code }}</p>
                            <p><strong>{{ __('Description:') }}</strong> {{ $assembly->description }}</p>
                            <p><strong>{{ __('IP Address:') }}</strong> {{ $assembly->ip_address }}</p>
                            <p><strong>{{ __('Location:') }}</strong> {{ $assembly->location->location_name }}</p>
                            <p><strong>{{ __('User:') }}</strong> {{ $assembly->user ? $assembly->user->name : 'N/A' }}</p>
                            <p><strong>{{ __('Remark:') }}</strong> {{ $assembly->remark }}</p>
                            <p><strong>{{ __('Status:') }}</strong> {{ $assembly->status }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('assemblies.edit', $assembly->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                            {{ __('Edit Assembly') }}
                        </a>
                        <form action="{{ route('assemblies.destroy', $assembly->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this assembly?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete Assembly') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
