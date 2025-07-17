@extends('layouts.skeleton')
@section('page')
  <div class="md:flex">
    @include('components.sidebar')
    <div class="md:w-[60%] lg:w-[67%] min-h-screen px-4 py-12  xl:p-20 flex flex-col gap-4">
      <div class="rounded-2xl p-6 bg-[#F3F3F3]">
        <h2 class="font-bold mb-8 text-xl">Broadcast</h2>
        <div class="rounded-2xl p-6 bg-[#FFB400] flex gap-4 items-center">
          <img src="{{ asset('./images/Alarm_fill2x.png') }}" alt="" class="w-[50px] h-[50px]">
          <p>Masukan kode template whatsapp yang akan digunakan untuk mengirim
            pesan Whatsapp ke klien dan prospek bisnis Anda !</p>
        </div>

        <form id="broadcastForm" action="{{ route('twilio.save-broadcast') }}" method="POST">
          @csrf

          <!-- Pesan Ulang Tahun -->
          <div class="mt-8">
            <h2 class="font-bold">Pesan Ulang Tahun</h2>
            <div class="flex gap-2 mt-4">
              <input type="text" name="birthday_template_sid" id="birthday_template_sid"
                class="bg-white py-2 px-4 rounded-2xl flex-1" placeholder="Masukan Template SID"
                value="{{ old('birthday_template_sid', $twilioTemplate->templates['birthday_sid']) }}">
              <button type="button" onclick="previewTemplate('birthday')"
                class="px-4 py-2 bg-blue-500 text-white rounded-2xl hover:bg-blue-600 transition duration-300">
                Preview
              </button>
            </div>
            <textarea name="birthday_message" id="birthday_message" class="bg-white py-2 px-4 rounded-2xl my-4 w-full"
              rows="4" placeholder="Template content will appear here..."></textarea>
          </div>

          <!-- Pesan Hari Raya Idul Fitri -->
          <div class="mt-8">
            <h2 class="font-bold">Pesan Hari Raya Idul Fitri</h2>
            <div class="flex gap-2 mt-4">
              <input type="text" name="idul_fitri_template_sid" id="idul_fitri_template_sid"
                class="bg-white py-2 px-4 rounded-2xl flex-1" placeholder="Masukan Template SID"
                value="{{ old('idul_fitri_template_sid', $twilioTemplate->templates['idul_fitri_sid']) }}">
              <button type="button" onclick="previewTemplate('idul_fitri')"
                class="px-4 py-2 bg-blue-500 text-white rounded-2xl hover:bg-blue-600 transition duration-300">
                Preview
              </button>
            </div>
            <textarea name="idul_fitri_message" id="idul_fitri_message" class="bg-white py-2 px-4 rounded-2xl my-4 w-full"
              rows="4" placeholder="Template content will appear here..."></textarea>
          </div>

          <!-- Pesan Hari Raya Natal -->
          <div class="mt-8">
            <h2 class="font-bold">Pesan Hari Raya Natal</h2>
            <div class="flex gap-2 mt-4">
              <input type="text" name="christmas_template_sid" id="christmas_template_sid"
                class="bg-white py-2 px-4 rounded-2xl flex-1" placeholder="Masukan Template SID"
                value="{{ old('christmas_template_sid', $twilioTemplate->templates['christmas_sid']) }}">
              <button type="button" onclick="previewTemplate('christmas')"
                class="px-4 py-2 bg-blue-500 text-white rounded-2xl hover:bg-blue-600 transition duration-300">
                Preview
              </button>
            </div>
            <textarea name="christmas_message" id="christmas_message" class="bg-white py-2 px-4 rounded-2xl my-4 w-full"
              rows="4" placeholder="Template content will appear here..."></textarea>
          </div>

          <!-- Single Save Button -->
          <div class="mt-8">
            <button type="submit" class="w-full text-center max-w-[150px]">
              <p
                class="w-[150px] border rounded-full hover:border-black hover:text-black py-1 px-4 text-white border-[#F04D41] bg-[#F04D41] hover:bg-transparent duration-300">
                Simpan
              </p>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Loading Modal -->
  <div id="loadingModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-6 flex items-center gap-4">
      <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-[#F04D41]"></div>
      <p>Loading template...</p>
    </div>
  </div>

  <script>
    function previewTemplate(type) {
      const templateSidInput = document.getElementById(`${type}_template_sid`);
      const messageTextarea = document.getElementById(`${type}_message`);
      const loadingModal = document.getElementById('loadingModal');

      const templateSid = templateSidInput.value.trim();

      if (!templateSid) {
        alert('Please enter a Template SID');
        return;
      }

      // Show loading modal
      loadingModal.classList.remove('hidden');
      const csrfToken = document.querySelector('input[name="_token"]').value;

      // Make AJAX request
      fetch('{{ route('twilio.fetch-template') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            template_sid: templateSid
          })
        })
        .then(response => response.json())
        .then(data => {
          loadingModal.classList.add('hidden');

          if (data.success) {
            // Populate the textarea with template body
            messageTextarea.value = data.data.body || '';

            // Optional: Show additional template info
            console.log('Template Info:', data.data);

            // Show success message
            showNotification('Template loaded successfully!', 'success');
          } else {
            showNotification(data.message || 'Failed to load template', 'error');
          }
        })
        .catch(error => {
          loadingModal.classList.add('hidden');
          console.error('Error:', error);
          showNotification('Error loading template', 'error');
        });
    }

    function showNotification(message, type = 'info') {
      // Create notification element
      const notification = document.createElement('div');
      notification.className = `fixed top-4 right-4 z-50 p-4 rounded-2xl text-white ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
      }`;
      notification.textContent = message;

      document.body.appendChild(notification);

      // Auto remove after 3 seconds
      setTimeout(() => {
        notification.remove();
      }, 3000);
    }

    // Handle form submission
    document.getElementById('broadcastForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch(this.action, {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            showNotification('Broadcast messages saved successfully!', 'success');
          } else {
            showNotification(data.message || 'Failed to save', 'error');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showNotification('Error saving broadcast messages', 'error');
        });
    });
  </script>
@endsection
