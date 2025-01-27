<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentPlanController extends Controller
{
    public function index(User $user)
    {
        $plans = PaymentPlan::all();

        return view('payment-plans.index', compact('user', 'plans'));
    }

    public function assign(Request $request, User $user)
    {
        $request->validate([
            'plan_id' => 'required|exists:payment_plans,id',
        ]);

        $user->update([
            'payment_plan_id' => $request->plan_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
