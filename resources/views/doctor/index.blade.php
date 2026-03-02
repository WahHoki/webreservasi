<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Dokter') }}
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
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Gagal!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Dokter Baru</h3>
                            
                            <form action="{{ route('doctors.store') }}" method="POST">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap (beserta gelar)</label>
                                    <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Login</label>
                                    <input type="email" name="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password Login</label>
                                    <input type="password" name="password" id="password" required minlength="8" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <div class="mb-4">
                                    <label for="polyclinic_id" class="block text-sm font-medium text-gray-700">Pilih Poliklinik</label>
                                    <select name="polyclinic_id" id="polyclinic_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="" disabled selected>-- Pilih Poli --</option>
                                        @foreach($polyclinics as $poli)
                                            <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="sip" class="block text-sm font-medium text-gray-700">Nomor SIP</label>
                                    <input type="text" name="sip" id="sip" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>

                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Simpan Data Dokter
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
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dokter</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Poliklinik</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SIP / Akun</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($doctors as $doctor)
                                            <tr>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                                    {{ $doctor->user->name }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    {{ $doctor->polyclinic->name ?? 'Poli Terhapus' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    SIP: {{ $doctor->sip }}<br>
                                                    <span class="text-xs text-blue-500">{{ $doctor->user->email }}</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Hapus dokter ini? Akun login dan jadwalnya juga akan ikut terhapus!');" class="inline-block">
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
                                                    Belum ada data dokter.
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