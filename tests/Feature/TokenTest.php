<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TokenTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_token_store()
    {
        //Arramge
        Sanctum::actingAs(User::factory()->create());
        //Act
        $response =$this->json('POST',route('tokens.store'),['device' =>'test']);
        //Assert
        $response
        ->assertOk()
        ->assertJsonStructure(['token']);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_token_destroy()
    {
        //Arramge
        Sanctum::actingAs($user = User::factory()->create());
        $token = $user->createToken('test');
        //Act
        $response =$this->json('DELETE',route('tokens.destroy',$token->accessToken->id));
        //Assert
        $response
        ->assertNoContent();
        
    }
}
