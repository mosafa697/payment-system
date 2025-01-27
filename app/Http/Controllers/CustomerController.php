<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlan;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customersQuery = User::with('paymentPlan')->customers();
        if ($request->has('search')) {
            $search = $request->input('search');
            $customersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $customers = $customersQuery->get();

        return view('customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(User $customer)
    {
        $plans = PaymentPlan::all();

        return view('customers.edit', compact('customer', 'plans'));
    }

    public function update(Request $request, User $customer)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'payment_plan_id' => 'required|exists:payment_plans,id',
        ]);

        $customer->update($validatedData);

        return redirect()->back()->with('success', 'Customer updated successfully');
    }

    public function destroy(User $customer)
    {
        $customer->delete();

        return redirect()->back()->with('success', 'Customer Deleted successfully');
    }

    public function activationToggle(User $customer)
    {
        $customer->update(['is_active' => !$customer->is_active]);

        return redirect()->back()->with('success', 'Customer updated successfully');
    }
}
