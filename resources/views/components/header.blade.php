<header class="py-6 flex items-center justify-between relative">
    <!-- Logo -->
    <a href="/" id="main-logo">
        <img src="{{asset('./images/atom-white.png')}}" alt="logo-atom-white.png" class="h-auto w-[175px]">
    </a>

    <!-- Menu Desktop -->
    <div id="menu-dekstop" class="hidden lg:flex text-white gap-8">
        <a href="#" class="text-xl">Home</a>
        <a href="#" class="text-xl">Blog</a>
        <a href="#" class="text-xl">Services</a>
        <a href="#" class="text-xl">About</a>
    </div>

    <!-- Auth Menu Desktop -->
    <div id="menu-auth-dekstop" class="hidden lg:flex gap-8">
        <a href="{{ route('admin.showLogin') }}">
            <p class="border rounded-full border-white py-2 px-8 text-xl text-white hover:border-[#F04D41] hover:bg-[#F04D41] duration-300">Log In</p>
        </a>
        <a href="{{ route('admin.showRegister') }}">
            <p class="border rounded-full hover:border-white py-2 px-8 text-xl text-white border-[#F04D41] bg-[#F04D41] hover:bg-transparent duration-300">Sign Up</p>
        </a>
    </div>

    <!-- Hamburger Button (Mobile/Tablet only) -->
    <button id="hamburger-button" class="lg:hidden text-white text-3xl focus:outline-none">
        &#9776;
    </button>

    <!-- Mobile Menu Hidden by Default -->
    <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white  flex-col items-center gap-4 p-6 lg:hidden z-50 rounded">
        <a href="#" class="text-xl">Home</a>
        <a href="#" class="text-xl">Blog</a>
        <a href="#" class="text-xl">Services</a>
        <a href="#" class="text-xl">About</a>

        <a href="{{ route('admin.showLogin') }}" class="w-full text-center">
            <p class="border rounded-full border-black py-2 px-8 text-xl text-black hover:text-white hover:border-[#F04D41] hover:bg-[#F04D41] duration-300">Log In</p>
        </a>
        <a href="{{ route('admin.showRegister') }}" class="w-full text-center">
            <p class="border rounded-full hover:border-black py-2 px-8 text-xl text-white border-[#F04D41] bg-[#F04D41] hover:bg-transparent duration-300">Sign Up</p>
        </a>
    </div>
</header>

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