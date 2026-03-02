<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservasi Rumah Sakit') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="container">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Form Reservasi Pasien</h4>
                        </div>
                        <div class="card-body">
                            <div id="alert-message" style="display: none;"></div>

                            <form id="reservation-form">
                                
                                <div class="mb-3">
                                    <label for="polyclinic_id" class="form-label">Pilih Poliklinik</label>
                                    <select class="form-select" id="polyclinic_id" required>
                                        <option value="" selected disabled>-- Pilih Poli --</option>
                                        @foreach($polyclinics as $poli)
                                            <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="doctor_id" class="form-label">Pilih Dokter</label>
                                    <select class="form-select" id="doctor_id" disabled required>
                                        <option value="" selected disabled>-- Menunggu Pilihan Poli --</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="schedule_id" class="form-label">Pilih Jadwal Praktik</label>
                                    <select class="form-select" id="schedule_id" disabled required>
                                        <option value="" selected disabled>-- Menunggu Pilihan Dokter --</option>
                                    </select>
                                    <small class="text-muted" id="quota-info"></small>
                                </div>

                                <div class="mb-3">
                                    <label for="reservation_date" class="form-label">Tanggal Kunjungan</label>
                                    <input type="date" class="form-control" id="reservation_date" name="reservation_date" required>
                                </div>

                                <button type="submit" class="btn btn-success w-100" id="btn-submit">Buat Janji Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            
            // Setup CSRF Token (Penting agar tidak Error 419)
            // Mengambil token dari meta tag bawaan layout Breeze
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // LOGIKA 1: Saat Poli Dipilih
            $('#polyclinic_id').change(function() {
                let polyId = $(this).val();
                let doctorDropdown = $('#doctor_id');
                
                // Reset dropdown
                doctorDropdown.html('<option value="" selected disabled>Loading...</option>').prop('disabled', true);
                $('#schedule_id').html('<option value="" selected disabled>-- Menunggu Pilihan Dokter --</option>').prop('disabled', true);

                // AJAX Request
                $.post("{{ route('api.get_doctors') }}", { polyclinic_id: polyId }, function(data) {
                    doctorDropdown.html('<option value="" selected disabled>-- Pilih Dokter --</option>');
                    if(data.length > 0) {
                        $.each(data, function(key, doctor) {
                            doctorDropdown.append(`<option value="${doctor.id}">${doctor.name} (SIP: ${doctor.sip})</option>`);
                        });
                        doctorDropdown.prop('disabled', false);
                    } else {
                        doctorDropdown.html('<option value="" disabled>Tidak ada dokter tersedia</option>');
                    }
                });
            });

            // LOGIKA 2: Saat Dokter Dipilih
            $('#doctor_id').change(function() {
                let docId = $(this).val();
                let scheduleDropdown = $('#schedule_id');

                scheduleDropdown.html('<option value="" selected disabled>Loading...</option>').prop('disabled', true);

                $.post("{{ route('api.get_schedules') }}", { doctor_id: docId }, function(data) {
                    scheduleDropdown.html('<option value="" selected disabled>-- Pilih Jadwal --</option>');
                    if(data.length > 0) {
                        $.each(data, function(key, schedule) {
                            scheduleDropdown.append(
                                `<option value="${schedule.id}" data-quota="${schedule.quota}">
                                    ${schedule.day} (${schedule.start_time} - ${schedule.end_time})
                                </option>`
                            );
                        });
                        scheduleDropdown.prop('disabled', false);
                    } else {
                        scheduleDropdown.html('<option value="" disabled>Jadwal belum tersedia</option>');
                    }
                });
            });

            // LOGIKA 3: Info Kuota
            $('#schedule_id').change(function() {
                let quota = $(this).find(':selected').data('quota');
                $('#quota-info').text(`Kuota harian: ${quota} pasien`);
            });

            // LOGIKA 4: Submit Form
            $('#reservation-form').submit(function(e) {
                e.preventDefault();
                
                let btn = $('#btn-submit');
                btn.prop('disabled', true).text('Memproses...');

                let formData = {
                    schedule_id: $('#schedule_id').val(),
                    reservation_date: $('#reservation_date').val()
                };

                $.ajax({
                    url: "{{ route('reservation.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('#alert-message').removeClass('alert alert-danger')
                            .addClass('alert alert-success')
                            .text(`Sukses! ${response.message} Nomor Antrean: ${response.data.queue_number}`)
                            .show();
                        
                        $('#reservation-form')[0].reset();
                        $('#doctor_id, #schedule_id').prop('disabled', true);
                        btn.prop('disabled', false).text('Buat Janji Sekarang');
                    },
                    error: function(xhr) {
                        let errorMsg = 'Terjadi kesalahan.';
                        if(xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        
                        $('#alert-message').removeClass('alert alert-success')
                            .addClass('alert alert-danger')
                            .text(errorMsg)
                            .show();
                        
                        btn.prop('disabled', false).text('Buat Janji Sekarang');
                    }
                });
            });

        });
    </script>
</x-app-layout>