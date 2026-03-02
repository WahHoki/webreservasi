<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jadwal Praktik Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Gagal!</strong>
                    <ul class="list-disc pl-5 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Jadwal Baru</h3>
                            
                            <form action="{{ route('schedules.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="doctor_id" class="block text-sm font-medium text-gray-700">Pilih Dokter</label>
                                    <select name="doctor_id" id="doctor_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="" disabled selected>-- Pilih Dokter --</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->user->name }} ({{ $doctor->polyclinic->name ?? 'Tanpa Poli' }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="day" class="block text-sm font-medium text-gray-700">Hari Praktik</label>
                                    <select name="day" id="day" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="" disabled selected>-- Pilih Hari --</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="start_time" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                        <input type="time" name="start_time" id="start_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="end_time" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                        <input type="time" name="end_time" id="end_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="quota" class="block text-sm font-medium text-gray-700">Kuota Pasien</label>
                                    <input type="number" name="quota" id="quota" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: 20">
                                </div>

                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Simpan Jadwal
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokter & Poli</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal Praktik</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kuota</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($schedules as $schedule)
                                            <tr>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                    {{ $schedule->doctor->user->name }}
                                                    <br>
                                                    <span class="text-xs text-gray-500">{{ $schedule->doctor->polyclinic->name ?? '-' }}</span>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900">
                                                    <span class="font-bold">{{ $schedule->day }}</span><br>
                                                    <span class="text-xs text-gray-500">
                                                        {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - 
                                                        {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-center text-sm text-gray-900 font-bold">
                                                    {{ $schedule->quota }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?');" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold hover:underline">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">
                                                    Belum ada data jadwal.
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
        </div>
    </div>
</x-app-layout>