<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Riwayat Pendaftaran Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Seluruh Peserta</h3>
                    <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:underline"> Kembali ke Dashboard</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Periksa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Antrean</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pasien</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @isset($allReservations)
                                @forelse($allReservations as $res)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($res->reservation_date)->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-bold text-indigo-600">
                                            #{{ str_pad($res->queue_number, 2, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $res->patient->name ?? 'Pasien Tidak Ditemukan' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $res->schedule->start_time ?? '--:--' }} WIB
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($res->status === 'completed') bg-green-100 text-green-800 
                                                @elseif($res->status === 'in_progress') bg-blue-100 text-blue-800 
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($res->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                            Belum ada riwayat pendaftaran pasien.
                                        </td>
                                    </tr>
                                @endforelse
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-red-500">
                                        Data gagal dimuat.
                                    </td>
                                </tr>
                            @endisset
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    @if(method_exists($allReservations, 'links'))
                        {{ $allReservations->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>