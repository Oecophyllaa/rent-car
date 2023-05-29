<x-front-layout>
  <!-- Main Content -->
  <section class="relative bg-darkGrey py-[70px]">
    <div class="container">
      <div class="flex flex-col items-center">
        <header class="mb-[30px] text-center">
          <h2 class="mb-1 text-[26px] font-bold text-dark">
            Sign Up & Drive
          </h2>
          <p class="text-base text-secondary">We will help you get ready today</p>
        </header>
        <!-- Form Card -->
        <form action="{{ route('register') }}" class="w-full max-w-[490px] rounded-3xl bg-white p-[30px] pb-10" id="registerForm" method="POST"
          enctype="multipart/form-data">
          @csrf
          <!-- Validation Errors -->
          <div class="col-span-2 flex flex-col gap-3">
            <x-jet-validation-errors class="mb-5" />
          </div>
          <!-- User Photo -->
          <div class="mb-[50px] flex justify-center">
            <div class="relative">
              <img src="/svgs/ic-default-photo.svg" class="h-[120px] w-[120px] rounded-full" alt="" id="imageSrc">
              <a href="javascript:void(0);" id="btnUploadPhoto" class="">
                <img src="/svgs/ic-btn_upload.svg" class="absolute right-[-7px] bottom-[9px] h-[36px] w-[36px] rounded-full" alt="">
              </a>
              <a href="javascript:void(0);" id="btnDeletePhoto" class="hidden">
                <img src="/svgs/ic-btn_delete.svg" class="absolute right-[-7px] bottom-[9px] h-[36px] w-[36px] rounded-full" alt="">
              </a>
            </div>
            <input type="file" name="photo" id="photo" class="hidden" accept="image/x-png,image/jpg,image/jpeg">
          </div>
          <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">
            <!-- Full Name -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Full Name
              </label>
              <input type="text" name="name" id="name"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert Full Name" value="{{ old('name') }}" autofocus>
            </div>
            <!-- Phone Number -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Phone Number
              </label>
              <input type="number" name="phone" id="phone"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert Phone Number" value="{{ old('phone') }}">
            </div>
            <!-- Email -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Email Address
              </label>
              <input type="email" name="email" id="email"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert Email Address" value="{{ old('email') }}">
            </div>
            <!-- Password -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Password
              </label>
              <input type="password" name="password" id="password"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert password" required>
            </div>
            <!-- Password Confirmation -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Confirm Password
              </label>
              <input type="password" name="password_confirmation" id="password_confirmation"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Confirm password" required>
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="mt-1 text-right text-base text-secondary underline underline-offset-2">
                  Forgot My Password
                </a>
              @endif
            </div>
            <!-- Button -->
            <div class="col-span-2 mt-[26px]">
              <!-- Button Primary -->
              <div class="group rounded-full bg-primary p-1">
                <a href="#!" class="btn-primary" id="registerButton">
                  <p>
                    Create My Account
                  </p>
                  <img src="/svgs/ic-arrow-right.svg" alt="">
                </a>
                <button type="submit" class="hidden"></button>
              </div>
            </div>
            <!-- Create New Account Button -->
            <div class="col-span-2">
              <a href="{{ route('login') }}" class="btn-secondary">
                <p>Sign In</p>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    $('#registerButton').click(function() {
      $('#registerForm').submit();
    });
  </script>
</x-front-layout>
