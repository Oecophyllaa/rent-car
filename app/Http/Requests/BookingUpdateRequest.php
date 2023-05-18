<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingUpdateRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'name' => 'nullable|string|max:255',
			'address' => 'nullable|string',
			'city' => 'nullable|string|max:255',
			'zip' => 'nullable|string|max:255',
			'status' => 'required|string|max:255',
			'payment_status' => 'required|string|max:255',
		];
	}
}
