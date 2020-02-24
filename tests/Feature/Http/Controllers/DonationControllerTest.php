<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Registration;

/**
 * @see \App\Http\Controllers\DonationController
 */
class DonationControllerTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function agc_returns_an_ok_response()
    {   // agc reports available from 2007 to 2020
        $user = $this->createUserWithPermission('show-donation');
        $year = $this->faker->numberBetween(2007,2020);
        $response = $this->actingAs($user)->get('agc/'.$year);

        $response->assertOk();
        $response->assertViewIs('donations.agc');
        $response->assertViewHas('donations');
        $response->assertViewHas('total');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
     public function agc_returns_404()
    {
        $user = $this->createUserWithPermission('show-donation');
        $year = $this->faker->numberBetween(2000,2005);
        $response = $this->actingAs($user)->get('agc/'.$year);

        $response->assertNotFound();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function create_returns_an_ok_response()
    {
        $user = $this->createUserWithPermission('create-donation');
        $response = $this->actingAs($user)->get(route('donation.create'));

        $response->assertOk();
        $response->assertViewIs('donations.create');
        $response->assertViewHas('retreats');
        $response->assertViewHas('donors');
        $response->assertViewHas('descriptions');
        $response->assertViewHas('payment_methods');
        $response->assertViewHas('defaults');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $user = $this->createUserWithPermission('delete-donation');
        $donation = factory(\App\Donation::class)->create();
        $contact = \App\Contact::find($donation->contact_id);

        $response = $this->actingAs($user)->delete(route('donation.destroy', [$donation]));

        $response->assertRedirect($contact->contact_url);

        $this->assertSoftDeleted($donation);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function edit_returns_an_ok_response()
    {
        $user = $this->createUserWithPermission('update-donation');
        $donation = factory(\App\Donation::class)->create();

        $response = $this->actingAs($user)->get(route('donation.edit', [$donation]));

        $response->assertOk();
        $response->assertViewIs('donations.edit');
        $response->assertViewHas('donation');
        $response->assertViewHas('descriptions');
        $response->assertViewHas('defaults');
        $response->assertViewHas('retreats');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $user = $this->createUserWithPermission('show-donation');

        $response = $this->actingAs($user)->get(route('donation.index'));

        $response->assertOk();
        $response->assertViewIs('donations.index');
        $response->assertViewHas('donations');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function overpaid_returns_an_ok_response()
    {
        $user = $this->createUserWithPermission('show-donation');
        $response = $this->actingAs($user)->get('donation/overpaid');

        $response->assertOk();
        $response->assertViewIs('donations.overpaid');
        $response->assertViewHas('overpaid');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function retreat_payments_update_returns_an_ok_response()
    {   // create a retreat with 1-10 participants
        // update retreatant payments
        $user = $this->createUserWithPermission('update-donation');

        $retreat = factory(\App\Retreat::class)->create([
            'description' => 'Retreat Payments Update Test',
        ]);
        $participants = factory(\App\Registration::class,$this->faker->numberBetween(5,10))->create([
            'event_id' => $retreat->id,
            'canceled_at' => null,
        ]);
        $donations = array();

        $participants = \App\Registration::whereEventId($retreat->id)->get();
        foreach ($participants as $participant) {
            $donations[$participant->id]['id'] = $participant->id;
            $donations[$participant->id]['pledge'] = $this->faker->numberBetween(100,200);
            $donations[$participant->id]['paid'] = $this->faker->numberBetween(100,200);
            $donations[$participant->id]['method'] = 'Credit Card';
            $donations[$participant->id]['idnumber'] = $this->faker->randomNumber(6);
            $donations[$participant->id]['terms'] = $this->faker->sentence;
        }
        $random_participant = $participants->random();

        $response = $this->actingAs($user)->post(route('retreat.payments.update'), [
            'event_id' => $retreat->id,
            'donations' => $donations,
        ]);
        $response->assertRedirect(action('RetreatController@show', $retreat->id));
        $this->assertDatabaseHas('Donations', [
          'event_id' => $retreat->id,
          'contact_id' => $random_participant->contact_id,
        ]);

    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $user = $this->createUserWithPermission('show-donation');
        // create a payment rather than just a donation so that things like percent_paid
        $payment = factory(\App\Payment::class)->create();

        $response = $this->actingAs($user)->get(route('donation.show', [$payment->donation_id]));

        $response->assertOk();
        $response->assertViewIs('donations.show');
        $response->assertViewHas('donation');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $user = $this->createUserWithPermission('create-donation');
        $donor = factory(\App\Contact::class)->create();
        $event = factory(\App\Retreat::class)->create();
        $start_date_only = $this->faker->dateTimeBetween('this week','+7 days');

        $response = $this->actingAs($user)->post(route('donation.store'), [
            // TODO: send request data
            'donor_id' => $donor->id,
            'event_id' => $event->id,
            'donation_date' => $this->faker->dateTime(),
            'payment_date' => $this->faker->dateTime(),
            'donation_amount' => $this->faker->randomFloat(2,0,100000),
            'payment_amount' => $this->faker->randomFloat(2,0,100000),
            'payment_idnumber' => $this->faker->randomNumber(4),
            'donation_install' => $this->faker->randomFloat(2,0,100000),
            // TODO: figure out and clean up start and end dates - commenting out for now
            // 'start_date_only' => $start_date_only,
            // 'end_date_only' => $this->faker->dateTimeBetween($start_date_only, strtotime('+7 days')),

        ]);
        // dd($response);
        $response->assertRedirect($donor->contact_url.'#donations');
        $this->assertDatabaseHas('Donations', [
          'contact_id' => $donor->id,
          'event_id' => $event->id,
        ]);


        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_validates_with_a_form_request()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DonationController::class,
            'store',
            \App\Http\Requests\StoreDonationRequest::class
        );
    }

    /**
     * @test
     */
    public function update_returns_an_ok_response()
    {
        $user = $this->createUserWithPermission('update-donation');
        $event = factory(\App\Retreat::class)->create();
        $donation = factory(\App\Donation::class)->create();
        $new_contact = factory(\App\Contact::class)->create();
        $description = \App\DonationType::get()->random();
        $start_date = $this->faker->dateTimeBetween('this week','+7 days');
        $end_date = $this->faker->dateTimeBetween($start_date, strtotime('+7 days'));

        $original_amount = $donation->donation_amount;
        $response = $this->actingAs($user)->put(route('donation.update', [$donation]), [
            'donation_description' => $description->id,
            'donor_id' => $new_contact->id,
            'event_id' => $event->id,
            'donation_date' => $this->faker->dateTime,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'donation_amount' => $this->faker->randomFloat(2,0,100000),
            'notes1' => $this->faker->text,
            'notes' => $this->faker->text,
            'terms' => $this->faker->text,
            'donation_install' => $this->faker->randomFloat(2,0,100000),
        ]);

        // TODO: removed space on Thank You field in Donation table then add to unit test
        // dd($response);
        $response->assertRedirect(action('DonationController@show', $donation->donation_id));

        $updated_donation = \App\Donation::find($donation->donation_id);
        $this->assertEquals($updated_donation->event_id,$event->id);
        $this->assertNotEquals($updated_donation->donation_amount, $original_amount);
    }

    /**
     * @test
     */
    public function update_validates_with_a_form_request()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DonationController::class,
            'update',
            \App\Http\Requests\UpdateDonationRequest::class
        );
    }

    // test cases...
}
