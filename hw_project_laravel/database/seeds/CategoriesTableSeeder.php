<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'accounting_id' => 2,
                'name' => 'Housing',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Consumer Debt',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Transportation',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Personal Care',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Pets',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Taxes',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Givings',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Food',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Clothes',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Home Supplies',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Child Expenses',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Gifts',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Entertainment',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Healthcare',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Services/Memberships',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Insurance',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Utilities',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Savings',
            ],
            [
                'accounting_id' => 2,
                'name' => 'Miscellaneous',
            ],
            [
                'accounting_id' => 1,
                'name' => 'Scholarship',
            ],
            [
                'accounting_id' => 1,
                'name' => 'Salary',
            ],
            [
                'accounting_id' => 1,
                'name' => 'Miscelannous',
            ],
        ];
        foreach ($items as $item){
            \App\Category::updateOrCreate($item);
        }
    }
}
