<x-front-layout>
  <!-- Main Content -->
  <section class="relative bg-darkGrey py-[70px]">
    <div class="container">
      <header class="mb-[30px]">
        <h2 class="mb-1 text-[26px] font-bold text-dark">
          Checkout & Drive Faster
        </h2>
        <p class="text-base text-secondary">We will help you get ready today</p>
      </header>

      <div class="flex items-center gap-5 lg:justify-between">
        <!-- Form Card -->
        <form action="{{ route('front.checkout.store', $item->slug) }}" method="POST" class="w-full max-w-[490px] rounded-3xl bg-white p-[30px] pb-10"
          x-data="app" x-cloak id="checkoutForm">
          @csrf
          @method('POST')
          <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">
            <!-- Full Name -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Full Name
              </label>
              <input type="text" name="name" id="name"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert Full Name" value="{{ Auth::user()->name }}">
            </div>

            <!-- RESULT DATES FROM-UNTIL -->
            <div class="col-span-2 hidden grid-cols-2 gap-y-6 gap-x-4 lg:gap-x-[30px]">
              <!-- Result Date From [HIDDEN] -->
              <div class="col-span-1 flex flex-col gap-3">
                <label for="" class="text-base font-semibold text-dark">
                  From (result)
                </label>
                <input type="text" name="start_date" id="dateFrom"
                  class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none focus:before:appearance-none focus:before:!content-none"
                  placeholder="Select Date" readonly x-model="dateFromYmd">
              </div>
              <!-- Result Date Until [HIDDEN] -->
              <div class="col-span-1 flex flex-col gap-3">
                <label for="" class="text-base font-semibold text-dark">
                  Until (result)
                </label>
                <input type="text" name="end_date" id="dateUntil"
                  class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none focus:before:appearance-none focus:before:!content-none"
                  placeholder="Select Date" readonly x-model="dateToYmd">
              </div>
            </div>

            <!-- START: INPUT DATE -->
            <div class="relative col-span-2 grid grid-cols-2 gap-y-6 gap-x-4 lg:gap-x-[30px]" @keydown.escape="closeDatepicker()"
              @click.outside="closeDatepicker()">
              <!-- Date From -->
              <div class="col-span-1 flex flex-col gap-3">
                <label for="" class="text-base font-semibold text-dark">
                  From
                </label>
                <input readonly type="text"
                  class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none focus:before:appearance-none focus:before:!content-none"
                  placeholder="Select Date" @click="endToShow = 'from'; init(); showDatepicker = true" x-model="outputDateFromValue">
              </div>
              <!-- Date Until -->
              <div class="col-span-1 flex flex-col gap-3">
                <label for="" class="text-base font-semibold text-dark">
                  Until
                </label>
                <input readonly type="text"
                  class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none focus:before:appearance-none focus:before:!content-none"
                  placeholder="Select Date" @click="endToShow = 'to'; init(); showDatepicker = true" x-model="outputDateToValue">
              </div>

              <!-- START: Date-Range Picker -->
              <div
                class="absolute top-full z-50 mt-2 w-full rounded-[18px] border border-grey bg-white p-5 shadow-[0_22px_50px_0_rgba(212,214,218,0.25)]"
                x-show="showDatepicker" x-transition>
                <div class="flex flex-col items-center">

                  <!-- Month -->
                  <div class="mb-5 w-full">
                    <div class="flex items-center justify-center gap-1">
                      <button type="button"
                        class="mr-2 inline-flex cursor-pointer rounded-full p-1 transition duration-100 ease-in-out hover:bg-gray-200"
                        @click="if (month == 0) {year--; month=11;} else {month--;} getNoOfDays()">
                        <svg class="inline-flex h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                      </button>
                      <span x-text="MONTH_NAMES[month]" class="text-base font-semibold text-dark"></span>
                      <span x-text="year" class="text-base font-semibold text-dark"></span>
                      <button type="button"
                        class="ml-2 inline-flex cursor-pointer rounded-full p-1 transition duration-100 ease-in-out hover:bg-gray-200"
                        @click="if (month == 11) {year++; month=0;} else {month++;}; getNoOfDays()">
                        <svg class="inline-flex h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                      </button>
                    </div>
                  </div>

                  <!-- Day Names -->
                  <div class="-mx-1 mb-3 flex w-full flex-wrap">
                    <template x-for="(day, index) in DAYS" :key="index">
                      <div style="width: 14.26%" class="px-1">
                        <div x-text="day" class="text-center text-sm font-medium text-dark">
                        </div>
                      </div>
                    </template>
                  </div>

                  <!-- Dates -->
                  <div class="-mx-1 flex flex-wrap">
                    <template x-for="blankday in blankdays">
                      <div style="width: 14.28%" class="border border-transparent p-1 text-center text-sm">
                      </div>
                    </template>
                    <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                      <div style="width: 14.28%">
                        <div @click="getDateValue(date, false)" @mouseover="getDateValue(date, true)" x-text="date"
                          class="cursor-pointer p-1 text-center text-sm leading-loose transition duration-100 ease-in-out"
                          :class="{
                              'font-bold': isToday(date) == true,
                              'bg-primary text-white rounded-l-full': isDateFrom(date) ==
                                  true,
                              'bg-primary text-white rounded-r-full': isDateTo(date) == true,
                              'bg-[#E2E1FF]': isInRange(date) ==
                                  true,
                              'text-slate-300': isPast(date) == true
                          }">
                        </div>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
              <!-- END: Date-Range Picker -->
            </div>
            <!-- END: INPUT DATE -->

            <!-- Delivery Address -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Delivery Address
              </label>
              <input type="text" name="address" id="address"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Where should we deliver your car?">
            </div>

            <!-- City -->
            <div class="col-span-1 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                City
              </label>
              <input type="text" name="city" id="city"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none focus:before:appearance-none focus:before:!content-none"
                placeholder="City Name">
            </div>

            <!-- Post Code -->
            <div class="col-span-1 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Post Code
              </label>
              <input type="number" name="zip" id="postCode"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none focus:before:appearance-none focus:before:!content-none"
                placeholder="Post code">
            </div>

            <!-- CTA Button -->
            <div class="col-span-2 mt-[26px]">
              <!-- Button Primary -->
              <div class="group rounded-full bg-primary p-1">
                <a href="#" class="btn-primary" id="checkoutButton">
                  <p>
                    Continue
                  </p>
                  <img src="/svgs/ic-arrow-right.svg" alt="">
                </a>
              </div>
            </div>
          </div>
        </form>

        <img src="/images/porsche_small.webp" class="-mr-[100px] hidden max-w-[50%] lg:block" alt="">
      </div>
    </div>
  </section>

  <script type="text/javascript" src="/js/dateRangePicker.js"></script>
  <script>
    // on checkoutButton click, submit the form
    $('#checkoutButton').click(function() {
      $('#checkoutForm').submit();
    });
  </script>
</x-front-layout>
