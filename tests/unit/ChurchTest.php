<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChurchTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_church_listing()
    {
        $church = factory(\App\Models\Church::class)->create();

        $this->json('GET', '/api/churches')->seeJson(['church' => $church->name]);
    }

    public function test_it_fetches_churches()
    {
        $user = factory(\App\Models\User::class)->create();
        $church = factory(\App\Models\Church::class)->create();

        $this->json('GET', '/api/church/' . $church->id)->seeJson(['error' => 'Unauthenticated.']);

        $this->seeStatusCode(401);

        $this->actingAs($user, 'api')->json('GET', '/api/church/' . $church->id)->seeJson(['church' => $church->name]);

        $this->seeStatusCode(200);
    }

    public function test_superadmin_can_create_a_church()
    {
        $user = factory(\App\Models\User::class)->create();

        $church = factory(\App\Models\Church::class)->make();

        $this->json('POST', '/api/church/', [
            'name' => $church->name
        ])->seeJson(['error' => 'Unauthenticated.']);

        $this->seeStatusCode(401);

        $this->actingAs($user, 'api')->json('POST', '/api/church/', [
            'name' => $church->name,
            'address' => $church->address,
            'city' => $church->city,
            'state' => $church->state,
            'zipcode' => $church->zipcode
        ])->seeJson(['church' => $church->name]);

        $this->seeStatusCode(200);
    }


}
