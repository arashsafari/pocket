<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function testPaymentList()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/v1/payments');

        $response->assertOk()
            ->assertJsonStructure(['message', 'data', 'errors']);
    }

    public function testPaymentItemNonFound()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/v1/payments/' . fake()->randomDigit());

        $response->assertNotFound();
    }

    public function testPaymentItem()
    {
        $user = User::factory()->create();
        $payment = Payment::factory()->create();
        $response = $this->actingAs($user)->get('/api/v1/payments/' . $payment->unique_id);

        $response->assertOk()
            ->assertJsonStructure(['message', 'data', 'errors']);
    }

    public function testStorePaymentWhenAmountNotSend()
    {
        $user = User::factory()->create();

        $paymentData = [
            'amount' => null,
            'currency' => Str::random(5)
        ];

        $response = $this->actingAs($user)->post('/api/v1/payments', $paymentData);
        $response->assertUnprocessable();
    }

    public function testStorePaymentWhenCurrencyNotSend()
    {
        $user = User::factory()->create();

        $paymentData = [
            'amount' => fake()->randomDigit(),
            'currency' => null
        ];

        $response = $this->actingAs($user)->post('/api/v1/payments', $paymentData);
        $response->assertUnprocessable();
    }

    public function testStorePaymentWhenCurrencyNotString()
    {
        $user = User::factory()->create();

        $paymentData = [
            'amount' => fake()->randomDigit(),
            'currency' => fake()->randomDigit()
        ];

        $response = $this->actingAs($user)->post('/api/v1/payments', $paymentData);
        $response->assertUnprocessable();
    }

    public function testStorePaymentWhenCurrencyBigerThan10Character()
    {
        $user = User::factory()->create();

        $paymentData = [
            'amount' => fake()->randomDigit(),
            'currency' => Str::random(11)
        ];

        $response = $this->actingAs($user)->post('/api/v1/payments', $paymentData);
        $response->assertUnprocessable();
    }

    public function testStorePaymentWhenAllSuccessfully()
    {
        $user = User::factory()->create();

        $paymentData = [
            'amount' => fake()->randomDigit(),
            'currency' =>  Str::random(5)
        ];

        $response = $this->actingAs($user)->post('/api/v1/payments', $paymentData);
        $response->assertCreated();

        $this->assertDatabaseHas('payments', [
            'amount' => $paymentData['amount'],
            'currency' => $paymentData['currency'],
        ]);
    }

    // public function testStorePaymentWhenAttachFileNotFile()
    // {
    //     $paymentData = [
    //         'amount' => fake()->randomDigit(),
    //         'currency' => Str::random(5),
    //         'attach_file' => 'fake attach file',
    //     ];

    //     $response = $this->post('/api/v1/payments', $paymentData);
    //     $response->assertStatus(422);
    // }


    // public function testStorePaymentWhenAttachFileNotWrongMimes()
    // {
    //     $paymentData = [
    //         'amount' => fake()->randomDigit(),
    //         'currency' => Str::random(5),
    //         'attach_file' => file_get_contents(__DIR__ . '/../files/jpg-file.jpg')
    //     ];

    //     $response = $this->post('/api/v1/payments', $paymentData);
    //     $response->assertStatus(422);
    // }
}
