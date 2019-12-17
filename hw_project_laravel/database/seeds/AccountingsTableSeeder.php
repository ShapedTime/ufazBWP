<?php

use Illuminate\Database\Seeder;

class AccountingsTableSeeder extends Seeder
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
                'type' => 'income',
            ],
            [
                'type' => 'expense',
            ],
        ];
        foreach ($items as $item){
            \App\Accounting::updateOrCreate($item);
        }
    }
}
