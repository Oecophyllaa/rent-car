<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Midtrans\Config;

class PaymentController extends Controller
{
	public function index(Request $request, $bookingId)
	{
		$booking = Booking::with('item.brand', 'item.type')->findOrFail($bookingId);

		return view('payment', [
			'booking' => $booking,
		]);
	}

	public function update(Request $request, $bookingId)
	{
		// Validate
		$request->validate([
			'payment_method' => 'required',
		]);

		// Load booking data
		$booking = Booking::findOrFail($bookingId);

		// Set payment method data
		$booking->payment_method = $request->payment_method;

		// Handle midtrans payment_method
		if ($request->payment_method == 'midtrans') {
			// Config midtrans
			Config::$serverKey = config('services.midtrans.serverKey');
			Config::$isProduction = config('services.midtrans.isProduction');
			Config::$isSanitized = config('services.midtrans.isSanitized');
			Config::$is3ds = config('services.midtrans.is3ds');

			// Get USD to IDR rate from https://www.exchangerate-api.com/ using Guzzle
			$client = new \GuzzleHttp\Client();
			$response = $client->request('GET', 'https://api.exchangerate-api.com/v4/latest/USD');
			$body = $response->getBody();
			$rate = json_decode($body)->rates->IDR;

			// Convert to IDR
			$totalPrice = $booking->total_price * $rate;

			// Create Midtrans Params
			// Docs : https://api-docs.midtrans.com/#charge-a-credit-card
			$midtransParams = [
				'transaction_details' => [
					'order_id' => $booking->id,
					'gross_amount' => (int) $totalPrice,
				],
				'customer_details' => [
					'first_name' => $booking->customer_name,
					'email' => $booking->customer_email,
				],
				'enabled_payments' => ['gopay', 'bank_transfer']
			];

			// Get Snap Payment Page URL
			$paymentUrl = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;

			// Save payment url to booking
			$booking->payment_url = $paymentUrl;

			// Save booking
			$booking->save();

			// Redirect to payment url
			return redirect($paymentUrl);
		}

		return redirect()->route('front.index');
	}

	public function success(Request $request)
	{
		return view('success');
	}
}
