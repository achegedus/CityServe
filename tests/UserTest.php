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
        $this->assertEquals(4, $users->count());
        $this->assertEquals($contact1->name, $users[3]->name);
        $this->assertEquals($contact1->address, $users[3]->address);
        $this->assertEquals($contact1->address2, $users[3]->address2);
        $this->assertEquals($contact1->city, $users[3]->city);
        $this->assertEquals($contact1->state, $users[3]->state);
        $this->assertEquals($contact1->zipcode, $users[3]->zipcode);
        $this->assertEquals(0, $users[3]->isSuperAdmin);
    }


    public function test_admin_user()
    {
        // Given
        factory(\App\Models\User::class, 3)->create();
        $contact1 = factory(\App\Models\User::class)->create(['isSuperAdmin' => true]);

        $user = \App\Models\User::find(4);
        $this->assertEquals(1, $user->isSuperAdmin);

        $user = \App\Models\User::find(3);
        $this->assertEquals(0, $user->isSuperAdmin);
    }


    public function test_church_primary_contact()
    {
        // Given
        factory(\App\Models\User::class, 3)->create();
        $contact1 = factory(\App\Models\User::class)->create(['isChurchPrimary' => true]);

        $user = \App\Models\User::find(4);
        $this->assertEquals(1, $user->isChurchPrimary);

        $user = \App\Models\User::find(3);
        $this->assertEquals(0, $user->isChurchPrimary);

        // only allow one primary contact
//        $this->assert

        $contact2 = factory(\App\Models\User::class)->create(['isChurchPrimary' => true]);
    }

}
