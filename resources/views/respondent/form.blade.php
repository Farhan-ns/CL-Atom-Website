<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $brand->name }} - Form</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="{{ asset('js/dark-mode.js') }}"></script>

</head>

<body>
  <div class="bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-3xl mx-auto my-auto p-8">
      <form action="{{ route('respondent.submit', $brand->slug) }}" method="POST" id="respondent-form" novalidate>
        @csrf
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md border dark:border-gray-700">
          <div class="flex flex-row justify-between">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
              Harap isi form berikut
            </h1>

            <div x-data="darkModeSwitch()" class="flex flex-row text-black dark:text-white">

              <button @click="toggleDarkMode()"
                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
                :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'">
                <!-- Sun Icon (Light Mode) -->
                <svg x-show="!isDark" x-transition:enter="transition ease-in-out duration-300"
                  x-transition:enter-start="opacity-0 rotate-90" x-transition:enter-end="opacity-100 rotate-0"
                  x-transition:leave="transition ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 rotate-0" x-transition:leave-end="opacity-0 rotate-90"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>

                <!-- Moon Icon (Dark Mode) -->
                <svg x-show="isDark" x-transition:enter="transition ease-in-out duration-300"
                  x-transition:enter-start="opacity-0 -rotate-90" x-transition:enter-end="opacity-100 rotate-0"
                  x-transition:leave="transition ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 rotate-0" x-transition:leave-end="opacity-0 -rotate-90"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.752 15.002A9.718 9.718 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                </svg>
              </button>
            </div>

          </div>

          <div class="mb-6">
            {{-- <h2 class="text-xl font-semibold text-gray-700 dark:text-white mb-2">Informasi</h2> --}}
            <div class="grid grid-cols-1 gap-4">
              <div>
                <label for="name" class="block text-gray-700 dark:text-white mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name"
                  class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none">
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mt-4">
              <div>
                <label for="email" class="block text-gray-700 dark:text-white mb-1">Email</label>
                <input type="email" id="email" name="email"
                  class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none">
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mt-4">
              <div>
                <label for="phone" class="block text-gray-700 dark:text-white mb-1">Nomor Whatsapp</label>
                <input type="tel" id="phone" name="phone" placeholder="08xxxxxxxx"
                  class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none">
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mt-4">
              <div>
                <label for="phone" class="block text-gray-700 dark:text-white mb-1">Tanggal Lahir</label>
                <input type="date" name="birthdate" id="birthdate"
                  class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" />
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mt-4">
              <div>
                <label for="phone" class="block text-gray-700 dark:text-white mb-1">Agama</label>
                <fieldset id="religion-radio-group">
                  <legend class="sr-only">Religion</legend>

                  <div class="grid grid-cols-2">
                    <div>
                      <div class="flex items-center mb-4">
                        <input id="religion-option-1" type="radio" name="religion" value="islam"
                          class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="religion-option-1"
                          class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                          Islam
                        </label>
                      </div>

                      <div class="flex items-center mb-4">
                        <input id="religion-option-2" type="radio" name="religion" value="protestan"
                          class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="religion-option-2"
                          class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                          Protestan
                        </label>
                      </div>

                      <div class="flex items-center mb-4">
                        <input id="religion-option-3" type="radio" name="religion" value="katolik"
                          class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="religion-option-3"
                          class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                          Katolik
                        </label>
                      </div>
                    </div>

                    <div>
                      <div class="flex items-center mb-4">
                        <input id="religion-option-4" type="radio" name="religion" value="hindu"
                          class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="religion-option-4"
                          class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                          Hindu
                        </label>
                      </div>

                      <div class="flex items-center mb-4">
                        <input id="religion-option-5" type="radio" name="religion" value="buddha"
                          class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="religion-option-5"
                          class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                          Buddha
                        </label>
                      </div>

                      <div class="flex items-center mb-4">
                        <input id="religion-option-6" type="radio" name="religion" value="konghucu"
                          class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="religion-option-6"
                          class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                          Konghucu
                        </label>
                      </div>
                    </div>
                  </div>

                </fieldset>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mt-4">
              <div>
                <label for="phone" class="block text-gray-700 dark:text-white mb-1">Darimana anda mengetahui
                  {{ $brand->name }}?</label>
                <fieldset id="source-radio-group">
                  <legend class="sr-only">Knows From</legend>

                  <div class="flex items-center mb-4">
                    <input id="source-from-option-1" type="radio" name="coming_from" value="instagram"
                      class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="source-from-option-1"
                      class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                      Instagram
                    </label>
                  </div>

                  <div class="flex items-center mb-4">
                    <input id="source-from-option-2" type="radio" name="coming_from" value="tiktok"
                      class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="source-from-option-2"
                      class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                      Tiktok
                    </label>
                  </div>

                  <div class="flex items-center mb-4">
                    <input id="source-from-option-3" type="radio" name="coming_from" value="facebook"
                      class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="source-from-option-3"
                      class="block ms-2 font-medium text-sm text-gray-900 dark:text-gray-300">
                      Facebook
                    </label>
                  </div>
                </fieldset>

              </div>
            </div>

          </div>

          <div class="mt-8 flex justify-end">
            <button type="submit"
              class="cursor-pointer font-semibold bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 dark:bg-red-600 dark:text-white dark:hover:bg-red-900">
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @if (session('success'))
  <!-- Success modal -->
  <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50"
    @keydown.escape="show = false">

    <div x-show="show" x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
      x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
      x-transition:leave-end="opacity-0 transform scale-90" class="relative p-4 w-full max-w-2xl max-h-full"
      @click.away="show = false">

      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-700">

        <!-- Modal header -->
        <div
          class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Berhasil!
          </h3>
          <button type="button" @click="show = false"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>

        <!-- Modal body -->
        <div class="p-4 md:p-5 space-y-4">
          <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
            Terima Kasih telah mengisi form kami.
          </p>
        </div>

        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
          <button @click="show = false" type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Tutup
          </button>
        </div>

      </div>
    </div>
  </div>
  @endif

  <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

  <script>
    const validator = new window.JustValidate('#respondent-form', {
        submitFormAutomatically: true,
      },
      [{
          key: 'Name is required',
          dict: {
            Indonesian: 'Nama wajib diisi',
          },
        },
        {
          key: 'Name is too short',
          dict: {
            Indonesian: 'Nama terlalu pendek',
          },
        },
        {
          key: 'Email is required',
          dict: {
            Indonesian: 'Email wajib diisi',
          },
        },
        {
          key: 'Email is invalid',
          dict: {
            Indonesian: 'Format email tidak valid',
          },
        },
        {
          key: 'Phone is required',
          dict: {
            Indonesian: 'Nomor WhatsApp wajib diisi',
          },
        },
        {
          key: 'Phone is invalid',
          dict: {
            Indonesian: 'Nomor WhatsApp harus berupa angka',
          },
        },
        {
          key: 'Birthdate is required',
          dict: {
            Indonesian: 'Tanggal lahir wajib diisi',
          },
        },
        {
          key: 'Religion is required',
          dict: {
            Indonesian: 'Agama wajib dipilih',
          },
        },
        {
          key: 'Source is required',
          dict: {
            Indonesian: 'Sumber informasi wajib dipilih',
          },
        },
      ]);

    validator
      .addField('#name', [{
          rule: 'required',
          errorMessage: 'Name is required',
        },
        {
          rule: 'minLength',
          value: 2,
          errorMessage: 'Name is too short',
        },
      ])
      .addField('#email', [{
          rule: 'required',
          errorMessage: 'Email is required',
        },
        {
          rule: 'email',
          errorMessage: 'Email is invalid',
        },
      ])
      .addField('#phone', [{
          rule: 'required',
          errorMessage: 'Phone is required',
        },
        {
          rule: 'number',
          errorMessage: 'Phone is invalid',
        },
      ])
      .addField('#birthdate', [{
        rule: 'required',
        errorMessage: 'Birthdate is required',
      }])
      .addRequiredGroup('#religion-radio-group', 'Religion is required')
      .addRequiredGroup('#source-radio-group', 'Source is required');

    validator.setCurrentLocale('Indonesian');
  </script>

</body>

</html>
