<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      <a href="#!" onclick="window.history.go(-1); return false;">
        ←
      </a>
      {!! __('Booking &raquo; Sunting &raquo; ' . $booking->name) !!}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div>
        @if ($errors->any())
          <div class="mb-5" role="alert">
            <div class="rounded-t bg-red-500 px-4 py-2 font-bold text-white">
              Ada kesalahan!
            </div>
            <div class="rounded-b border border-t-0 border-red-400 bg-red-100 px-4 py-3 text-red-700">
              <p>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              </p>
            </div>
          </div>
        @endif

        <form class="w-full" action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Nama
              </label>
              <input value="{{ old('name') ?? $booking->name }}" name="name"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="text" placeholder="Nama" required />
              <div class="mt-2 text-sm text-gray-500">
                Nama booking. Contoh: John Doe.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Alamat
              </label>
              <input value="{{ old('address') ?? $booking->address }}" name="address"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="text" placeholder="Alamat" required />
              <div class="mt-2 text-sm text-gray-500">
                Alamat booking. Contoh: Jl Garuga.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Kota
              </label>
              <input value="{{ old('city') ?? $booking->city }}" name="city"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="text" placeholder="Kota" required />
              <div class="mt-2 text-sm text-gray-500">
                Kota booking. Contoh: Surabaya.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Kode Pos
              </label>
              <input value="{{ old('zip') ?? $booking->zip }}" name="zip"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="text" placeholder="Kode Pos" required />
              <div class="mt-2 text-sm text-gray-500">
                Kode Pos booking. Contoh: 61256.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Status Booking
              </label>
              <select name="status"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none">
                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="done" {{ $booking->status == 'done' ? 'selected' : '' }}>Done</option>
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Status Booking. Contoh: Pending.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Status Pembayaran
              </label>
              <select name="payment_status"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none">
                <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="success" {{ $booking->payment_status == 'success' ? 'selected' : '' }}>Success</option>
                <option value="failed" {{ $booking->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                <option value="expired" {{ $booking->payment_status == 'expired' ? 'selected' : '' }}>Expired</option>
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Status Pembayaran. Contoh: Pending.
              </div>
            </div>
          </div>

          <div class="-mx-3 mb-6 flex flex-wrap">
            <div class="w-full px-3 text-right">
              <button type="submit" class="rounded bg-green-500 px-4 py-2 font-bold text-white shadow-lg hover:bg-green-700">
                Simpan Booking
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
