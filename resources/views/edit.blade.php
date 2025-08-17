@extends('layouts.app')

@section('title', 'Edit Data Karyawan')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-xl shadow-lg max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-4">
                Edit Data Karyawan: <span class="text-blue-600">{{ $dataToEdit->nama }}</span>
            </h1>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Ada beberapa masalah dengan input Anda:</span>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('karyawan-tetap.update', $dataToEdit->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Data Pribadi & Kepegawaian --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    {{-- Kolom Kiri: Data Pribadi --}}
                    <div class="md:col-span-1">
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Data Pribadi</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama"
                                    value="{{ old('nama', $dataToEdit->nama) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                    required>
                            </div>
                            <div>
                                <label for="nomor_induk" class="block text-sm font-medium text-gray-700">Nomor Induk</label>
                                <input type="text" name="nomor_induk" id="nomor_induk"
                                    value="{{ old('nomor_induk', $dataToEdit->nomor_induk) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', optional($dataToEdit->tanggal_lahir)->format('Y-m-d')) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                            </div>
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select name="gender" id="gender"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    <option value="Male" {{ old('gender', $dataToEdit->gender) == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Female" {{ old('gender', $dataToEdit->gender) == 'Female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label for="pendidikan" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikan" id="pendidikan"
                                    value="{{ old('pendidikan', $dataToEdit->pendidikan) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                            </div>
                            <div>
                                <label for="keluarga_status" class="block text-sm font-medium text-gray-700">Status Keluarga</label>
                                <select name="keluarga_status" id="keluarga_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    @foreach($keluargaStatusList as $option)
                                        <option value="{{ $option }}" {{ old('keluarga_status', $dataToEdit->keluarga_status) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="keluarga_anak" class="block text-sm font-medium text-gray-700">Jumlah Anak</label>
                                <input type="number" name="keluarga_anak" id="keluarga_anak"
                                    value="{{ old('keluarga_anak', $dataToEdit->keluarga_anak) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                            </div>
                        </div>
                    </div>
                    {{-- Kolom Kanan: Data Kepegawaian --}}
                    <div class="md:col-span-1">
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Data Kepegawaian</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk"
                                    value="{{ old('tanggal_masuk', optional($dataToEdit->tanggal_masuk)->format('Y-m-d')) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                            </div>
                            <div>
                                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                                <select name="jabatan" id="jabatan"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out"
                                    required>
                                    @foreach($jabatanOptions as $option)
                                        <option value="{{ $option }}" {{ old('jabatan', $dataToEdit->jabatan) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="bagian" class="block text-sm font-medium text-gray-700">Bagian</label>
                                <select name="bagian" id="bagian"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    @foreach($bagianOptions as $option)
                                        <option value="{{ $option }}" {{ old('bagian', $dataToEdit->bagian) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="unit_kerja" class="block text-sm font-medium text-gray-700">Unit Kerja</label>
                                <select name="unit_kerja" id="unit_kerja"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    @foreach($unitKerjaOptions as $option)
                                        <option value="{{ $option }}" {{ old('unit_kerja', $dataToEdit->unit_kerja) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="golongan" class="block text-sm font-medium text-gray-700">Golongan</label>
                                <select name="golongan" id="golongan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    @foreach($golonganOptions as $option)
                                        <option value="{{ $option }}" {{ old('golongan', $dataToEdit->golongan) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="klasifikasi" class="block text-sm font-medium text-gray-700">Klasifikasi</label>
                                <select name="klasifikasi" id="klasifikasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    @foreach($klasifikasiOptions as $option)
                                        <option value="{{ $option }}" {{ old('klasifikasi', $dataToEdit->klasifikasi) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status Pegawai</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    <option value="Aktif" {{ old('status', $dataToEdit->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $dataToEdit->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Gaji & Sanksi --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-xl font-semibold mb-4 text-gray-700">Informasi Gaji & Sanksi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="gaji" class="block text-sm font-medium text-gray-700">Gaji Saat Ini</label>
                            <input type="number" name="gaji" id="gaji"
                                value="{{ old('gaji', $dataToEdit->gaji) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                        </div>
                        <div>
                            <label for="kenaikan_gaji_dihitung" class="block text-sm font-medium text-gray-500">Prospek Kenaikan Gaji</label>
                            <input type="text" id="kenaikan_gaji_dihitung"
                                value="{{ $kenaikan_gaji_dihitung ? 'Rp ' . number_format($kenaikan_gaji_dihitung, 0, ',', '.') : '-' }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 text-gray-600 cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label for="status_kenaikan" class="block text-sm font-medium text-gray-700">Status Kenaikan</label>
                            <select name="status_kenaikan" id="status_kenaikan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                <option value="">Pilih Status</option>
                                @foreach($statusKenaikanOptions as $option)
                                    <option value="{{ $option }}" {{ old('status_kenaikan', $dataToEdit->status_kenaikan) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="jenis_hukuman" class="block text-sm font-medium text-gray-700">Jenis Hukuman</label>
                            <select name="jenis_hukuman" id="jenis_hukuman"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">
                                <option value="">Tidak Ada</option>
                                @foreach($jenisHukumanOptions as $option)
                                    <option value="{{ $option }}" {{ old('jenis_hukuman', $dataToEdit->jenis_hukuman) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-full">
                            <label for="alasan_hukuman" class="block text-sm font-medium text-gray-700">Alasan Hukuman</label>
                            <textarea name="alasan_hukuman" id="alasan_hukuman" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 ease-in-out">{{ old('alasan_hukuman', $dataToEdit->alasan_hukuman) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Bagian: Riwayat Status Kepegawaian --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-700">Riwayat Status Kepegawaian</h3>
                        <button type="button" onclick="tambahRiwayat('riwayat-kepegawaian-container')" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            + Tambah Riwayat
                        </button>
                    </div>
                    <div id="riwayat-kepegawaian-container" class="space-y-4">
                        @forelse($dataToEdit->riwayatStatusKepegawaians as $index => $riwayat)
                            <div class="riwayat-kepegawaian-item p-4 border rounded-md bg-gray-50 flex items-center space-x-2 mt-4 riwayat-item">
                                <input type="hidden" name="riwayat_status_kepegawaians[{{ $index }}][id]" value="{{ $riwayat->id }}">
                                <div class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Status Kepegawaian</label>
                                        <input type="text" name="riwayat_status_kepegawaians[{{ $index }}][status_kepegawaian]"
                                            value="{{ old("riwayat_status_kepegawaians.$index.status_kepegawaian", $riwayat->status_kepegawaian) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Tanggal</label>
                                        <input type="date" name="riwayat_status_kepegawaians[{{ $index }}][tanggal]"
                                            value="{{ old("riwayat_status_kepegawaians.$index.tanggal", optional($riwayat->tanggal)->format('Y-m-d')) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-500">Keterangan (No. SK)</label>
                                        <input type="text" name="riwayat_status_kepegawaians[{{ $index }}][keterangan]"
                                            value="{{ old("riwayat_status_kepegawaians.$index.keterangan", $riwayat->keterangan) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                </div>
                                <button type="button" onclick="this.closest('.riwayat-item').remove()" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 112 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada riwayat status kepegawaian. Silakan tambahkan.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Bagian: Riwayat Status Jabatan --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-700">Riwayat Status Jabatan</h3>
                        <button type="button" onclick="tambahRiwayat('riwayat-jabatan-container')" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            + Tambah Riwayat
                        </button>
                    </div>
                    <div id="riwayat-jabatan-container" class="space-y-4">
                        @forelse($dataToEdit->riwayatJabatans as $index => $riwayat)
                            <div class="riwayat-jabatan-item p-4 border rounded-md bg-gray-50 flex items-center space-x-2 mt-4 riwayat-item">
                                <input type="hidden" name="riwayat_jabatans[{{ $index }}][id]" value="{{ $riwayat->id }}">
                                <div class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Jabatan</label>
                                        <input type="text" name="riwayat_jabatans[{{ $index }}][status_kepegawaian]"
                                            value="{{ old("riwayat_jabatans.$index.status_kepegawaian", $riwayat->status_kepegawaian) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Terhitung Mulai Tanggal</label>
                                        <input type="date" name="riwayat_jabatans[{{ $index }}][tgl_mulai]"
                                            value="{{ old("riwayat_jabatans.$index.tgl_mulai", optional($riwayat->tgl_mulai)->format('Y-m-d')) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-500">No. SP / ST / SK</label>
                                        <input type="text" name="riwayat_jabatans[{{ $index }}][nomor_sk]"
                                            value="{{ old("riwayat_jabatans.$index.nomor_sk", $riwayat->nomor_sk) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                </div>
                                <button type="button" onclick="this.closest('.riwayat-item').remove()" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 112 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada riwayat status jabatan. Silakan tambahkan.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Bagian: Riwayat Diklat --}}
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-700">Riwayat Diklat</h3>
                        <button type="button" onclick="tambahRiwayat('riwayat-diklat-container')" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                            + Tambah Riwayat Diklat
                        </button>
                    </div>
                    <div id="riwayat-diklat-container" class="space-y-4">
                        @forelse($dataToEdit->riwayatDiklats as $index => $riwayat)
                            <div class="riwayat-diklat-item p-4 border rounded-md bg-gray-50 flex items-center space-x-2 mt-4 riwayat-item">
                                <input type="hidden" name="riwayat_diklats[{{ $index }}][id]" value="{{ $riwayat->id }}">
                                <div class="flex-grow grid grid-cols-1 md:grid-cols-6 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-medium text-gray-500">Nama / Materi Diklat</label>
                                        <input type="text" name="riwayat_diklats[{{ $index }}][nama_materi]"
                                            value="{{ old("riwayat_diklats.$index.nama_materi", $riwayat->nama_materi) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Tempat</label>
                                        <input type="text" name="riwayat_diklats[{{ $index }}][tempat]"
                                            value="{{ old("riwayat_diklats.$index.tempat", $riwayat->tempat) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Tanggal Mulai</label>
                                        <input type="date" name="riwayat_diklats[{{ $index }}][tanggal_mulai]"
                                            value="{{ old("riwayat_diklats.$index.tanggal_mulai", optional($riwayat->tanggal_mulai)->format('Y-m-d')) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Tanggal Berakhir</label>
                                        <input type="date" name="riwayat_diklats[{{ $index }}][tanggal_berakhir]"
                                            value="{{ old("riwayat_diklats.$index.tanggal_berakhir", optional($riwayat->tanggal_berakhir)->format('Y-m-d')) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500">Penyelenggara</label>
                                        <input type="text" name="riwayat_diklats[{{ $index }}][penyelenggara]"
                                            value="{{ old("riwayat_diklats.$index.penyelenggara", $riwayat->penyelenggara) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    </div>
                                </div>
                                <button type="button" onclick="this.closest('.riwayat-item').remove()" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 112 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada riwayat diklat. Silakan tambahkan.</p>
                        @endforelse
                    </div>
                </div>


                {{-- Tombol Aksi --}}
                <div class="mt-8 flex justify-end space-x-3 border-t pt-6">
                    <a href="{{ route('karyawan-tetap.exportPdf', ['id' => $dataToEdit->id]) }}"
                       class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                        Download PDF
                    </a>
                    <a href="{{ route('karyawan-tetap.index') }}"
                        class="px-6 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-150 ease-in-out">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function tambahRiwayat(containerId) {
            const container = document.getElementById(containerId);
            const index = Date.now(); 
            
            let newItemHtml = '';

            if (containerId.includes('kepegawaian')) {
                newItemHtml = `
                    <div class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Status Kepegawaian</label>
                            <input type="text" name="riwayat_status_kepegawaians[${index}][status_kepegawaian]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Tanggal</label>
                            <input type="date" name="riwayat_status_kepegawaians[${index}][tanggal]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-500">Keterangan (No. SK)</label>
                            <input type="text" name="riwayat_status_kepegawaians[${index}][keterangan]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                    </div>
                `;
            } else if (containerId.includes('jabatan')) {
                newItemHtml = `
                    <div class="flex-grow grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Jabatan</label>
                            <input type="text" name="riwayat_jabatans[${index}][status_kepegawaian]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Terhitung Mulai Tanggal</label>
                            <input type="date" name="riwayat_jabatans[${index}][tgl_mulai]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-500">No. SP / ST / SK</label>
                            <input type="text" name="riwayat_jabatans[${index}][nomor_sk]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                    </div>
                `;
            } else if (containerId.includes('diklat')) {
                newItemHtml = `
                    <div class="flex-grow grid grid-cols-1 md:grid-cols-6 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-500">Nama / Materi Diklat</label>
                            <input type="text" name="riwayat_diklats[${index}][nama_materi]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Tempat</label>
                            <input type="text" name="riwayat_diklats[${index}][tempat]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Tanggal Mulai</label>
                            <input type="date" name="riwayat_diklats[${index}][tanggal_mulai]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Tanggal Berakhir</label>
                            <input type="date" name="riwayat_diklats[${index}][tanggal_berakhir]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Penyelenggara</label>
                            <input type="text" name="riwayat_diklats[${index}][penyelenggara]"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                        </div>
                    </div>
                `;
            }

            const newRow = document.createElement('div');
            newRow.className = 'p-4 border rounded-md bg-gray-50 flex items-center space-x-2 mt-4 riwayat-item';
            newRow.innerHTML = newItemHtml + `
                <button type="button" onclick="this.closest('.riwayat-item').remove()" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 112 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            container.appendChild(newRow);

            const emptyMessage = container.querySelector('p');
            if (emptyMessage) {
                emptyMessage.remove();
            }
        }
    </script>
@endsection
