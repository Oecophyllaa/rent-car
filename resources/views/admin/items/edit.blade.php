<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      <a href="#!" onclick="window.history.go(-1); return false;">
        ←
      </a>
      {!! __('Item &raquo; Sunting &raquo; ' . $item->name) !!}
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

        <form class="w-full" action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Nama*
              </label>
              <input value="{{ old('name') ?? $item->name }}" name="name"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="text" placeholder="Nama" required />
              <div class="mt-2 text-sm text-gray-500">
                Nama items. Contoh: Item 1, Item 2, Item 3, dsb. Wajib diisi. Maksimal 255 karakter.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Brand*
              </label>
              <select name="brand_id"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                required>
                <option value="{{ $item->brand->id }}">Tidak Diubah ({{ $item->brand->name }})</option>
                <option disabled>&mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash;</option>
                @foreach ($brands as $brand)
                  <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                    {{ $brand->name }}
                  </option>
                @endforeach
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Brand item. Contoh: Subaru, Toyota, dsb. Wajib diisi.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Type*
              </label>
              <select name="type_id"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                required>
                <option value="{{ $item->type->id }}">Tidak Diubah ({{ $item->type->name }})</option>
                <option disabled>&mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash; &mdash;</option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                  </option>
                @endforeach
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Type item. Contoh: Sport Car, Electric Car, dsb. Wajib diisi.
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Fitur
              </label>
              <input value="{{ old('features') ?? $item->features }}" name="features"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="text" placeholder="Fitur" />
              <div class="mt-2 text-sm text-gray-500">
                Fitur items. Contoh: Fitur 1, Fitur 2, Fitur 3, dsb. Wajib diisi. Dipisahkan dengan koma (,).
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 flex flex-wrap px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Foto
              </label>
              <input name="photos[]"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                accept="image/png, image/jpeg, image/jpg, image/webp" type="file" multiple />
              <div class="mt-2 text-sm text-gray-500">
                Foto item. Lebih dari satu foto dapat diupload. Opsional
              </div>
            </div>
          </div>

          <div class="-mx-3 mt-4 mb-6 grid grid-cols-3 gap-3 px-3">
            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Harga
              </label>
              <input value="{{ old('price') ?? $item->price }}" name="price"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="number" placeholder="Harga" />
              <div class="mt-2 text-sm text-gray-500">
                Harga item. Angka. Contoh: 1000000. Wajib diisi.
              </div>
            </div>

            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Rating
              </label>
              <input value="{{ old('star') ?? $item->star }}" name="star"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="number" placeholder="Rating" min="1" max="5" step=".01" />
              <div class="mt-2 text-sm text-gray-500">
                Rating item. Angka. Contoh: 5. Opsional.
              </div>
            </div>

            <div class="w-full">
              <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-700" for="grid-last-name">
                Review
              </label>
              <input value="{{ old('review') ?? $item->review }}" name="review"
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                type="number" placeholder="Review" />
              <div class="mt-2 text-sm text-gray-500">
                Review item. Angka. Opsional.
              </div>
            </div>
          </div>

          <div class="-mx-3 mb-6 flex flex-wrap">
            <div class="w-full px-3 text-right">
              <button type="submit" class="rounded bg-green-500 px-4 py-2 font-bold text-white shadow-lg hover:bg-green-700">
                Simpan Item
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
