<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class DetailController extends Controller
{
	public function index($slug)
	{
		$item = Item::with(['type', 'brand'])->whereSlug($slug)->firstOrFail();
		// dd($item);
		$similiarItems = Item::with(['type', 'brand'])
			->where('id', '!=', $item->id)
			->get();
		return view('detail', [
			'item' => $item,
			'similiarItems' => $similiarItems,
		]);
	}
}
