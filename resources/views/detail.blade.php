{{-- {{ dd($item->photos) }} --}}
<x-front-layout>
  <!-- Main Content -->
  <section class="relative bg-darkGrey py-[70px]">
    <div class="container">
      <!-- Breadcrumb -->
      <ul class="mb-[50px] flex items-center gap-5">
        <li class="inline-flex gap-5 text-base font-normal capitalize text-secondary after:content-['/'] last:after:content-none">
          <a href="{{ route('front.index') }}">Home</a>
        </li>
        <li class="inline-flex gap-5 text-base font-normal capitalize text-secondary after:content-['/'] last:after:content-none">
          <a href="#!">{{ $item->brand->name }}</a>
        </li>
        <li class="inline-flex gap-5 text-base font-semibold capitalize text-dark after:content-['/'] last:after:content-none">
          Details
        </li>
      </ul>

      <div class="grid grid-cols-12 gap-[30px]">
        <!-- Car Preview -->
        <div class="col-span-12 lg:col-span-8">
          <div class="flex flex-col gap-4 rounded-[30px] bg-white p-4" id="gallery">
            <img :src="thumbnails[activeThumbnail].url" :key="thumbnails[activeThumbnail].id" class="h-auto w-full rounded-[18px] md:h-[490px]"
              alt="">
            <div class="grid grid-cols-4 items-center gap-3 md:gap-5">
              <div v-for="(thumbnail, index) in thumbnails" :key="thumbnail.id">
                <a href="#!" @click="changeActive(index)">
                  <img :src="thumbnail.url" alt="" class="thumbnail" :class="{ selected: index == activeThumbnail }">
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Details -->
        <div class="col-span-12 md:col-span-8 md:col-start-5 lg:col-span-4 lg:col-start-auto">
          <div class="h-full rounded-3xl bg-white p-5 pb-[30px]">
            <div class="flex h-full flex-col divide-y divide-grey">
              <!-- Name, Category, Rating -->
              <div class="max-w-[230px] pb-5">
                <h1 class="mb-[6px] text-[28px] font-bold leading-[42px] text-dark">
                  {{ $item->brand->name }} {{ $item->name }}
                </h1>
                <p class="mb-[10px] text-base font-normal text-secondary">{{ $item->type->name }}</p>
                <div class="flex items-center gap-2">
                  <span class="flex items-center gap-1">
                    @for ($i = 0; $i < floor($item->star); $i++)
                      <img src="/svgs/ic-star.svg" class="h-[22px] w-[22px]" alt="">
                    @endfor
                  </span>
                  <p class="mt-[2px] text-base font-semibold text-dark">
                    ({{ number_format($item->review) }})
                  </p>
                </div>
              </div>
              <!-- Features -->
              <ul class="flex-start flex flex-col gap-4 pt-5 pb-[25px]">
                @php
                  $features = explode(',', $item->features);
                @endphp
                @foreach ($features as $feature)
                  <li class="flex items-center gap-3 text-base font-semibold text-dark">
                    <img src="/svgs/ic-checkDark.svg" alt="">
                    {{ $feature }}
                  </li>
                @endforeach
              </ul>
              <!-- Price, CTA Button -->
              <div class="mt-auto flex items-center justify-between gap-4 pt-5">
                <div>
                  <p class="text-[22px] font-bold text-dark">
                    ${{ number_format($item->price) }}
                  </p>
                  <p class="text-base font-normal text-secondary">
                    /day
                  </p>
                </div>
                <div class="w-full max-w-[70%]">
                  <!-- Button Primary -->
                  <div class="group rounded-full bg-primary p-1">
                    <a href="{{ route('front.checkout', $item->slug) }}" class="btn-primary">
                      <p>
                        Rent Now
                      </p>
                      <img src="/svgs/ic-arrow-right.svg" alt="">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="container relative py-[100px]">
    <header class="mb-[50px] text-center">
      <h2 class="mb-1 text-[26px] font-bold text-dark">
        Frequently Asked Questions
      </h2>
      <p class="text-base text-secondary">Learn more about Vrom and get a success</p>
    </header>

    <!-- Questions -->
    <div class="mx-auto grid w-full max-w-[910px] gap-x-[50px] gap-y-6 md:grid-cols-2">
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq1">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq1-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq2">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq2-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq3">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq3-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq4">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq4-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq5">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq5-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
      <a href="#!" class="accordion h-min max-w-[430px] rounded-[24px] border border-grey px-6 py-4" id="faq6">
        <div class="flex items-center justify-between gap-1">
          <p class="text-base font-semibold text-dark">
            What if I crash the car?
          </p>
          <img src="/svgs/ic-chevron-down-rounded.svg" class="transition-all" alt="">
        </div>
        <div class="hidden max-w-[335px] pt-4" id="faq6-content">
          <p class="text-base leading-[26px] text-dark">
            Ipsum top talent busy making race that
            agreed both party. You can si amet lorem
            dolor get the rewards after winninng.
          </p>
        </div>
      </a>
    </div>
  </section>

  <!-- Similar Cars -->
  <section class="bg-darkGrey">
    <div class="container relative py-[100px]">
      <header class="mb-[30px]">
        <h2 class="mb-1 text-[26px] font-bold text-dark">
          Similar Cars
        </h2>
        <p class="text-base text-secondary">Start your big day</p>
      </header>

      <!-- Cars -->
      <div class="grid gap-[29px] md:grid-cols-2 lg:grid-cols-4">
        @foreach ($similiarItems as $items)
          <!-- Card -->
          <div class="card-popular">
            <div>
              <h5 class="mb-[2px] text-lg font-bold text-dark">
                {{ $items->name }}
              </h5>
              <p class="text-sm font-normal text-secondary">
                {{ $items->type ? $items->type->name : '-' }}
              </p>
              <a href="{{ route('front.detail', $items->slug) }}" class="absolute inset-0"></a>
            </div>
            <img src="{{ $items->thumbnail }}" class="h-[150px] w-full min-w-[216px] rounded-[18px]" alt="">
            <div class="flex items-center justify-between gap-1">
              <!-- Price -->
              <p class="text-sm font-normal text-secondary">
                <span class="text-base font-bold text-primary">IDR {{ number_format($items->price) }}</span>/day
              </p>
              <!-- Rating -->
              <p class="flex items-center gap-[2px] text-xs font-semibold text-dark">
                ({{ $items->star }}/5)
                <img src="./svgs/ic-star.svg" alt="">
              </p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <script src="https://unpkg.com/vue@next/dist/vue.global.js"></script>
  <script>
    const {
      createApp
    } = Vue
    createApp({
      data() {
        return {
          activeThumbnail: 0,
          thumbnails: [
            @foreach (json_decode($item->photos) as $key => $photo)
              {
                id: {{ $key }},
                url: "{{ Storage::url($photo) }}"
              },
            @endforeach
          ],
        }
      },
      methods: {
        changeActive(id) {
          this.activeThumbnail = id;
        }
      }
    }).mount('#gallery')
  </script>
</x-front-layout>
