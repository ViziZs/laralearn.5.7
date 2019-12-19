<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_team()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $this->post('/teams', [
           'name' => 'MyTeam'
        ]);

        $this->assertDatabaseHas('teams', ['name' => 'Acme']);
    }
}
