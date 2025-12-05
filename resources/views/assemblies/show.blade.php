<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assembly Details') }}
        </h2>
    </x-slot>

    @php
        // Load user (your table uses real_name)
        $assignedUser = $assembly->user_id ? \App\Models\User::find($assembly->user_id) : null;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Title --}}
                    <h1 class="text-2xl font-bold mb-6">{{ $assembly->description }}</h1>

                    {{-- Details --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-2">
                            <p><strong>{{ __('Assembly Code:') }}</strong> {{ $assembly->assembly_code }}</p>
                            <p><strong>{{ __('Description:') }}</strong> {{ $assembly->description }}</p>

                            <p><strong>{{ __('Location:') }}</strong>
                                {{ $assembly->location?->location_name ?? $assembly->location?->loc_code ?? 'N/A' }}
                            </p>

                            <p><strong>{{ __('User:') }}</strong>
                                {{ $assignedUser?->real_name ?? 'N/A' }}
                            </p>

                            <p><strong>{{ __('IP Address:') }}</strong> {{ $assembly->ip_address }}</p>
                            <p><strong>{{ __('Remark:') }}</strong> {{ $assembly->remark }}</p>
                            <p><strong>{{ __('Status:') }}</strong> {{ $assembly->status }}</p>
                        </div>

                        <div class="space-y-2">
                            <p><strong>{{ __('Created By:') }}</strong> {{ $assembly->created_by }}</p>
                            <p><strong>{{ __('Modified By:') }}</strong> {{ $assembly->modified_by }}</p>
                            <p><strong>{{ __('Created At:') }}</strong> {{ $assembly->created_at }}</p>
                            <p><strong>{{ __('Updated At:') }}</strong> {{ $assembly->updated_at }}</p>
                        </div>

                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end mt-8 space-x-3">

                        {{-- Edit Button --}}
                        <a href="{{ route('assemblies.edit', ['assembly' => $assembly->assembly_id]) }}"
                           class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent
                           rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm
                           hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400
                           focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Edit Assembly') }}
                        </a>

                        {{-- Delete Button --}}
                        <form action="{{ route('assemblies.destroy', ['assembly' => $assembly->assembly_id]) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this assembly?');"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent
                                    rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm
                                    hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500
                                    focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Delete Assembly') }}
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
