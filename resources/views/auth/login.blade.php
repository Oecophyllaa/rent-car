<x-front-layout>
  <!-- Main Content -->
  <section class="relative bg-darkGrey py-[70px]">
    <div class="container">
      <div class="flex flex-col items-center">
        <header class="mb-[30px] text-center">
          <h2 class="mb-1 text-[26px] font-bold text-dark">
            Sign In & Drive
          </h2>
          <p class="text-base text-secondary">We will help you get ready today</p>
        </header>
        <!-- Form Card -->
        <form method="POST" action="{{ route('login') }}" id="loginForm" class="w-full max-w-[490px] rounded-3xl bg-white p-[30px] pb-10">
          @csrf
          <div class="grid grid-cols-2 items-center gap-y-6 gap-x-4 lg:gap-x-[30px]">
            <!-- Validation Errors -->
            <div class="col-span-2 flex flex-col gap-3">
              <x-jet-validation-errors />
              @if (session('status'))
                <div class="mb-4 text-sm font-medium text-green-600">
                  {{ session('status') }}
                </div>
              @endif
            </div>

            <!-- Email -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Email Address
              </label>
              <input type="email" name="email" id="email"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert Email Address" value="{{ old('email') }}" autofocus required>
            </div>
            <!-- Password -->
            <div class="col-span-2 flex flex-col gap-3">
              <label for="" class="text-base font-semibold text-dark">
                Password
              </label>
              <input type="password" name="password" id="password"
                class="rounded-[50px] border border-grey px-[26px] py-4 text-base font-medium placeholder:font-normal placeholder:text-secondary focus:border-primary focus:outline-none"
                placeholder="Insert password" required>
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="mt-1 text-right text-base text-secondary underline underline-offset-2">
                  Forgot My Password
                </a>
              @endif
            </div>
            <!-- Sign In Button -->
            <div class="col-span-2 mt-[26px]">
              <!-- Button Primary -->
              <div class="group rounded-full bg-primary p-1">
                <a href="#!" class="btn-primary" id="loginButton">
                  <p>
                    Sign In
                  </p>
                  <img src="/svgs/ic-arrow-right.svg" alt="">
                </a>
                <button type="submit" class="hidden"></button>
              </div>
            </div>
            @if (Route::has('register'))
              <!-- Create New Account Button -->
              <div class="col-span-2">
                <a href="{{ route('register') }}" class="btn-secondary">
                  <p>Create New Account</p>
                </a>
              </div>
            @endif
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    $('#loginButton').click(function() {
      $('#loginForm').submit();
    });
  </script>
</x-front-layout>
