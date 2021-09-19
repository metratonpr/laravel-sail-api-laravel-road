<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        Task::factory($total = $this->faker->numberBetween(15, 50))->create();
        //Act
        $response = $this->json('GET', route('tasks.index'));
        //Assert
        $response
            ->assertOk()
            ->assertJsonPath('total', $total);
    }
    public function test_task_store()
    {
        //Arrange
        //Act
        //Assert
    }
    public function test_task_update()
    {
        //Arrange
        //Act
        //Assert
    }
    public function test_task_destroy()
    {
        //Arrange
        //Act
        //Assert
    }
}
