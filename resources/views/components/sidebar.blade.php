<div
  class="hidden md:visible md:w-[40%] lg:w-[33%] bg-[#F3F3F3] min-h-screen px-4 py-12  xl:p-20 md:flex flex-col gap-4 items-center">
  <a href="/" id="main-logo" class="self-center w-[60%] lg:min-w-[150px] lg:w-[30%]">
    <img src="{{ asset('./images/atom-black.png') }}" alt="logo-atom-black.png" class="h-auto  ">
  </a>
  <div class="flex flex-col justify-center items-center my-4">
    <div
      class="aspect-square w-[60%] lg:w-[50%] 2xl:w-[40%] overflow-hidden rounded-full flex items-center justify-center">
      <img src="{{ auth()->user()->profile_picture_path }}" alt="profile" class=" object-cover min-w-full min-h-full">
    </div>
    <h2 class="text-xl font-bold mt-4">
      {{ auth()->user()->fullname }}
    </h2>
    <p>
      {{ auth()->user()->email }}
    </p>
  </div>

  <a href="{{ route('admin.home') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Home_2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Dashboard</p>
  </a>
  <a href="{{ route('admin.prospect.index') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Chart_fill2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Prospek</p>
  </a>
  <a href="{{ route('admin.broadcast') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Message_fill2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Broadcast</p>
  </a>
  <a href="{{ route('admin.notifications') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Bell_2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Notification</p>
    <p class="rounded-full bg-amber-400 font-bold w-[30px] max-w-[30px] h-[30px] max-h-[30px] text-center ml-auto">
      {{ $notificationCount }}
    </p>
  </a>
  <a href="{{ route('admin.faqs') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Question_2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>FAQ</p>
  </a>
  <a href="#"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Chart_2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Upgrade</p>
  </a>
  <form action="{{ route('admin.logout') }}" method="POST">
    @csrf
    <button type="submit"
      class="cursor-pointer w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300 justify-center">
      <p class="font-semibold">Logout</p>
    </button>
  </form>



</div>



<!-- Hamburger Button (Mobile only) -->

<div class="flex md:hidden justify-between items-center p-4 bg-[#F3F3F3]">
  <a href="/" id="main-logo" class="self-center w-[175px]">
    <img src="{{ asset('./images/atom-black.png') }}" alt="logo-atom-black.png" class="h-auto  ">
  </a>
  <button id="hamburger-button" class="md:hidden text-black text-3xl focus:outline-none">
    &#9776;
  </button>
</div>


<!-- (Mobile only) -->

<div id="mobile-menu"
  class="hidden md:hidden md:w-[40%] lg:w-[33%] bg-[#F3F3F3] px-4 py-12  xl:p-20 flex-col gap-4 items-center">

  <div class="flex flex-col justify-center items-center my-4">
    <div class="aspect-square w-[60%] lg:w-[40%] overflow-hidden rounded-full flex items-center justify-center">
      <img src="{{ auth()->user()->profile_picture_path }}" alt="profile" class=" object-cover min-w-full min-h-full">
    </div>
    <h2 class="text-xl font-bold mt-4"> {{ auth()->user()->fullname }}</h2>
    <p>{{ auth()->user()->email }}</p>
  </div>

  <a href="{{ route('admin.home') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Home_2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Dashboard</p>
  </a>
  <a href="{{ route('admin.prospect.index') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Chart_fill2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Prospek</p>
  </a>
  <a href="{{ route('admin.broadcast') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Message_fill2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Broadcast</p>
  </a>
  <a href="{{ route('admin.notifications') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Bell_2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Notification</p>
    <p class="rounded-full bg-amber-400 font-bold w-[30px] max-w-[30px] h-[30px] max-h-[30px] text-center ml-auto">5</p>
  </a>
  <a href="{{ route('admin.faqs') }}"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Question_2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>FAQ</p>
  </a>
  <a href="#"
    class="w-full lg:w-[75%] lg:min-w-[300px] border rounded-full border-white bg-white py-2 px-4 lg:py-4 lg:px-8 text-xl text-black hover:bg-[#f04d4179] flex gap-8 items-center duration-300">
    <img src="{{ asset('./images/Chart_2x.png') }}" alt="" class="w-[35px] h-[35px]">
    <p>Upgrade</p>
  </a>



</div>
@push('javascript')
  <!-- Script Toggle Mobile Menu -->
  <script>
    const hamburger = document.getElementById('hamburger-button');
    const mobileMenu = document.getElementById('mobile-menu');

    hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      mobileMenu.classList.toggle('flex'); // display as flex if shown
    });

    //Hide menu when clicking outside
    document.addEventListener('click', (event) => {
      const isClickInside = hamburger.contains(event.target) || mobileMenu.contains(event.target);
      if (!isClickInside) {
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('flex');
      }
    });
  </script>
@endpush
