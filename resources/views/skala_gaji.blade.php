@extends('layouts.app')

@section('title', 'Skala Gaji Pegawai')

@section('content')
<div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tabel Skala Gaji Pegawai</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                        Golongan
                    </th>
                    {{-- Membuat header kolom untuk setiap masa kerja yang ada --}}
                    @foreach ($masaKerjaHeaders as $masaKerja)
                        <th scope="col" class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                            {{ $masaKerja }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- Looping untuk setiap golongan gaji --}}
                @foreach ($salaryMapping as $golongan => $gajiData)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900 border-r">
                            {{ $golongan }}
                        </td>
                        {{-- Looping untuk setiap kolom masa kerja --}}
                        @foreach ($masaKerjaHeaders as $masaKerja)
                            <td class="px-2 py-3 whitespace-nowrap text-sm text-gray-700 text-right border-r">
                                {{-- Cek apakah ada gaji untuk masa kerja ini, jika ada, format angkanya --}}
                                @if (isset($gajiData[$masaKerja]))
                                    {{ number_format($gajiData[$masaKerja], 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

