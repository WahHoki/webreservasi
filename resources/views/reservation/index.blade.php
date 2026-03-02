<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran Reservasi & Riwayat') }}
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap');

        /* ── BASE ── */
        .rv-root {
            font-family: 'DM Sans', sans-serif;
            background: #f0f4ff;
            background-image:
                radial-gradient(ellipse 80% 50% at 20% -10%, rgba(99,102,241,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 110%, rgba(16,185,129,0.08) 0%, transparent 60%);
            padding: 1.75rem;
        }

        /* ── PAGE HEADER ── */
        .rv-page-header {
            position: relative;
            border-radius: 22px;
            overflow: hidden;
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 80%, #6366f1 100%);
            padding: 2rem 2.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 20px 60px rgba(99,102,241,0.3), 0 4px 16px rgba(0,0,0,0.1);
        }
        .rv-page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .rv-header-orb {
            position: absolute; border-radius: 50%;
            filter: blur(60px); opacity: 0.25; pointer-events: none;
        }
        .rv-orb-1 { width: 250px; height: 250px; background: #818cf8; top: -80px; right: -40px; }
        .rv-orb-2 { width: 150px; height: 150px; background: #34d399; bottom: -50px; right: 160px; }

        .rv-page-title {
            font-family: 'Clash Display', sans-serif;
            font-size: 1.7rem;
            font-weight: 700;
            color: #fff;
            position: relative;
            margin-bottom: 0.3rem;
        }
        .rv-page-sub {
            color: rgba(199,210,254,0.85);
            font-size: 0.875rem;
            font-weight: 300;
            position: relative;
        }
        .rv-header-date {
            position: absolute;
            top: 1.5rem; right: 1.75rem;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            padding: 0.55rem 1rem;
            text-align: center;
            backdrop-filter: blur(8px);
        }
        .rv-header-date-lbl { font-size: 0.6rem; color: #c7d2fe; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 500; }
        .rv-header-date-val { font-family: 'Clash Display', sans-serif; font-size: 0.875rem; color: #fff; font-weight: 600; margin-top: 2px; }

        /* ── LAYOUT GRID ── */
        .rv-grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 1.25rem;
            align-items: start;
        }

        /* ── PANEL BASE ── */
        .rv-panel {
            background: #fff;
            border-radius: 22px;
            border: 1px solid #e8eaf6;
            box-shadow: 0 2px 12px rgba(99,102,241,0.07);
            overflow: hidden;
        }

        .rv-panel-head {
            display: flex; align-items: center; gap: 0.55rem;
            padding: 1.35rem 1.6rem 0;
            font-family: 'Clash Display', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: #1e1b4b;
        }

        .rv-panel-body { padding: 1.25rem 1.6rem 1.6rem; }

        /* ── ALERT ── */
        #alert-message {
            border-radius: 12px;
            padding: 0.85rem 1rem;
            font-size: 0.875rem;
            margin-bottom: 1.1rem;
            border-left: 4px solid;
        }
        #alert-message.alert-success { background: #f0fdf4; color: #166534; border-color: #22c55e; }
        #alert-message.alert-error   { background: #fef2f2; color: #991b1b; border-color: #ef4444; }

        /* ── FORM ELEMENTS ── */
        .rv-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 0.45rem;
        }

        .rv-select, .rv-input {
            width: 100%;
            border: 1.5px solid #e0e2f0;
            border-radius: 12px;
            padding: 0.65rem 0.9rem;
            font-size: 0.875rem;
            font-family: 'DM Sans', sans-serif;
            color: #1e1b4b;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }
        .rv-select:focus, .rv-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .rv-select:disabled {
            background: #f8f9ff;
            color: #9ca3af;
            cursor: not-allowed;
        }

        /* custom select arrow */
        .rv-select-wrap {
            position: relative;
        }
        .rv-select-wrap::after {
            content: '';
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            width: 0; height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #9ca3af;
            pointer-events: none;
        }

        .rv-field { margin-bottom: 1.1rem; }

        .rv-quota-info {
            font-size: 0.72rem;
            color: #6366f1;
            font-weight: 500;
            margin-top: 0.4rem;
            display: flex; align-items: center; gap: 0.3rem;
        }

        .rv-btn {
            width: 100%;
            display: flex; justify-content: center; align-items: center; gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            background: linear-gradient(135deg, #4338ca, #6366f1);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'Clash Display', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 4px 16px rgba(99,102,241,0.35);
            margin-top: 0.4rem;
        }
        .rv-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(99,102,241,0.45);
        }
        .rv-btn:disabled {
            opacity: 0.6; cursor: not-allowed; transform: none;
        }

        /* ── TABLE ── */
        .rv-table-wrap { overflow-x: auto; }

        table.rv-table {
            width: 100%;
            border-collapse: collapse;
        }
        .rv-table thead th {
            padding: 0.75rem 1rem;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6b7280;
            background: #f8f9ff;
            border-bottom: 1px solid #e8eaf6;
            white-space: nowrap;
        }
        .rv-table thead th:first-child { border-radius: 12px 0 0 0; }
        .rv-table thead th:last-child  { border-radius: 0 12px 0 0; }

        .rv-table tbody tr {
            border-bottom: 1px solid #f0f1fa;
            transition: background 0.15s;
        }
        .rv-table tbody tr:last-child { border-bottom: none; }
        .rv-table tbody tr:hover { background: #f8f9ff; }

        .rv-table td {
            padding: 0.9rem 1rem;
            font-size: 0.875rem;
            color: #374151;
            vertical-align: middle;
        }

        .rv-date-val {
            font-family: 'Clash Display', sans-serif;
            font-weight: 600;
            color: #1e1b4b;
            font-size: 0.9rem;
        }
        .rv-time-val { font-size: 0.75rem; color: #6b7280; margin-top: 2px; }

        .rv-doctor-name { font-weight: 600; color: #1e1b4b; font-size: 0.875rem; }
        .rv-poli-name   { font-size: 0.75rem; color: #6366f1; margin-top: 2px; font-weight: 500; }

        .rv-queue-badge {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 52px;
            background: linear-gradient(135deg, #ede9fe, #ddd6fe);
            color: #4f46e5;
            border-radius: 10px;
            font-family: 'Clash Display', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            padding: 0.3rem 0.75rem;
        }

        .rv-status {
            display: inline-flex; align-items: center; gap: 0.3rem;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
        }
        .rv-status::before {
            content: ''; width: 6px; height: 6px;
            border-radius: 50%; flex-shrink: 0;
        }
        .rv-status-pending   { background: #fef9c3; color: #854d0e; }
        .rv-status-pending::before   { background: #eab308; }
        .rv-status-completed { background: #dcfce7; color: #166534; }
        .rv-status-completed::before { background: #22c55e; }
        .rv-status-cancelled { background: #fee2e2; color: #991b1b; }
        .rv-status-cancelled::before { background: #ef4444; }

        .rv-empty {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; padding: 3rem 1rem; gap: 0.75rem;
        }
        .rv-empty-icon {
            width: 60px; height: 60px;
            background: #f5f3ff;
            border: 1.5px dashed #c7d2fe;
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
        }
        .rv-empty-text { font-size: 0.875rem; color: #9ca3af; }

        /* ── ANIMATIONS ── */
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim-1 { animation: fadeSlideUp 0.45s ease both; }
        .anim-2 { animation: fadeSlideUp 0.45s ease 0.1s both; }
        .anim-3 { animation: fadeSlideUp 0.45s ease 0.18s both; }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .rv-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .rv-root { padding: 1rem; }
            .rv-header-date { display: none; }
            .rv-page-title { font-size: 1.3rem; }
        }
    </style>

    <div class="rv-root">

        {{-- ── PAGE HEADER ── --}}
        <div class="rv-page-header anim-1">
            <div class="rv-header-orb rv-orb-1"></div>
            <div class="rv-header-orb rv-orb-2"></div>

            <div class="rv-header-date hidden sm:block">
                <div class="rv-header-date-lbl">Hari ini</div>
                <div class="rv-header-date-val">{{ now()->translatedFormat('d M Y') }}</div>
            </div>

            <div class="rv-page-title">
                <svg style="display:inline;margin-right:8px;vertical-align:-4px" width="24" height="24" fill="none" stroke="rgba(199,210,254,0.9)" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Reservasi & Riwayat
            </div>
            <p class="rv-page-sub">Buat janji temu baru atau lihat riwayat kunjungan Anda di sini.</p>
        </div>

        {{-- ── MAIN GRID ── --}}
        <div class="rv-grid">

            {{-- ── FORM PANEL ── --}}
            <div class="rv-panel anim-2">
                <div class="rv-panel-head">
                    <svg width="17" height="17" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Buat Janji Temu
                </div>
                <div class="rv-panel-body">

                    <div id="alert-message" class="hidden"></div>

                    <form id="reservation-form">

                        <div class="rv-field">
                            <label class="rv-label" for="polyclinic_id">Poliklinik</label>
                            <div class="rv-select-wrap">
                                <select id="polyclinic_id" required class="rv-select">
                                    <option value="" selected disabled>— Pilih Poli —</option>
                                    @foreach($polyclinics as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="rv-field">
                            <label class="rv-label" for="doctor_id">Dokter</label>
                            <div class="rv-select-wrap">
                                <select id="doctor_id" disabled required class="rv-select">
                                    <option value="" selected disabled>— Menunggu Pilihan Poli —</option>
                                </select>
                            </div>
                        </div>

                        <div class="rv-field">
                            <label class="rv-label" for="schedule_id">Jadwal Praktik</label>
                            <div class="rv-select-wrap">
                                <select id="schedule_id" disabled required class="rv-select">
                                    <option value="" selected disabled>— Menunggu Pilihan Dokter —</option>
                                </select>
                            </div>
                            <div class="rv-quota-info hidden" id="quota-info">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 8v4m0 4h.01"/></svg>
                                <span id="quota-text"></span>
                            </div>
                        </div>

                        <div class="rv-field">
                            <label class="rv-label" for="reservation_date">Tanggal Kunjungan</label>
                            <input type="date" id="reservation_date" name="reservation_date" required class="rv-input">
                        </div>

                        <button type="submit" id="btn-submit" class="rv-btn">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                            Dapatkan Nomor Antrean
                        </button>
                    </form>
                </div>
            </div>

            {{-- ── HISTORY PANEL ── --}}
            <div class="rv-panel anim-3">
                <div class="rv-panel-head">
                    <svg width="17" height="17" fill="none" stroke="#6366f1" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Riwayat Janji Temu Saya
                </div>
                <div class="rv-panel-body" style="padding-top:1rem; padding-left:0; padding-right:0; padding-bottom:0;">
                    <div class="rv-table-wrap">
                        <table class="rv-table">
                            <thead>
                                <tr>
                                    <th style="padding-left:1.4rem;">Tanggal & Waktu</th>
                                    <th>Dokter / Poli</th>
                                    <th style="text-align:center;">No. Antrean</th>
                                    <th style="text-align:center; padding-right:1.4rem;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservations as $res)
                                    <tr>
                                        <td style="padding-left:1.4rem;">
                                            <div class="rv-date-val">{{ \Carbon\Carbon::parse($res->reservation_date)->format('d M Y') }}</div>
                                            <div class="rv-time-val">
                                                <svg style="display:inline;margin-right:2px;vertical-align:-1px" width="11" height="11" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>
                                                {{ \Carbon\Carbon::parse($res->schedule->start_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($res->schedule->end_time)->format('H:i') }} WIB
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rv-doctor-name">{{ $res->schedule->doctor->user->name }}</div>
                                            <div class="rv-poli-name">{{ $res->schedule->doctor->polyclinic->name }}</div>
                                        </td>
                                        <td style="text-align:center;">
                                            <span class="rv-queue-badge">{{ str_pad($res->queue_number, 3, '0', STR_PAD_LEFT) }}</span>
                                        </td>
                                        <td style="text-align:center; padding-right:1.4rem;">
                                            @if($res->status == 'pending')
                                                <span class="rv-status rv-status-pending">Menunggu</span>
                                            @elseif($res->status == 'completed')
                                                <span class="rv-status rv-status-completed">Selesai</span>
                                            @else
                                                <span class="rv-status rv-status-cancelled">Batal</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="rv-empty">
                                                <div class="rv-empty-icon">
                                                    <svg width="26" height="26" fill="none" stroke="#c7d2fe" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                                </div>
                                                <span class="rv-empty-text">Belum ada riwayat reservasi.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            function showAlert(type, html) {
                $('#alert-message')
                    .removeClass('hidden alert-success alert-error')
                    .addClass('alert-' + type)
                    .html(html);
            }

            $('#polyclinic_id').change(function () {
                let polyId = $(this).val();
                let doctorDropdown = $('#doctor_id');

                doctorDropdown.html('<option value="" disabled selected>Memuat...</option>').prop('disabled', true);
                $('#schedule_id').html('<option value="" disabled selected>— Menunggu Pilihan Dokter —</option>').prop('disabled', true);
                $('#quota-info').addClass('hidden');

                $.post("{{ route('api.get_doctors') }}", { polyclinic_id: polyId }, function (data) {
                    doctorDropdown.html('<option value="" disabled selected>— Pilih Dokter —</option>');
                    if (data.length > 0) {
                        $.each(data, function (key, doctor) {
                            doctorDropdown.append(`<option value="${doctor.id}">${doctor.name}</option>`);
                        });
                        doctorDropdown.prop('disabled', false);
                    } else {
                        doctorDropdown.html('<option value="" disabled>Tidak ada dokter tersedia</option>');
                    }
                });
            });

            $('#doctor_id').change(function () {
                let docId = $(this).val();
                let scheduleDropdown = $('#schedule_id');

                scheduleDropdown.html('<option value="" disabled selected>Memuat...</option>').prop('disabled', true);
                $('#quota-info').addClass('hidden');

                $.post("{{ route('api.get_schedules') }}", { doctor_id: docId }, function (data) {
                    scheduleDropdown.html('<option value="" disabled selected>— Pilih Jadwal —</option>');
                    if (data.length > 0) {
                        $.each(data, function (key, schedule) {
                            scheduleDropdown.append(
                                `<option value="${schedule.id}" data-quota="${schedule.quota}">
                                    ${schedule.day} &nbsp;(${schedule.start_time} – ${schedule.end_time})
                                </option>`
                            );
                        });
                        scheduleDropdown.prop('disabled', false);
                    } else {
                        scheduleDropdown.html('<option value="" disabled>Jadwal belum tersedia</option>');
                    }
                });
            });

            $('#schedule_id').change(function () {
                let quota = $(this).find(':selected').data('quota');
                if (quota) {
                    $('#quota-text').text(`Maks. ${quota} pasien per sesi`);
                    $('#quota-info').removeClass('hidden');
                }
            });

            $('#reservation-form').submit(function (e) {
                e.preventDefault();
                let btn = $('#btn-submit');
                btn.prop('disabled', true).html(`
                    <svg class="animate-spin" width="16" height="16" fill="none" viewBox="0 0 24 24" style="animation:spin 1s linear infinite">
                        <circle cx="12" cy="12" r="10" stroke="rgba(255,255,255,0.3)" stroke-width="3"/>
                        <path fill="rgba(255,255,255,0.9)" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    Memproses...
                `);

                $.ajax({
                    url: "{{ route('reservation.store') }}",
                    type: "POST",
                    data: {
                        schedule_id: $('#schedule_id').val(),
                        reservation_date: $('#reservation_date').val()
                    },
                    success: function (response) {
                        showAlert('success', `<strong>✓ Sukses!</strong> ${response.message} — Halaman akan dimuat ulang...`);
                        setTimeout(function () { location.reload(); }, 2000);
                    },
                    error: function (xhr) {
                        let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Terjadi kesalahan.';
                        showAlert('error', `<strong>✗ Gagal!</strong> ${msg}`);
                        btn.prop('disabled', false).html(`
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                            Dapatkan Nomor Antrean
                        `);
                    }
                });
            });
        });

        /* spinner keyframe */
        const style = document.createElement('style');
        style.textContent = '@keyframes spin { to { transform: rotate(360deg); } }';
        document.head.appendChild(style);
    </script>
</x-app-layout>
