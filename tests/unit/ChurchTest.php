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

//    public function test_super_admin_can_create_a_church()
//    {
//        $user1 = factory(\App\Models\User::class)->create();
//        $church = factory(\App\Models\Church::class)->make();
//
//        $this->json('POST', '/api/church/', [
//            'name' => $church->name
//        ])->seeJson(['error' => 'Unauthenticated.']);
//        $this->seeStatusCode(401);
//
//        $this->actingAs($user1, 'api')->json('POST', '/api/church/', [
//            'name' => $church->name,
//            'address' => $church->address,
//            'city' => $church->city,
//            'state' => $church->state,
//            'zipcode' => $church->zipcode
//        ])->seeJson(['message' => 'Not authorized to create a church']);
//        $this->seeStatusCode(403);
//
//        $user2 = factory(\App\Models\User::class)->create();
//        $user2->roles()->attach(1);
//        $this->actingAs($user2, 'api')->json('POST', '/api/church/', [
//            'name' => $church->name,
//            'address' => $church->address,
//            'city' => $church->city,
//            'state' => $church->state,
//            'zipcode' => $church->zipcode
//        ])->seeJson(['church' => $church->name]);
//        $this->seeStatusCode(200);
//    }


    public function test_non_super_admin_cant_create_a_church()
    {
        $user = factory(\App\Models\User::class)->create();
        $church = factory(\App\Models\Church::class)->make();
        $user->roles()->attach(1);
        $user->save();
//        $this->be($user);

        $this->actingAs($user, 'api')->json('POST', '/api/church/', [
            'name' => $church->name,
            'address' => $church->address,
            'city' => $church->city,
            'state' => $church->state,
            'zipcode' => $church->zipcode
        ])->seeJson(['church' => $church->name]);

        $this->dontSeeInDatabase('churches', [
            'email' => 'my@email.com'
        ]);
    }


//    public function test_super_admin_can_update_a_church()
//    {
//        $user = factory(\App\Models\User::class)->create();
//        $church = factory(\App\Models\Church::class)->create();
//
//        $this->json('PUT', '/api/church/' . $church->id, [
//            'name' => "ABC CHURCH",
//            'address' => $church->address,
//            'city' => $church->city,
//            'state' => $church->state,
//            'zipcode' => $church->zipcode
//        ])->seeJson(['error' => 'Unauthenticated.']);
//        $this->seeStatusCode(401);
//
//        $user->roles()->detach();
//        $this->actingAs($user, 'api')->json('PUT', '/api/church/' . $church->id, [
//            'name' => "ABC CHURCH",
//            'address' => $church->address,
//            'city' => $church->city,
//            'state' => $church->state,
//            'zipcode' => $church->zipcode
//        ])->seeJson(['message' => 'Not authorized to update a church']);
//        $this->seeStatusCode(403);
//
//        $user = factory(\App\Models\User::class)->create();
//        $user->roles()->attach(1);
//        $this->actingAs($user, 'api')->json('PUT', '/api/church/' . $church->id, [
//            'name' => "ABC CHURCH",
//            'address' => $church->address,
//            'city' => $church->city,
//            'state' => $church->state,
//            'zipcode' => $church->zipcode
//        ])->seeJson(['church' => "ABC CHURCH"]);
//        $this->seeStatusCode(200);
//    }


}