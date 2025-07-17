@extends('layouts.skeleton')
@section('page')
  <div class="md:flex">
    @include('components.sidebar')
    <div class="md:w-[60%] lg:w-[67%] min-h-screen px-4 py-12  xl:p-20 flex flex-col gap-4">
      <div class="rounded-2xl p-6 bg-[#F3F3F3]">
        <h2 class="font-bold mb-8 text-xl">Prospek List</h2>
        <div class="md:flex items-center justify-between">
          <a href="{{ route('admin.prospect.create') }}" class="w-full text-center max-w-[250px]">
            <p
              class="border rounded-full hover:border-[#00af14c5] py-2 px-8 text-xl text-white border-[#00AF14] bg-[#00AF14] hover:bg-[#00af14c5] duration-300 flex items-center gap-4">
              <img src="{{ asset('./images/Add_round_fill2x.png') }}" alt="" class="w-[25px] h-[25px]">
              Add Prospek
            </p>
          </a>
          <h2 class="font-bold text-xl shrink mt-8 md:mt-0">Total : {{ $respondents_count }}</h2>
        </div>
        <div class="rounded-2xl p-6 bg-white mt-8 overflow-x-scroll">
          <div class="min-w-[550px]">
            <!-- Table Header -->
            <div class="grid grid-cols-4 items-center gap-2 border-b border-gray-200 pb-4 mb-4">
              {{-- <h2 class="font-bold text-xl shrink">No.</h2> --}}
              <h2 class="font-bold text-xl shrink">Nama</h2>
              <h2 class="font-bold text-xl shrink">Email</h2>
              <h2 class="font-bold text-xl shrink">Whatsapp</h2>
              <h2 class="font-bold text-xl shrink">Action</h2>
            </div>
            <!-- Table Body - Loopable -->
            @forelse($respondents as $index => $respondent)
              <div class="grid grid-cols-4 items-center gap-2 py-3 border-b border-gray-100 last:border-b-0">
                {{-- <p class="text-gray-800">{{ $index +1 }}</p> --}}
                <p class="text-gray-800">{{ $respondent->name }}</p>
                <p class="text-gray-800">{{ $respondent->email }}</p>
                <p class="text-gray-800">{{ $respondent->phone }}</p>
                <div class="flex gap-2">
                  <!-- Edit Button -->
                  <a href="{{ route('admin.prospect.edit', $respondent->id) }}" class="text-center">
                    <span
                      class="inline-block border rounded-full hover:border-black hover:text-black py-1 px-4 text-white border-blue-500 bg-blue-500 hover:bg-transparent duration-300 text-sm">
                      Edit
                    </span>
                  </a>
                  <!-- Delete Button -->
                  <form action="{{ route('admin.prospect.destroy', $respondent->id) }}" method="POST"
                    class="inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                      class="cursor-pointer delete-btn border rounded-full hover:border-black hover:text-black py-1 px-4 text-white border-[#F04D41] bg-[#F04D41] hover:bg-transparent duration-300 text-sm"
                      data-name="{{ $respondent->name }}">
                      Delete
                    </button>
                  </form>
                </div>
              </div>
            @empty
              <div class="text-center py-8">
                <p class="text-gray-500 text-lg">No prospects found.</p>
                <a href="{{ route('prospect.create') }}"
                  class="inline-block mt-4 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                  Add New Prospect
                </a>
              </div>
            @endforelse
          </div>
        </div>
        {{ $respondents->withQueryString()->links() }}
      </div>
    </div>
  </div>

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get all delete buttons
      const deleteButtons = document.querySelectorAll('.delete-btn');

      deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault();

          const form = this.closest('.delete-form');
          const prospectName = this.dataset.name;

          Swal.fire({
            title: 'Konfirmasi Penghapusan',
            text: `Hapus "${prospectName}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#F04D41',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            buttonsStyling: true,
            customClass: {
              confirmButton: 'rounded-full px-6 py-2 text-white font-medium',
              cancelButton: 'rounded-full px-6 py-2 text-white font-medium'
            },
            background: '#ffffff',
            backdrop: `
              rgba(0,0,0,0.5)
            `
          }).then((result) => {
            if (result.isConfirmed) {
              // Show loading state
              Swal.fire({
                title: 'Menghapus...',
                text: 'Harap tunggu.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                  Swal.showLoading();
                }
              });

              // Submit the form
              form.submit();
            }
          });
        });
      });
    });
  </script>
@endsection
