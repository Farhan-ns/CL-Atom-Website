@extends('layouts.skeleton')
@section('page')
  <div class="md:flex">
    @include('components.sidebar')
    <div class="md:w-[60%] lg:w-[67%] min-h-screen px-4 py-12  xl:p-20 flex flex-col gap-4">
      <div class="rounded-2xl p-6 bg-[#F3F3F3]">
        <h2 class="font-bold mb-8 text-xl">
          {{ isset($respondent) ? 'Edit Prospek' : 'Add Prospek' }}
        </h2>

        <form
          action="{{ isset($respondent) ? route('admin.prospect.update', $respondent->id) : route('admin.prospect.store') }}"
          method="POST">
          @csrf
          @if (isset($respondent))
            @method('PUT')
          @endif

          <div class="grid grid-cols-1 gap-4">
            <div class="grid grid-cols-1 md:grid-cols-8 items-center gap-4">
              <h2 class="font-bold md:col-span-2">Nama</h2>
              <input name="name" type="text" value="{{ old('name', $respondent->name ?? '') }}"
                class="md:col-span-6 bg-white py-2 px-4 rounded-2xl">
              @error('name')
                <p class="text-sm text-red-500 md:col-start-3 md:col-span-6">{{ $message }}</p>
              @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-8 items-center gap-4">
              <h2 class="font-bold md:col-span-2">Email</h2>
              <input name="email" type="email" value="{{ old('email', $respondent->email ?? '') }}"
                class="md:col-span-6 bg-white py-2 px-4 rounded-2xl">
              @error('email')
                <p class="text-sm text-red-500 md:col-start-3 md:col-span-6">{{ $message }}</p>
              @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-8 items-center gap-4">
              <h2 class="font-bold md:col-span-2">Whatsapp</h2>
              <input name="phone" type="text" value="{{ old('phone', $respondent->phone ?? '') }}"
                class="md:col-span-6 bg-white py-2 px-4 rounded-2xl">
              @error('phone')
                <p class="text-sm text-red-500 md:col-start-3 md:col-span-6">{{ $message }}</p>
              @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-8 items-center gap-4">
              <h2 class="font-bold md:col-span-2">Tanggal Lahir</h2>
              <input name="birthdate" type="date" id="birthdate"
                value="{{ old('birthdate', $respondent->birthdate ?? '') }}"
                class="md:col-span-6 bg-white py-2 px-4 rounded-2xl">
              @error('birthdate')
                <p class="text-sm text-red-500 md:col-start-3 md:col-span-6">{{ $message }}</p>
              @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-8 items-center gap-4">
              @php
                $selectedReligion = old('religion');
                if (!$selectedReligion && isset($respondent->religion)) {
                    $selectedReligion = strtolower(trim($respondent->religion));
                }
              @endphp
              <h2 class="font-bold md:col-span-2">Agama ({{ $selectedReligion }})</h2>

              <select name="religion" id="religion" class="md:col-span-6 bg-white py-2 px-4 rounded-2xl">
                <option value="">-- Pilih Agama --</option>
                <option value="islam" {{ $selectedReligion == 'islam' ? 'selected' : '' }}>Islam</option>
                <option value="protestan" {{ $selectedReligion == 'protestan' ? 'selected' : '' }}>Protestan</option>
                <option value="katolik" {{ $selectedReligion == 'katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="hindu" {{ $selectedReligion == 'hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="buddha" {{ $selectedReligion == 'buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="konghucu" {{ $selectedReligion == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
              </select>
              @error('religion')
                <p class="text-sm text-red-500 md:col-start-3 md:col-span-6">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <button type="submit" class="w-full">
            <p
              class="w-full border rounded-full py-2 px-4 text-xl text-white border-[#F04D41] bg-[#F04D41] hover:bg-[#f04d4179] hover:border-[#f04d4179] hover:text-black duration-300 cursor-pointer mt-12">
              {{ isset($respondent) ? 'Update' : 'Simpan' }}
            </p>
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
