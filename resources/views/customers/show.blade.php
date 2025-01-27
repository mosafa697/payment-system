<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Customer') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Plan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->payment_plan_id ? $customer->paymentPlan?->name : 'No Plan' }}</td>
                            <td style="text-align-last: center;">
                                <ul>
                                    <li>
                                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning">
                                            <x-primary-button x-on:click="$dispatch('close')">
                                                {{ __('Edit') }}
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
                                            <form method="post" action="{{ route('customers.destroy', $customer) }}"
                                                class="p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Are you sure you want to delete this customer?') }}
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
                    </tbody>
                </table>
            </div>
        </div>
</x-app-layout>
