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
    public function testCreateChurch()
    {
        $church = new \App\Models\Church();
        $church->name = "Test Church";

        $this->assertEquals('Test Church', $church->name);
    }

    public function test_it_fetches_churches()
    {
        // Given
        factory(\App\Models\Church::class, 3)->create();

        // When
        $churches = \App\Models\Church::all();

        // Then
        $this->assertEquals(3, $churches->count());
    }

    public function test_it_has_contacts()
    {
        // Given
        factory(\App\Models\User::class, 3)->create();

        factory(\App\Models\Church::class, 3)->create();
        $church = factory(\App\Models\Church::class)->create();
        $contact1 = factory(\App\Models\User::class)->create(['church_id' => $church->id]);
        $contact2 = factory(\App\Models\User::class)->create(['church_id' => $church->id]);

        // When
        $findchurch = \App\Models\Church::find(4);

        // Then
        $this->assertEquals(2, $findchurch->contacts->count());
        $this->assertEquals($contact1->name, $findchurch->contacts[0]->name);
        $this->assertEquals($contact1->address, $findchurch->contacts[0]->address);
        $this->assertEquals($contact1->address2, $findchurch->contacts[0]->address2);
        $this->assertEquals($contact1->city, $findchurch->contacts[0]->city);
        $this->assertEquals($contact1->state, $findchurch->contacts[0]->state);
        $this->assertEquals($contact1->zipcode, $findchurch->contacts[0]->zipcode);
        $this->assertEquals(0, $findchurch->contacts[0]->isSuperAdmin);
    }


}
