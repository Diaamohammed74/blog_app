<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\BillingCycle;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BillingCycleTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/v1/billingCycles';
    protected string $tableName = 'billingCycles';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateBillingCycle(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = BillingCycle::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllBillingCyclesSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BillingCycle::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(BillingCycle::find(rand(1, 5))->name);
    }

    public function testViewAllBillingCyclesByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BillingCycle::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateBillingCycleValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewBillingCycleData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BillingCycle::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(BillingCycle::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateBillingCycle(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BillingCycle::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteBillingCycle(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BillingCycle::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, BillingCycle::count());
    }
    
}
