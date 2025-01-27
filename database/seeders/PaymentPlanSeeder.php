<?php

namespace Database\Seeders;

use App\Models\PaymentPlan;
use Illuminate\Database\Seeder;

class PaymentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentPlans = [
            [
                'name' => 'Monthly',
                'description' => 'Monthly subscription',
                'price' => 10
            ],
            [
                'name' => 'Yearly',
                'description' => 'Yearly subscription',
                'price' => 50
            ],
            [
                'name' => 'Free',
                'description' => 'Free subscription',
                'price' => 0
            ],
        ];

        PaymentPlan::insert($paymentPlans);
    }
}
