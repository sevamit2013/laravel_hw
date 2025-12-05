<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Assembly') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('assemblies.update', $assembly->assembly_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="assembly_code" :value="__('Assembly Code')" />
                                <x-text-input id="assembly_code" class="block mt-1 w-full" type="text" name="assembly_code" :value="old('assembly_code', $assembly->assembly_code)" required autofocus />
                                <x-input-error :messages="$errors->get('assembly_code')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $assembly->description)" required />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="ip_address" :value="__('IP Address')" />
                                <x-text-input id="ip_address" class="block mt-1 w-full" type="text" name="ip_address" :value="old('ip_address', $assembly->ip_address)" />
                                <x-input-error :messages="$errors->get('ip_address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="loc_code" :value="__('Location')" />
                                <select name="loc_code" id="loc_code" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->loc_code }}" {{ $assembly->loc_code == $location->loc_code ? 'selected' : '' }}>{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('loc_code')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="user_id" :value="__('User')" />
                                <select name="user_id" id="user_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">{{ __('None') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $assembly->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="remark" :value="__('Remark')" />
                                <textarea name="remark" id="remark" rows="3" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('remark', $assembly->remark) }}</textarea>
                                <x-input-error :messages="$errors->get('remark')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <x-text-input id="status" class="block mt-1 w-full" type="number" name="status" :value="old('status', $assembly->status)" />
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Assembly') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>