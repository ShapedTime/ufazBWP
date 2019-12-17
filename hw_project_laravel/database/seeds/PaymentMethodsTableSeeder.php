<?php

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $items = [
            [
                'type' => 'Cash',
                'icon' => 'cash',
            ],
            [
                'type' => 'Credit Card',
                'icon' => 'credit-card',
            ],
            [
                'type' => 'Debit Card',
                'icon' => 'credit-card',
            ],
            [
                'type' => 'Bank Account',
                'icon' => 'bank-account',
            ],
            [
                'type' => 'EWallet',
                'icon' => 'ewallet',
            ],
        ];
        foreach ($items as $item){
            \App\PaymentMethod::updateOrCreate($item);
        }
    }
}
