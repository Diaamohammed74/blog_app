<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\EnterpriseAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EnterpriseAccountTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/v1/enterpriseAccounts';
    protected string $tableName = 'enterpriseAccounts';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateEnterpriseAccount(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = EnterpriseAccount::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllEnterpriseAccountsSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        EnterpriseAccount::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(EnterpriseAccount::find(rand(1, 5))->name);
    }

    public function testViewAllEnterpriseAccountsByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        EnterpriseAccount::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateEnterpriseAccountValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewEnterpriseAccountData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        EnterpriseAccount::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(EnterpriseAccount::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateEnterpriseAccount(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        EnterpriseAccount::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteEnterpriseAccount(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        EnterpriseAccount::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, EnterpriseAccount::count());
    }
    
}
