<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProjectsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_can_see_all_projects(): void
    {
        $this->withoutExceptionHandling();


        /* $user = User::factory(3)->create();

        dd($user->toArray()); */

        $projects = Project::factory(2)->create();

        $response = $this->get(route("projects.index"));

        $response->assertStatus(200);

        $response->assertViewIs('projects.index');

        $response->assertViewHas('projects');

        $response->assertSee($projects->pluck("title")->all());
    }

    public function test_can_see_all_individual_projects() {
        $this->withoutExceptionHandling();

        $project = Project::create([
            "title" => "My New Project",
            "slug" => "my-new-project",
            "description" => "Description of My New Project"
        ]);

        $response = $this->get(route("projects.index"));

        $response->assertStatus(200);
        
        $response->assertSee($project->title);
    }
}
