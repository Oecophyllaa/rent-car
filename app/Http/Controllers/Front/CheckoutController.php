<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
	public function index(Request $request, $slug)
	{
		$item = Item::with(['type', 'brand'])->whereSlug($slug)->firstOrFail();

		return view('checkout', [
			'item' => $item,
		]);
	}

	public function store(Request $request, $slug)
	{
		// Validate the request
		$request->validate([
			'name' => 'required|string|max:255',
			'start_date' => 'required',
			'end_date' => 'required',
			'address' => 'required|string|max:255',
			'city' => 'required|string|max:255',
			'zip' => 'required|string|max:5',
		]);

		// Format start_date and end_date from dd mm yy to timestamp
		$start_date = Carbon::createFromFormat('d m Y', $request->start_date);
		$end_date = Carbon::createFromFormat('d m Y', $request->end_date);

		// Count the number of days between start_date and end_date
		$days = $start_date->diffInDays($end_date);

		// Get the item
		$item = Item::whereSlug($slug)->firstOrFail();

		// Calculate the total price
		$total_price = $days * $item->price;

		// Add 10% tax
		$tax = $total_price * ($total_price * 0.10);

		// Create the booking
		$booking = $item->bookings()->create([
			'user_id' => auth()->user()->id,
			'name' => $request->name,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'address' => $request->address,
			'city' => $request->city,
			'zip' => $request->zip,
			'total_price' => $total_price,
		]);

		// Redirect to payment page
		return redirect()->route('front.payment', $booking->id);
	}
}
