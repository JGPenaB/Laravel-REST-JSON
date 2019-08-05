<?php

use Illuminate\Database\Seeder;

class AccountsModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Users::all()->each(function($user) {
			factory(App\Models\Accounts::class,1)->create(["users_id" => $user->id]);
		});
    }
}
