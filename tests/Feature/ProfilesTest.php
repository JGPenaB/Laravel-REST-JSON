<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Users;
use App\Models\Profiles;

class ProfilesTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
	use WithFaker;
	
	protected $resourceType = 'profiles';
	
	public function testProfileSearch()
    {
		$user = factory(Users::class)->create();
        factory(Profiles::class, 1)->create(['users_id' => $user->getRouteKey()]);
		
        $this->doSearch([
            'page' => ['number' => 1, 'size' => 10],
        ])->assertSearchedMany();
    }
	
	public function testProfileCreate()
	{
		$user = factory(Users::class)->create();
		$profile = factory(Profiles::class)->make();
		
		$data = [
            'type' => 'profiles',
            'attributes' => [
                'first_name' => $profile->first_name,
                'last_name' => $profile->last_name,
				'address' => $profile->address,
				'country' => "United States",
				'phone_number' => '302983484298',
				'zip_code' => '48593485934',
            ],
			'relationships' => [
				'users' => [
					'data' => [
						'type' => 'users',
						'id' => (string) $user->getKey(),
					]
				]
			]
        ];
		
		$this
            ->doCreate($data)
			->assertJson([
            'data' => [
                'type' => 'profiles',
				]
            ]);
			
		$this->assertDatabaseHas('profiles', [
            'users_id' => $user->getKey(),
        ]);
		
	}
	
	public function testProfileUpdate()
	{
		$user = factory(Users::class)->create();
		$profile = factory(Profiles::class)->create(['users_id' => $user->getKey()]);
		
		$data = [
            'type' => 'profiles',
			'id' => (string) $profile -> getKey(),
            'attributes' => [
                'first_name' => 'SuperFirstName',
                'last_name' => 'SuperLastName',
				'address' => 'SuperAddress',
				'country' => 'SuperCountry',
				'phone_number' => '12348547588',
				'zip_code' => '38372648372',
            ],
			'relationships' => [
				'users' => [
					'data' => [
						'type' => 'users',
						'id' => (string) $user->getKey(),
					]
				]
			]
        ];
		
		$this
            ->doUpdate($data)
			->assertUpdated([
            'type' => 'profiles',
            'attributes' => [
                'first_name' => 'SuperFirstName',
                'last_name' => 'SuperLastName',
				'address' => 'SuperAddress',
				'country' => 'SuperCountry',
				'phone_number' => '12348547588',
				'zip_code' => '38372648372',
				]
			]);
			
		$this->assertDatabaseHas('profiles', [
            'users_id' => $user->getKey(),
        ]);
		
	}
	
	public function testProfileDelete()
	{
		$user = factory(Users::class)->create();
		$profile = factory(Profiles::class)->create(['users_id' => $user->getKey()]);
		
		$this->doDelete($profile)->assertDeleted();
		
		$this->assertDatabaseMissing('profiles', ['id' => $profile->getKey()]);
	}
 
}
