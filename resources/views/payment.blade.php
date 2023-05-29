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
        <form action="{{ route('front.payment.update', $booking->id) }}" method="POST" id="checkoutForm"
          class="w-full max-w-[490px] rounded-3xl bg-white p-[30px] pb-10">
          @csrf
          @method('POST')
          <!-- Validation Errors -->
          <div class="col-span-2 flex flex-col gap-3">
            <x-jet-validation-errors class="mb-5" />
          </div>
          <div class="flex flex-col gap-[30px]">
            <div class="flex flex-col gap-4">
              <h5 class="text-lg font-semibold">
                Review Order
              </h5>
              <!-- Items -->
              <div class="flex items-center justify-between">
                <p class="text-base font-normal">
                  Car choosen
                </p>
                <p class="text-base font-semibold">
                  {{ $booking->item->brand->name }} {{ $booking->item->name }}
                </p>
              </div>
              <!-- Items -->
              <div class="flex items-center justify-between">
                <p class="text-base font-normal">
                  Total day
                </p>
                <p class="text-base font-semibold">
                  {{ $booking->start_date->diffInDays($booking->end_date) }} days
                </p>
              </div>
              <!-- Items -->
              <div class="flex items-center justify-between">
                <p class="text-base font-normal">
                  Service
                </p>
                <p class="text-base font-semibold">
                  Delivery
                </p>
              </div>
              <!-- Items -->
              <div class="flex items-center justify-between">
                <p class="text-base font-normal">
                  Price
                </p>
                <p class="text-base font-semibold">
                  ${{ number_format($booking->item->price) }} per day
                </p>
              </div>
              <!-- Items -->
              <div class="flex items-center justify-between">
                <p class="text-base font-normal">
                  VAT (10%)
                </p>
                <p class="text-base font-semibold">
                  ${{ number_format($booking->item->price * $booking->start_date->diffInDays($booking->end_date) * 0.1) }}
                </p>
              </div>
              <!-- Items -->
              <div class="flex items-center justify-between">
                <p class="text-base font-normal">
                  Grand total
                </p>
                <p class="text-base font-semibold">
                  ${{ number_format($booking->total_price) }}
                </p>
              </div>
            </div>
            <div class="flex flex-col gap-4">
              <h5 class="text-lg font-semibold">
                Payment Method
              </h5>
              <div class="grid items-center gap-4 md:grid-cols-2 md:gap-[30px]">
                <div class="boxPayment relative opacity-30">
                  <input type="radio" value="mastercard" name="payment_method" id="mastercard"
                    class="absolute inset-0 z-50 cursor-pointer opacity-0" disabled>
                  <label for="mastercard" class="flex min-h-[80px] items-center justify-center gap-4 rounded-[20px] border border-grey p-5">
                    <img src="/svgs/logo-mastercard.svg" alt="">
                    <p class="text-base font-semibold">
                      MasterCard
                    </p>
                  </label>
                </div>
                <div class="boxPayment relative">
                  <input type="radio" value="midtrans" name="payment_method" id="midtrans" class="absolute inset-0 z-50 cursor-pointer opacity-0">
                  <label for="midtrans" class="flex min-h-[80px] items-center justify-center gap-4 rounded-[20px] border border-grey p-5">
                    <img src="/svgs/logo-midtrans.svg" alt="">
                    <p class="text-base font-semibold">
                      Midtrans
                    </p>
                  </label>
                </div>
              </div>
            </div>
            <!-- CTA Button -->
            <div class="col-span-2 mt-5">
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

  <script>
    // on checkoutButton click, submit the form
    $('#checkoutButton').click(function() {
      $('#checkoutForm').submit();
    });
  </script>
</x-front-layout>
