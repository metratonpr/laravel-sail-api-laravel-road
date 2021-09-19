<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_task_index()
    {
        //Arrange
        Sanctum::actingAs(User::factory()->create());
        Task::factory($total = $this->faker->numberBetween(15, 50))->create();
        //Act
        $response = $this->json('GET', route('tasks.index'));
        //Assert
        $response
            ->assertOk()
            ->assertJsonPath('meta.total', $total);
    }
    public function test_task_store()
    {
        //Arrange
        Sanctum::actingAs($user = User::factory()->create());
        $task = Task::factory()->make();
        //Act
        $response = $this->json('POST', route('tasks.store'), $task->toArray());
        //Assert
        // dd($user, $response);
        $response
            ->assertCreated();
        // ->assertJsonPath('data.user_id', $user->id);
        $this->assertDatabaseHas('tasks', $task->getAttributes());
    }
    public function test_task_update()
    {
        //Arrange
        Sanctum::actingAs(User::factory()->create());
        $task = Task::factory()->create();
        $taskFake = Task::factory()->make();
        //Act
        $response = $this->json('PUT', route('tasks.update', $task), $taskFake->toArray());
        //Assert
        $response->assertOk();
        $this->assertDatabaseHas('tasks', $taskFake->getAttributes());
    }
    public function test_task_show()
    {
        //Arrange
        Sanctum::actingAs(User::factory()->create());
        $task = Task::factory()->create();
        //Act
        $response = $this->json('GET', route('tasks.show', $task));
        //Assert
        $response
            ->assertOk()
            ->assertJsonPath('data.user_id', $task->user_id);;
    }

    public function test_task_destroy()
    {
        //Arrange
        Sanctum::actingAs(User::factory()->create());
        $task = Task::factory()->create();
        //Act
        $response = $this->json('DELETE', route('tasks.destroy', $task));
        //Assert
        $response->assertNoContent();
        $this->assertDatabaseMissing('tasks', $task->getAttributes());
    }

    public function test_task_cannot_destroy()
    {
        //Arrange
        Sanctum::actingAs($user = User::factory()->create());
        $user_fake = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user_fake->id
        ]);
        //Act

        $response = $this->json('DELETE', route('tasks.destroy', $task));
      
       
        $response->assertForbidden();
        
    }
}
