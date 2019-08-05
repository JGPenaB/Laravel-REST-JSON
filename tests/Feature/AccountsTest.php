<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Users;
use App\Models\Accounts;

class AccountsTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
	use WithFaker;
	
	protected $resourceType = 'accounts';
	
	public function testAccountSearch()
    {
		$user = factory(Users::class)->create();
        factory(Accounts::class, 1)->create(['users_id' => $user->getRouteKey()]);
		
        $this->doSearch([
            'page' => ['number' => 1, 'size' => 10],
        ])->assertSearchedMany();
    }
	
	public function testAccountCreate()
	{
		$user = factory(Users::class)->create();
		$account = factory(Accounts::class)->make();
		
		$data = [
            'type' => 'accounts',
            'attributes' => [
                'account_type' => $account->account_type,
                'balance' => $account->balance,
				'is_active' => $account->is_active
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
                'type' => 'accounts',
				]
            ]);
			
		$this->assertDatabaseHas('accounts', [
            'users_id' => $user->getKey(),
        ]);
		
	}
	
	public function testAccountUpdate()
	{
		$user = factory(Users::class)->create();
		$account = factory(Accounts::class)->create(['users_id' => $user->getKey()]);
		
		$data = [
            'type' => 'accounts',
			'id' => (string) $account -> getKey(),
            'attributes' => [
                'account_type' => 'deposit',
                'balance' => '12345',
				'is_active' => true
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
            'type' => 'accounts',
            'attributes' => [
                'account_type' => 'deposit',
                'balance' => '12345',
				'is_active' => true
				]
			]);
			
		$this->assertDatabaseHas('accounts', [
            'users_id' => $user->getKey(),
        ]);
		
	}
	
	public function testAccountDelete()
	{
		$user = factory(Users::class)->create();
		$account = factory(Accounts::class)->create(['users_id' => $user->getKey()]);
		
		$this->doDelete($account)->assertDeleted();
		
		$this->assertDatabaseMissing('accounts', ['id' => $account->getKey()]);
	}
 
}
