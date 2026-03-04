<x-app-layout>
    <x-slot name="header">
        Dashboard Administrator
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold">Selamat Datang, Admin {{ auth()->user()->name }}!</h3>
            <p class="mt-2 text-gray-600">Di sini nantinya kita bisa menampilkan rangkuman analitik harian, total dokter, dan laporan kunjungan pasien.</p>
        </div>
    </div>
</x-app-layout>