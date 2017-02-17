<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChurchTest extends ApiTester
{
    use DatabaseMigrations;
    use Factory;
//
    /**
     * @test
     * A basic test example.
     *
     * @return void
     */
    public function it_gets_church_listing()
    {
        $this->make('Church');

        $this->json('GET', '/api/churches')
            ->assertResponseOk()
            ->seeJsonStructure(['data' => ['*' =>['id', 'name', 'address', 'city', 'state', 'zipcode', 'url']]]);
    }

    /** @test */
    public function it_401s_when_fetching_a_single_church_without_an_authenticated_user()
    {
        $user = factory(\App\Models\User::class)->create();

        $this->make('Church', ['name' => 'ASDFASDF']);

        $this->json('GET', '/api/church/1')
            ->seeJson(['error' => 'Unauthenticated.'])
            ->seeStatusCode(401);
    }

    /** @test */
    public function it_fetches_a_single_church_with_an_authenticated_user()
    {
        $user = factory(\App\Models\User::class)->create();

        $this->make('Church', ['name' => 'ASDFASDF']);

        $this->actingAs($user, 'api')->json('GET', '/api/church/1')
            ->seeJson(['name' => 'ASDFASDF'])
            ->seeStatusCode(200);
    }

    /** @test */
    public function super_admin_can_create_a_church()
    {
        $user1 = factory(\App\Models\User::class)->create();
        $church = factory(\App\Models\Church::class)->make();

        $this->json('POST', '/api/church/', ['name' => $church->name])
            ->seeJson(['error' => 'Unauthenticated.'])
            ->seeStatusCode(401);

        $this->actingAs($user1, 'api')->json('POST', '/api/church/', $this->getStub())
            ->seeJson(['message' => 'Not authorized to create a church'])
            ->seeStatusCode(403);

        $user2 = factory(\App\Models\User::class)->create();
        $user2->roles()->attach(1);

        $this->actingAs($user2, 'api')->json('POST', '/api/church/', $this->getStub())
            ->seeJson(['church' => $church->name])
            ->seeStatusCode(200);
    }


//    public function test_non_super_admin_cant_create_a_church()
//    {
//        $user = factory(\App\Models\User::class)->create();
//        $church = factory(\App\Models\Church::class)->make();
//        $user->roles()->attach(1);
//        $user->save();
////        $this->be($user);
//
//        $this->actingAs($user, 'api')->json('POST', '/api/church/', [
//            'name' => $church->name,
//            'address' => $church->address,
//            'city' => $church->city,
//            'state' => $church->state,
//            'zipcode' => $church->zipcode
//        ])->seeJson(['church' => $church->name]);
//
//        $this->dontSeeInDatabase('churches', [
//            'email' => 'my@email.com'
//        ]);
//    }


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

    public function getStub()
    {
        return [
            'name' => $this->fake->company(),
            'address' => $this->fake->streetAddress,
            'city' => $this->fake->city,
            'state' => $this->fake->stateAbbr,
            'zipcode' => $this->fake->postcode,
            'url' => $this->fake->url
        ];
    }

}
