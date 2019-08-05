<?php

use Illuminate\Database\Seeder;

class TransactionsModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Accounts::all()->each(function($account) {
			factory(App\Models\Transactions::class,rand(5,25))->create(["accounts_id" => $account->id]);
		});
    }
}
