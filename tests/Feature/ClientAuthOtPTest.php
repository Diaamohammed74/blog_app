<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ClientAuthOtP;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientAuthOtPTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/v1/clientAuthOtPs';
    protected string $tableName = 'clientAuthOtPs';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateClientAuthOtP(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = ClientAuthOtP::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllClientAuthOtPsSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        ClientAuthOtP::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(ClientAuthOtP::find(rand(1, 5))->name);
    }

    public function testViewAllClientAuthOtPsByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        ClientAuthOtP::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateClientAuthOtPValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewClientAuthOtPData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        ClientAuthOtP::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(ClientAuthOtP::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateClientAuthOtP(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        ClientAuthOtP::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteClientAuthOtP(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        ClientAuthOtP::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, ClientAuthOtP::count());
    }
    
}
