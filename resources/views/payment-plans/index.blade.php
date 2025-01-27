<x-guest-layout>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title text-center">Welcome, {{ $user->name }}</h2>
        </div>
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Choose Your Payment Plan</h3>
            <form action="{{ route('payment-plan.assign', ['user' => $user]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <select name="plan_id" id="plan_id" class="form-select" style="width: -webkit-fill-available;">
                        <option value="">Select a Plan</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}">
                                {{ $plan->name }} - {{ $plan->price }}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <br>
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
