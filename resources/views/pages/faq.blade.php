@extends('layouts.skeleton')

@section('page')
  <div class="md:flex">
    @include('components.sidebar')
    <div class="md:w-[60%] lg:w-[67%] min-h-screen px-4 py-12  xl:p-20 flex flex-col gap-4">
      <div class="rounded-2xl p-6 bg-[#F3F3F3]">
        <h2 class="font-bold mb-8 text-xl">FAQ</h2>

        <!-- FAQ Item -->
        @forelse ($faqs as $faq)
          <div class="rounded-2xl p-6 bg-white overflow-hidden mb-4">
            <button class="w-full text-left p-4 flex justify-between items-center faq-toggle">
              <div>
                <h3 class="text-lg font-bold">
                    {{ $faq->question }}
                </h3>
              </div>
              <span class="ml-4 transition-transform duration-300 icon">+</span>
            </button>
            <div class="max-h-0 overflow-hidden transition-all duration-50 px-4 pb-6 faq-content">
              <p>
                {{ $faq->answer }}
              </p>
            </div>
          </div>
        @empty
          <p class="text-gray-500 text-2xl">No Faqs Yet</p>
        @endforelse

      </div>

    </div>
  </div>
@endsection

@push('javascript')
  <script>
    document.querySelectorAll('.faq-toggle').forEach(button => {
      button.addEventListener('click', () => {
        const content = button.nextElementSibling;
        const icon = button.querySelector('.icon');

        const isOpen = content.style.maxHeight && content.style.maxHeight !== "0px";

        // Tutup semua FAQ lain jika ingin satu terbuka saja
        document.querySelectorAll('.faq-content').forEach(el => {
          el.style.maxHeight = null;
        });
        document.querySelectorAll('.faq-toggle .icon').forEach(i => {
          i.textContent = "+";
          i.classList.remove("rotate-45");
        });

        if (!isOpen) {
          content.style.maxHeight = content.scrollHeight + "px";
          icon.textContent = "–";
          icon.classList.add("rotate-45");
        }
      });
    });
  </script>
@endpush
