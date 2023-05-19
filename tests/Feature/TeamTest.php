<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{

    /**
     * @test
     */
    public function it_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);
        $this->assertEquals('Acme', $team->name);
    }

    /**
     * @test
     */
    public function it_may_add_members()
    {
        $team = Team::factory()->create();
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
    }

    /**
     * @test
     */
    public function it_has_a_maximum_size()
    {
        $team = Team::factory()->create(['size' => 2]);
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $user3 = User::factory()->create();

        $team->add($user);
        $team->add($user2);

        $this->expectException(\Exception::class);
        $team->add($user3);
    }

    public function a_team_can_add_multiple_members_at_once()
    {
        $team = Team::factory()->create();
        $users = User::factory(2)->create();

        $team->add($users);
        $this->assertEquals(2, $team->count());
    }
}
