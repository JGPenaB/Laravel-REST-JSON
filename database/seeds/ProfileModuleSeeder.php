<?php

use Illuminate\Database\Seeder;

class ProfileModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Users::all()->each(function($user) {
			factory(App\Models\Profiles::class,1)->create(["users_id" => $user->id]);
		});
    }
}
