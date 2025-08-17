@extends('layouts.app')

@section('title', 'Histori Karyawan')

@section('content')
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Histori Data Karyawan</h1>

        <form action="{{ route('histori.index') }}" method="GET" class="mb-6">
            <div class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau nomor induk..." class="w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-r-md">Cari</button>
            </div>
        </form>

        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Nomor Induk</th>
                        <th scope="col" class="px-6 py-3">Jabatan</th>
                        <th scope="col" class="px-6 py-3">Bagian</th>
                        <th scope="col" class="px-6 py-3">Unit Kerja</th>
                        <th scope="col" class="px-6 py-3">Klasifikasi</th>
                        <th scope="col" class="px-6 py-3">Tanggal Masuk</th>
                        <th scope="col" class="px-6 py-3">Tanggal Perhitungan</th>
                        <th scope="col" class="px-6 py-3">Umur</th>
                        <th scope="col" class="px-6 py-3">Tanggal Pensiun</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($histories as $history)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $history->nama }}</td>
                        <td class="px-6 py-4">{{ $history->nomor_induk }}</td>
                        <td class="px-6 py-4">{{ $history->jabatan }}</td>
                        <td class="px-6 py-4">{{ $history->bagian }}</td>
                        <td class="px-6 py-4">{{ $history->unit_kerja }}</td>
                        <td class="px-6 py-4">{{ $history->klasifikasi }}</td>
                        <td class="px-6 py-4">{{ $history->tanggal_masuk ? \Carbon\Carbon::parse($history->tanggal_masuk)->format('d M Y') : '-' }}</td>
                        <td class="px-6 py-4">{{ $history->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">{{ $history->umur }} tahun</td>
                        <td class="px-6 py-4">{{ $history->tanggal_pensiun }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="px-6 py-4 text-center text-gray-500">Tidak ada data histori yang ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $histories->links() }}
        </div>
    </div>
@endsection