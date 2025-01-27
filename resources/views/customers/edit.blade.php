<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Customer') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form class="p-6" action="{{ route('customers.update', $customer) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3 mt-4">
                    <label for="name" class="form-label">Name</label>
                    <x-text-input class="mt-1" type="text" name="name" id="name" :value="$customer->name"
                        required />
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <x-text-input class="mt-2" type="email" name="email" id="email" :value="$customer->email"
                        required />
                </div>
                <div class="mb-3">
                    <label for="payment_plan_id" class="form-label">Payment Plan</label>
                    {{-- {{ dd($customer) }} --}}
                    <select name="payment_plan_id" id="payment_plan_id" class="form-select" required>
                        <option value="">Select a Plan</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}"
                                {{ $customer->payment_plan_id == $plan->id ? 'selected' : '' }}>
                                {{ $plan->name }} - ${{ $plan->price }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <x-primary-button class="ms-3"> {{ __('Update') }} </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
