@extends('layouts.skeleton')


@section('page')
  <div class="md:flex">
    @include('components.sidebar')
    <div class="md:w-[60%] lg:w-[67%] min-h-screen px-4 py-12  xl:p-20 flex flex-col gap-4">
      <div class="rounded-2xl p-6 bg-[#F3F3F3]">
        <h2 class="font-bold mb-4 text-xl">Notification</h2>
        @forelse (auth()->user()->unreadNotifications->take(5) as $notification)
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
        @empty
          <div class="text-center py-8">
            <div class="text-gray-400 text-6xl mb-4">📭</div>
            <p class="text-gray-500 text-lg">No notifications yet</p>
            <p class="text-gray-400 text-sm mt-2">You'll see new notifications here when they arrive</p>
          </div>
        @endforelse

        {{-- @if (auth()->user()->unreadNotifications->count() > 5)
          <div class="text-center mt-4">
            <a href="{{ route('notifications.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
              View all {{ auth()->user()->unreadNotifications->count() }} notifications
            </a>
          </div>
        @endif --}}

        <script>
          function markAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/mark-as-read`, {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json',
                },
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  // Remove the green dot or update UI as needed
                  event.target.closest('a').querySelector('.bg-green-400').style.display = 'none';
                }
              })
              .catch(error => console.error('Error:', error));
          }
        </script>
      </div>
      <div class="flex flex-col lg:flex-row gap-4">
        <div class="rounded-2xl p-6 bg-[#F3F3F3] w-full">
          <h2 class="font-bold mb-4 text-xl">Prospek</h2>
          <h2 class="text-7xl font-bold text-center">{{ $respondent_count }}</h2>
        </div>
        {{-- <div class="rounded-2xl p-6 bg-[#F3F3F3] w-full">
          <h2 class="font-bold mb-4 text-xl">Broadcast</h2>
          <a href="" class="flex items-center gap-4 mb-4">
            <div class="grow">
              <h3 class="font-bold">Lorem Ipsum</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
            </div>

          </a>
        </div> --}}

      </div>
      <div class="rounded-2xl p-6 bg-[#F3F3F3] w-full">
        <div class="chart-container">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Prospek - {{ $respondent_chart_data['year'] }}</h3>
            <div class="flex items-center gap-2">
              <label for="yearSelect" class="text-sm">Year:</label>
              <select id="yearSelect" class="border rounded px-2 py-1 text-sm" onchange="changeYear(this.value)">
                @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                  <option value="{{ $i }}" {{ $i == $respondent_chart_data['year'] ? 'selected' : '' }}>
                    {{ $i }}</option>
                @endfor
              </select>
            </div>
          </div>

          <div class="mb-2">
            <span class="text-sm text-gray-600">Total prospek: {{ $respondent_chart_data['total'] }}</span>
          </div>

          <canvas id="myChart" width="400" height="200"></canvas>
        </div>

      </div>
    </div>
  </div>
@endsection


@push('javascript')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const chartData = @json($respondent_chart_data);
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: chartData.labels,
        datasets: [{
          label: 'Jumlah prospek',
          data: chartData.data,
          backgroundColor: [
            '#D3E04D', '#94D0D2', '#487B9B', '#D56A68',
            '#F4BD45', '#9F83C9', '#7EBDBD', '#E8A87C',
            '#C27BA0', '#A8E6CF', '#FFB3BA', '#FFDFBA'
          ],
          borderWidth: 1,
          borderRadius: 4,
          borderSkipped: false,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                return `${context.parsed.y} prospek${context.parsed.y !== 1 ? 's' : ''}`;
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              callback: function(value) {
                return Number.isInteger(value) ? value + ' orang' : '';
              }
            },
            grid: {
              color: 'rgba(0, 0, 0, 0.1)'
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        },
        animation: {
          duration: 1000,
          easing: 'easeInOutQuart'
        }
      }
    });

    // Function to change year
    function changeYear(year) {
      window.location.href = `${window.location.pathname}?year=${year}`;
    }

    // Update chart data dynamically (if needed via AJAX)
    function updateChart(year) {
      fetch(`/dashboard/chart-data?year=${year}`)
        .then(response => response.json())
        .then(data => {
          myChart.data.labels = data.labels;
          myChart.data.datasets[0].data = data.data;
          myChart.update();

          // Update total display
          document.querySelector('.text-gray-600').textContent = `Total Prospek: ${data.total}`;
        })
        .catch(error => {
          console.error('Error updating chart:', error);
        });
    }
  </script>
@endpush
