<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Users;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
	use WithFaker;
	
	protected $resourceType = 'users';
	
	public function testUserSearch()
    {
        factory(Users::class, 2)->create();
		
        $this->doSearch([
            'page' => ['number' => 1, 'size' => 10],
        ])->assertSearchedMany();
    }
	
	public function testUserCreate()
	{
		$user = factory(Users::class)->make();
		
		$data = [
            'type' => 'users',
            'attributes' => [
                'email' => $user->email,
                'password' => $user->password,
            ]
        ];
		
		$this
            ->doCreate($data)
			->assertJson([
            'data' => [
				'type' => 'users',
				]
			]);
			
		$this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
		
	}
	
	public function testUserUpdate()
	{
		$user = factory(Users::class)->create();
		
		$data = [
            'type' => 'users',
			'id' => (string) $user->getRouteKey(),
            'attributes' => [
                'email' => "SuperTesting@hotmail.com",
                'password' => "SuperPasswordTest",
            ]
        ];
		
		$this
            ->doUpdate($data)
			->assertUpdated([
            'type' => 'users',
            'attributes' => [
				'email' => "SuperTesting@hotmail.com",
				]
			]);
			
		$this->assertDatabaseHas('users', [
            'email' => "SuperTesting@hotmail.com",
        ]);
		
	}
	
	public function testUserUpdateForbidden()
	{
		$user1 = factory(Users::class)->create();
		$user2 = factory(Users::class)->create();
		
		$data = [
            'type' => 'users',
			'id' => (string) $user2->getRouteKey(),
            'attributes' => [
                'email' => $user1->email,
                'password' => $user1->password,
            ]
        ];
		
		$this
            ->doUpdate($data)
			->assertStatus(422);
		
	}
	
	public function testUserDelete()
	{
		$user = factory(Users::class)->create();
		
		$this->doDelete($user)->assertDeleted();
		
		$this->assertDatabaseMissing('users', ['id' => $user->getKey()]);
	}
 
}
