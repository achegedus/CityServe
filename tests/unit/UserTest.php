<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        // Given
        factory(\App\Models\User::class, 3)->create();
        $contact1 = factory(\App\Models\User::class)->create();

        // When
        $users = \App\Models\User::all();

        // Then
        $this->assertEquals(5, $users->count());
        $this->assertEquals($contact1->name, $users[4]->name);
        $this->assertEquals($contact1->address, $users[4]->address);
        $this->assertEquals($contact1->address2, $users[4]->address2);
        $this->assertEquals($contact1->city, $users[4]->city);
        $this->assertEquals($contact1->state, $users[4]->state);
        $this->assertEquals($contact1->zipcode, $users[4]->zipcode);
        $this->assertEquals(false, $users[4]->isSuperAdmin());
        $this->assertEquals(false, $users[4]->isChurchContact());
        $this->assertEquals(false, $users[4]->isVolunteer());
        $this->assertEquals(false, $users[4]->isVolunteerGroupContact());
        $this->assertEquals(false, $users[4]->isReviewer());
    }


    public function test_admin_user()
    {
        // Given
        factory(\App\Models\User::class, 3)->create();
        $contact1 = factory(\App\Models\User::class)->create();
        $contact1->roles()->attach(1);

        $user = \App\Models\User::find(5);
        $this->assertEquals(true, $user->isSuperAdmin());

        $user = \App\Models\User::find(4);
        $this->assertEquals(false, $user->isSuperAdmin());
    }


    public function test_church_primary_contact()
    {
        // Given
        factory(\App\Models\User::class, 3)->create();
        $contact1 = factory(\App\Models\User::class)->create();
        $contact1->roles()->attach(3);

        $user = \App\Models\User::find(5);
        $this->assertEquals(1, $user->isChurchContact());

        $user = \App\Models\User::find(4);
        $this->assertEquals(0, $user->isChurchContact());

        // only allow one primary contact
//        $this->assert

        $contact2 = factory(\App\Models\User::class)->create();
    }

}
