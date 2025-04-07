<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\BusinessIndustry;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BusinessIndustryTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/v1/businessIndustries';
    protected string $tableName = 'businessIndustries';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateBusinessIndustry(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = BusinessIndustry::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllBusinessIndustriesSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BusinessIndustry::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(BusinessIndustry::find(rand(1, 5))->name);
    }

    public function testViewAllBusinessIndustriesByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BusinessIndustry::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateBusinessIndustryValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewBusinessIndustryData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BusinessIndustry::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(BusinessIndustry::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateBusinessIndustry(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BusinessIndustry::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteBusinessIndustry(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BusinessIndustry::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, BusinessIndustry::count());
    }
    
}
