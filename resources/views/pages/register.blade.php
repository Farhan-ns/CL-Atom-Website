@extends('layouts.skeleton')

@section('page')
  <div style="background-image: url('/images/img-2.jpg');" class="min-h-screen min-w-screen bg-cover bg-no-repeat bg-center">
    <div class="min-h-screen min-w-screen bg-[#0000006c]">
      <div class="min-h-screen container mx-auto px-4">
        @include('components.header')
        <div class="h-[100vh] md:h-[80vh] flex flex-col items-center justify-center gap-8">
          <h2 class="text-xl text-white">Have an account? <a href="{{ route('admin.showLogin') }}"
              class="font-bold italic">Login</a></h2>

          <h1 class="text-xl text-white">Sign Up</h1>
          <form action="{{ route('admin.submitRegister') }}" method="POST" class="w-[100%] md:w-[75%] lg:w-[50%]">
            @csrf

            <div class="flex flex-col md:flex-row md:gap-4 xl:gap-8">
              <div
                class="w-full border rounded-full border-white py-4 px-8 text-xl text-white flex gap-8 items-center mb-4 xl:mb-8">
                <img src="{{ asset('./images/User_2x.png') }}" alt="" class="w-[25px] h-[25px]">
                <input name="first_name" type="text" placeholder="First Name" value="{{ old('first_name') }}" class="w-full h-full placeholder-white focus:outline-none">
                @error('first_name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
              </div>
              <div
                class="w-full border rounded-full border-white py-4 px-8 text-xl text-white flex gap-8 items-center mb-4 xl:mb-8">
                <img src="{{ asset('./images/User_2x.png') }}" alt="" class="w-[25px] h-[25px]">
                <input name="last_name" type="text" placeholder="Last Name" value="{{ old('last_name') }}" class="w-full h-full placeholder-white focus:outline-none">
                @error('last_name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div
              class="w-full border rounded-full border-white py-4 px-8 text-xl text-white flex gap-8 items-center mb-4 xl:mb-8">
              <img src="{{ asset('./images/Message_2x.png') }}" alt="" class="w-[25px] h-[25px]">
              <input name="email" type="email" placeholder="Email" value="{{ old('email') }} class="w-full h-full placeholder-white focus:outline-none">
              @error('email')
                  <p class="text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div
              class="w-full border rounded-full border-white py-4 px-8 text-xl text-white flex gap-8 items-center mb-4 xl:mb-8">
              <img src="{{ asset('./images/Lock_2x.png') }}" alt="" class="w-[25px] h-[25px]">
              <input name="password" type="password" placeholder="Password" class="w-full h-full placeholder-white focus:outline-none">
              @error('password')
                  <p class="text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <button type="submit" class="w-full ">
              <p
                class="w-full border rounded-full hover:border-white py-4 px-8 text-xl text-white border-[#F04D41] bg-[#F04D41] hover:bg-transparent duration-300 cursor-pointer">
                Register</p>
            </button>
          </form>
          <div class="flex items-center justify-between w-[100%] md:w-[75%] lg:w-[50%]">
            <a href="" class="text-xl text-white">
              Term & Condition
            </a>
          </div>
        </div>

      </div>
    </div>

  </div>
@endsection
