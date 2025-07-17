@extends('layouts.skeleton')

@section('page')
  <div class="md:flex">
    @include('components.sidebar')
    <div class="md:w-[60%] lg:w-[67%] min-h-screen px-4 py-12  xl:p-20 flex flex-col gap-4">
      <div class="rounded-2xl p-6 bg-[#F3F3F3]">
        <h2 class="font-bold mb-8 text-xl">Notification</h2>
        @forelse ($notifications as $notification)
          <div class="rounded-2xl p-6 bg-white mb-4">
            <a href="{{ $notification->data['url'] ?? '#' }}"
              class="flex items-center gap-4 mb-4 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200 border-b border-gray-100 last:border-b-0"
              onclick="markAsRead('{{ $notification->id }}')">
              <div class="grow">
                <h3 class="font-bold text-gray-800">
                  {{ $notification->data['title'] ?? 'New Notification' }}
                </h3>
                <p class="text-gray-600 text-sm mt-1">
                  {{ $notification->data['message'] ?? ($notification->data['content'] ?? 'No content available') }}
                </p>
              </div>
              <div class="w-[30%] text-sm text-[#8E8E8E] text-right">
                {{ $notification->created_at->diffForHumans() }}
              </div>
              <div>
                <div class="shrink rounded-full bg-green-400 w-[12px] h-[12px] flex-shrink-0"></div>
              </div>
            </a>
          </div>
        @empty
          <div class="text-center py-8">
            <div class="text-gray-400 text-6xl mb-4">📭</div>
            <p class="text-gray-500 text-lg">No notifications yet</p>
            <p class="text-gray-400 text-sm mt-2">You'll see new notifications here when they arrive</p>
          </div>
        @endforelse
      </div>

    </div>
  </div>
@endsection
