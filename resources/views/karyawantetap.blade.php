@extends('layouts.app') {{-- Menggunakan layout utama Anda --}}

@section('title', 'Data Karyawan Tetap') {{-- Mengatur judul halaman --}}

@section('content')
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Data Karyawan Tetap</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Tambahkan pesan error jika ada, dari bulk delete --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- ========================================================= --}}
        {{-- BAGIAN FILTER ANDA, TIDAK ADA YANG DIHILANGKAN --}}
        {{-- ========================================================= --}}
        <form action="{{ route('karyawan-tetap.index') }}" method="GET" class="mb-6 p-4 border border-gray-200 rounded-md grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="col-span-full mb-4">
                <h3 class="text-lg font-semibold">Filter Data</h3>
            </div>

            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Nama</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Gender</option>
                    @foreach($genders as $option)
                        <option value="{{ $option }}" {{ request('gender') == $option ? 'selected' : '' }}>{{ ucfirst($option) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Status</option>
                    @foreach($statuses as $option)
                        <option value="{{ $option }}" {{ request('status') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="kelipatan" class="block text-sm font-medium text-gray-700">Masa Kerja Kelipatan</label>
                <input type="number" name="kelipatan" id="kelipatan" value="{{ request('kelipatan') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       min="1">
            </div>

            <div>
                <label for="tahun_kelipatan" class="block text-sm font-medium text-gray-700">Di Tahun</label>
                <input type="number" name="tahun_kelipatan" id="tahun_kelipatan" value="{{ request('tahun_kelipatan') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       min="1900">
            </div>

            <div>
                <label for="golongan" class="block text-sm font-medium text-gray-700">Golongan</label>
                <select name="golongan" id="golongan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Golongan</option>
                    @foreach($golonganOptions as $option)
                        <option value="{{ $option }}" {{ request('golongan') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="klasifikasi" class="block text-sm font-medium text-gray-700">Klasifikasi</label>
                <select name="klasifikasi" id="klasifikasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Klasifikasi</option>
                    @foreach($klasifikasiOptions as $option)
                        <option value="{{ $option }}" {{ request('klasifikasi') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="unit_kerja" class="block text-sm font-medium text-gray-700">Unit Kerja</label>
                <select name="unit_kerja" id="unit_kerja" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Unit Kerja</option>
                    @foreach($unitKerjaOptions as $option)
                        <option value="{{ $option }}" {{ request('unit_kerja') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <select name="jabatan" id="jabatan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Jabatan</option>
                    @foreach($jabatanOptions as $option)
                        <option value="{{ $option }}" {{ request('jabatan') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="bagian" class="block text-sm font-medium text-gray-700">Bagian</label>
                <select name="bagian" id="bagian" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Bagian</option>
                    @foreach($bagianOptions as $option)
                        <option value="{{ $option }}" {{ request('bagian') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <!-- <div>
                <label for="status_kenaikan" class="block text-sm font-medium text-gray-700">Status Kenaikan</label>
                <select name="status_kenaikan" id="status_kenaikan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Status Kenaikan</option>
                    @foreach($statusKenaikanOptions as $option)
                        <option value="{{ $option }}" {{ request('status_kenaikan') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div> -->

            <div>
                <label for="jenis_hukuman" class="block text-sm font-medium text-gray-700">Jenis Hukuman</label>
                <select name="jenis_hukuman" id="jenis_hukuman" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua Jenis Hukuman</option>
                    @foreach($jenisHukumanOptions as $option)
                        <option value="{{ $option }}" {{ request('jenis_hukuman') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            
 {{-- Cari div ini di dalam form filter Anda --}}
<div class="col-span-full flex justify-between items-center mt-4">
    <div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Terapkan Filter</button>
        <a href="{{ route('karyawan-tetap.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded ml-2">Reset Filter</a>
    </div>
    <div>
        {{-- TOMBOL BARU DITAMBAHKAN DI SINI --}}
        <!-- <button type="button" id="cek-semua-prospek-btn" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded">
            Cek Prospek Gaji -->
        </button>
        <a href="{{ route('karyawan-tetap.exportPdf', request()->query()) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-2">Download PDF</a>
    </div>
</div>
        </form>

        <div class="mb-6 flex space-x-4">
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-md">
                Jumlah Pegawai Aktif: <span class="font-bold">{{ $jumlahAktif }}</span>
            </div>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md">
                Jumlah Pegawai Tidak Aktif: <span class="font-bold">{{ $jumlahNonAktif }}</span>
            </div>
        </div>

        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('karyawan-tetap.create') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                + Tambah Pegawai
            </a>
            <form id="bulk-delete-form" action="{{ route('karyawan-tetap.destroy.bulk') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="ids_to_delete" id="ids-to-delete-input">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Hapus Data Terpilih
                </button>
            </form>
        </div>

        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    {{-- Semua Kolom Header Anda Utuh --}}
                    <tr>
                        <th scope="col" class="p-4">
                            <input id="checkbox-all-items" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        </th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Nomor Induk</th>
                        <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                        <th scope="col" class="px-6 py-3">Gender</th>
                        <th scope="col" class="px-6 py-3">Jabatan</th>
                        <th scope="col" class="px-6 py-3">Bagian</th>
                        <th scope="col" class="px-6 py-3">Unit Kerja</th>
                        <th scope="col" class="px-6 py-3">Pendidikan</th>
                        <th scope="col" class="px-6 py-3">Klasifikasi</th>
                        <th scope="col" class="px-6 py-3">Status Keluarga</th>
                        <th scope="col" class="px-6 py-3">Jml. Anak</th>
                        <th scope="col" class="px-6 py-3">Tanggal Masuk</th>
                        <th scope="col" class="px-6 py-3">Masa Kerja</th>
                        <th scope="col" class="px-6 py-3">Golongan</th>
                        <th scope="col" class="px-6 py-3">Gaji</th>
                        <th scope="col" class="px-6 py-3">Prospek Gaji Baru</th>
                        <th scope="col" class="px-6 py-3">Status Kenaikan</th>
                        <th scope="col" class="px-6 py-3">Jenis Hukuman</th>
                        <th scope="col" class="px-6 py-3">Alasan Hukuman</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
<tbody>
    @forelse ($pegawais as $pegawai)
    {{-- Tambahkan atribut data-id pada baris <tr> --}}
    <tr class="bg-white border-b hover:bg-gray-50" data-id="{{ $pegawai->id }}">
        <td class="w-4 p-4">
            <input id="checkbox-item-{{ $pegawai->id }}" type="checkbox" name="selected_ids[]" value="{{ $pegawai->id }}" class="item-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
        </td>
        <td class="px-6 py-4">{{ $pegawai->nama }}</td>
        <td class="px-6 py-4">{{ $pegawai->nomor_induk }}</td>
        <td class="px-6 py-4">{{ $pegawai->tanggal_lahir ? $pegawai->tanggal_lahir->format('d M Y') : '-' }}</td>
        <td class="px-6 py-4">{{ $pegawai->gender }}</td>
        <td class="px-6 py-4">{{ $pegawai->jabatan }}</td>
        <td class="px-6 py-4">{{ $pegawai->bagian }}</td>
        <td class="px-6 py-4">{{ $pegawai->unit_kerja }}</td>
        <td class="px-6 py-4">{{ $pegawai->pendidikan }}</td>
        <td class="px-6 py-4">{{ $pegawai->klasifikasi }}</td>
        <td class="px-6 py-4">{{ $pegawai->keluarga_status }}</td>
        <td class="px-6 py-4 text-center">{{ $pegawai->keluarga_anak }}</td>
        <td class="px-6 py-4">{{ $pegawai->tanggal_masuk ? $pegawai->tanggal_masuk->format('d M Y') : '-' }}</td>
        <td class="px-6 py-4 text-center">{{ $pegawai->masa_kerja ? $pegawai->masa_kerja . ' tahun' : '-' }}</td>
        <td class="px-6 py-4 text-center">{{ $pegawai->golongan ?? '-' }}</td>
        <td class="px-6 py-4 text-right">Rp {{ number_format($pegawai->gaji, 0, ',', '.') }}</td>
        
        {{-- Tambahkan id unik pada sel <td> ini --}}
        <td class="px-6 py-4 text-right" id="kenaikan-gaji-cell-{{ $pegawai->id }}">
            @if(isset($pegawai->kenaikan_gaji_dihitung) && $pegawai->kenaikan_gaji_dihitung)
                <span class="font-bold text-green-600">Rp {{ number_format($pegawai->kenaikan_gaji_dihitung, 0, ',', '.') }}</span>
            @else
                -
            @endif
        </td>
        
        {{-- Tambahkan id unik pada sel <td> ini --}}
        <td class="px-6 py-4" id="status-kenaikan-cell-{{ $pegawai->id }}">
            @if(isset($pegawai->kenaikan_gaji_dihitung) && $pegawai->kenaikan_gaji_dihitung)
                <form action="{{ route('karyawan-tetap.approveRaise', $pegawai->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menyetujui kenaikan gaji untuk {{ $pegawai->nama }}?');">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-xs">
                        Setujui
                    </button>
                </form>
            @else
                {{ $pegawai->status_kenaikan ?? '-' }}
            @endif
        </td>
        
        <td class="px-6 py-4">{{ $pegawai->jenis_hukuman ?? '-' }}</td>
        <td class="px-6 py-4">{{ $pegawai->alasan_hukuman ?? '-' }}</td>
        
        <td class="px-6 py-4">
            @if($pegawai->status == 'Aktif')
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2-5 py-0.5 rounded">Aktif</span>
            @else
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2-5 py-0.5 rounded">Tidak Aktif</span>
            @endif
        </td>
{{-- Ganti seluruh blok <td> Aksi Anda dengan ini --}}
<td class="px-6 py-4 flex flex-col items-start space-y-2">

    {{-- Tombol Edit --}}
    <a href="{{ route('karyawan-tetap.edit', $pegawai->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>

    {{-- Tombol Hapus --}}
    <form action="{{ route('karyawan-tetap.destroy', $pegawai->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data {{ $pegawai->nama }}?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
    </form>
    
    {{-- Tombol Batalkan Kenaikan Gaji --}}
    @if ($pegawai->status_kenaikan == 'Disetujui')
        <form action="{{ route('karyawan-tetap.revert', $pegawai->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin membatalkan kenaikan gaji untuk {{ $pegawai->nama }}?');">
            @csrf
            <button type="submit" class="font-medium text-yellow-600 hover:underline">Batalkan</button>
        </form>
    @endif

</td>
    </tr>
    @empty
    <tr>
        <td colspan="22" class="px-6 py-4 text-center text-gray-500">Tidak ada data pegawai yang ditemukan.</td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $pegawais->withQueryString()->links() }}
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxAll = document.getElementById('checkbox-all-items');
        const itemCheckboxes = document.querySelectorAll('.item-checkbox');
        const bulkDeleteForm = document.getElementById('bulk-delete-form');
        const idsToDeleteInput = document.getElementById('ids-to-delete-input');

        if (checkboxAll) {
            checkboxAll.addEventListener('change', function() {
                itemCheckboxes.forEach(cb => cb.checked = this.checked);
            });
        }

        if (bulkDeleteForm) {
            bulkDeleteForm.addEventListener('submit', function(event) {
                const selectedIds = Array.from(itemCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    alert('Pilih setidaknya satu data untuk dihapus.');
                    event.preventDefault();
                } else {
                    if (!confirm('Apakah Anda yakin ingin menghapus ' + selectedIds.length + ' data terpilih?')) {
                        event.preventDefault();
                    } else {
                        idsToDeleteInput.value = JSON.stringify(selectedIds);
                    }
                }
            });
        }

    document.addEventListener('DOMContentLoaded', function () {
        const cekSemuaBtn = document.getElementById('cek-semua-prospek-btn');
        const filterForm = document.getElementById('filter-form'); // Pastikan form filter Anda punya id="filter-form"

        if (cekSemuaBtn && filterForm) {
            cekSemuaBtn.addEventListener('click', function () {
                
                this.textContent = 'Mengecek Semua Data...';
                this.disabled = true;

                // 1. Ambil semua parameter filter yang sedang aktif
                const formData = new FormData(filterForm);
                const params = new URLSearchParams(formData).toString();

                // 2. Minta ke server untuk menghitung SEMUA data yang terfilter (bukan hanya yang di halaman ini)
                fetch(`{{ route('karyawan-tetap.index') }}?${params}&cek_semua=true`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest' // Penting untuk menandai ini sebagai request AJAX
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // 3. Setelah dapat semua hasil, update tabel yang terlihat di halaman ini
                    updateTableWithResults(data);
                    
                    this.textContent = 'Cek Prospek Gaji';
                    this.disabled = false;
                    alert('Pengecekan selesai!');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                    this.textContent = 'Cek Prospek Gaji';
                    this.disabled = false;
                });
            });
        }
    });

    function updateTableWithResults(data) {
        // 'data' adalah objek berisi { id: gaji, id: gaji, ... }
        for (const pegawaiId in data) {
            const kenaikanGaji = data[pegawaiId];
            
            // Cari sel di tabel yang sedang ditampilkan
            const kenaikanGajiCell = document.getElementById(`kenaikan-gaji-cell-${pegawaiId}`);
            const statusKenaikanCell = document.getElementById(`status-kenaikan-cell-${pegawaiId}`);

            // Jika selnya ada di halaman ini, update isinya
            if (kenaikanGajiCell && statusKenaikanCell) {
                if (kenaikanGaji) {
                    const formattedGaji = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(kenaikanGaji);
                    kenaikanGajiCell.innerHTML = `<span class="font-bold text-green-600">${formattedGaji.replace('Rp', 'Rp ')}</span>`;
                    
                    statusKenaikanCell.innerHTML = `
                        <form action="/karyawan-tetap/${pegawaiId}/approve-raise" method="POST" onsubmit="return confirm('Anda yakin?');">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-xs">
                                Setujui
                            </button>
                        </form>
                    `;
                } else {
                    kenaikanGajiCell.innerHTML = '-';
                    statusKenaikanCell.innerHTML = '-';
                }
            }
        }
    });
</script>
@endsection