<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form class="p-6" action="{{ route('customers.index') }}" method="GET">
                <div class="input-group">
                    <x-text-input class="mt-1" type="text" name="search" :value="request('search')" autofocus />

                    <x-primary-button class="ms-3"> {{ __('Search') }} </x-primary-button>
                </div>
                {{-- TODO: Use fetch to render page quickly --}}
            </form>

            <div class="p-6">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Plan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->payment_plan_id ? $customer->paymentPlan?->name : 'No Plan' }}</td>
                                <td style="text-align-last: center;">
                                    <ul>
                                        <li>
                                            <a href="{{ route('customers.edit', $customer) }}"
                                                class="btn btn-sm btn-warning">
                                                <x-primary-button x-on:click="$dispatch('close')">
                                                    {{ __('Edit') }}
                                                </x-primary-button>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('customers.show', $customer) }}"
                                                class="btn btn-sm btn-info">
                                                <x-primary-button x-on:click="$dispatch('close')">
                                                    {{ __('View') }}
                                                </x-primary-button>
                                            </a>
                                        </li>
                                        <li>
                                            <form method="post"
                                                action="{{ route('customers.activationToggle', $customer) }}">
                                                @csrf
                                                @method('post')
                                                @if ($customer->is_active)
                                                    <x-danger-button class="ms-3">
                                                        {{ __('Deactivate') }}
                                                    </x-danger-button>
                                                @else
                                                    <x-primary-button x-on:click="$dispatch('close')">
                                                        {{ __('Activate') }}
                                                    </x-primary-button>
                                                @endif
                                            </form>
                                        </li>
                                        <li>
                                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{ $customer->id }}')">{{ __('Delete Account') }}</x-danger-button>

                                            <x-modal name="confirm-user-deletion-{{ $customer->id }}" :show="$errors->userDeletion->isNotEmpty()"
                                                focusable>
                                                <form method="post"
                                                    action="{{ route('customers.destroy', $customer) }}"
                                                    class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Are you sure you want to delete your account?') }}
                                                    </h2>
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Delete Account') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
