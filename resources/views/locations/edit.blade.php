<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Location') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('locations.update', $location) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Location Code (read-only if you want to keep PK stable) --}}
                            <div>
                                <x-input-label for="loc_code" :value="__('Location Code')" />
                                <x-text-input
                                    id="loc_code"
                                    class="block mt-1 w-full bg-gray-100"
                                    type="text"
                                    name="loc_code"
                                    :value="old('loc_code', $location->loc_code)"
                                    readonly
                                />
                                @if ($errors->has('loc_code'))
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->first('loc_code') }}
                                    </p>
                                @endif
                            </div>

                            {{-- Location Name --}}
                            <div>
                                <x-input-label for="location_name" :value="__('Location Name')" />
                                <x-text-input
                                    id="location_name"
                                    class="block mt-1 w-full"
                                    type="text"
                                    name="location_name"
                                    :value="old('location_name', $location->location_name)"
                                    required
                                />
                                @if ($errors->has('location_name'))
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->first('location_name') }}
                                    </p>
                                @endif
                            </div>

                            {{-- Parent Location --}}
                            <div>
                                <x-input-label for="parent_id" :value="__('Parent Location')" />
                                <select
                                    name="parent_id"
                                    id="parent_id"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300
                                           focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                >
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($locations as $loc)
                                        <option value="{{ $loc->id }}"
                                            {{ old('parent_id', $location->parent_id) == $loc->id ? 'selected' : '' }}>
                                            {{ $loc->location_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parent_id'))
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->first('parent_id') }}
                                    </p>
                                @endif
                            </div>

                            {{-- Inactive --}}
                            <div class="flex items-center mt-4">
                                <input
                                    type="checkbox"
                                    name="inactive"
                                    id="inactive"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    {{ old('inactive', $location->inactive) ? 'checked' : '' }}
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
