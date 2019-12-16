<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RelationshipController
 */
class RelationshipControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('relationship.create'));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $relationship = factory(\App\Relationship::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->delete(route('relationship.destroy', [$relationship]));

        $response->assertRedirect(back());
        $this->assertDeleted($relationship);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $relationship = factory(\App\Relationship::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('relationship.edit', [$relationship]));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('relationship.index'));

        $response->assertOk();
        $response->assertViewIs('relationships.index');
        $response->assertViewHas('relationships');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $relationship = factory(\App\Relationship::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('relationship.show', [$relationship]));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->post(route('relationship.store'), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $relationship = factory(\App\Relationship::class)->create();
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->put(route('relationship.update', [$relationship]), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    // test cases...
}
