<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Users;
use App\Models\Accounts;
use App\Models\Transactions;

class TransactionsTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
	use WithFaker;
	
	protected $resourceType = 'transactions';
	
	public function testTransactionSearch()
    {
		$user = factory(Users::class)->create();
		$account = factory(Accounts::class)->create(['users_id' => $user->getRouteKey()]);
        factory(Transactions::class, 10)->create(['accounts_id' => $account->getRouteKey()]);
		
        $this->doSearch([
            'page' => ['number' => 1, 'size' => 10],
        ])->assertSearchedMany();
    }
	
	public function testTransactionCreate()
	{
		$user = factory(Users::class)->create();
		$account = factory(Accounts::class)->create(['users_id' => $user->getRouteKey()]);
		$transaction = factory(Transactions::class)->make();
		
		$data = [
            'type' => 'transactions',
            'attributes' => [
                'amount' => $transaction->amount,
                'description' => $transaction->description,
            ],
			'relationships' => [
				'accounts' => [
					'data' => [
						'type' => 'accounts',
						'id' => (string) $account->getKey(),
					]
				]
			]
        ];
		
		$this
            ->doCreate($data)
			->assertJson([
            'data' => [
                'type' => 'transactions',
				]
            ]);
			
		$this->assertDatabaseHas('transactions', [
            'accounts_id' => $account->getKey(),
        ]);
		
	}
	
	public function testTransactionUpdateForbidden()
	{
		$user = factory(Users::class)->create();
		$account = factory(Accounts::class)->create(['users_id' => $user->getRouteKey()]);
		$transaction = factory(Transactions::class)->create(['accounts_id' => $account->getRouteKey()]);
		
		$data = [
            'type' => 'transactions',
			'id' => (string) $transaction -> getKey(),
            'attributes' => [
                'amount' => '12000',
                'description' => 'SuperTesting',
            ],
			'relationships' => [
				'accounts' => [
					'data' => [
						'type' => 'accounts',
						'id' => (string) $account->getKey(),
					]
				]
			]
        ];
		
		$this
            ->doUpdate($data)
			->assertStatus(405);
		
	}
	
	public function testTransactionDeleteForbidden()
	{
		$user = factory(Users::class)->create();
		$account = factory(Accounts::class)->create(['users_id' => $user->getRouteKey()]);
		$transaction = factory(Transactions::class)->create(['accounts_id' => $account->getKey()]);
		
		$this->doDelete($transaction)->assertStatus(405);
	}
 
}
