<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
    <style>
        /* Mengganti font menjadi Bookman Old Style dengan fallback serif standar */
        body { font-family: 'Bookman Old Style', serif; font-size: 10pt; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 5px; text-align: left; vertical-align: top; }
        th { background-color: #f2f2f2; font-weight: bold; } /* Font-weight bold standar */
        h1, h3 { color: #333; font-weight: bold; }
        h1 { font-size: 16pt; }
        h3 { 
            border-bottom: 1px solid #ddd; 
            padding-bottom: 5px; 
            margin-top: 25px; /* Memberi jarak antar bagian */
            margin-bottom: 10px;
        }

        /* --- TATA LETAK HEADER (TIDAK BERUBAH) --- */
        .header-table {
            width: 100%;
            border: none;
            margin-bottom: 25px;
            border-bottom: 2px solid #333;
        }
        .header-table td {
            border: none;
            padding: 0 0 15px 0;
            vertical-align: middle;
        }
        .header-table .logo-cell {
            width: 80px;
        }
        .header-table .text-cell {
            text-align: center;
        }
        .header-table .logo {
            width: 60px;
            height: auto;
        }

        /* --- TATA LETAK BAGIAN DATA PRIBADI (TIDAK BERUBAH) --- */
        .personal-info-section {
            width: 100%;
            border: none;
            margin-bottom: 0;
        }
        .personal-info-section > tbody > tr > td {
            border: none;
            padding: 0;
            vertical-align: top;
        }
        .personal-info-section .photo-cell {
            width: 160px; /* Lebar area foto diperbesar */
            padding-left: 40px;
            text-align: center;
        }
        .photo-cell img {
            max-width: 210px; /* Ukuran foto diperbesar */
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    @foreach($pegawais as $pegawai)
        {{-- Header dengan Logo --}}
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ public_path('img/LOGO_PERUMDA.png') }}" class="logo" alt="Logo Perumdam">
                </td>
                <td class="text-cell">
                    <h1>Perumdam Tirta Bhakti Raharja</h1>
                </td>
            </tr>
        </table>

        {{-- Judul "Data Pribadi" --}}
        <h3>Data Pribadi</h3>
        
        {{-- Tabel pembungkus untuk data teks dan foto --}}
        <table class="personal-info-section">
            <tr>
                {{-- Kolom Kiri: Tabel berisi data teks --}}
                <td>
                    <table>
                        <tr><th>Nama Lengkap</th><td>{{ $pegawai->nama }}</td></tr>
                        <tr><th>Nomor Induk</th><td>{{ $pegawai->nomor_induk }}</td></tr>
                        <tr><th>Tanggal Lahir</th><td>{{ optional($pegawai->tanggal_lahir)->format('d-m-Y') }}</td></tr>
                        <tr><th>Gender</th><td>{{ $pegawai->gender }}</td></tr>
                        <tr><th>Pendidikan</th><td>{{ $pegawai->pendidikan }}</td></tr>
                        <tr><th>Status Keluarga</th><td>{{ $pegawai->keluarga_status }}</td></tr>
                        <tr><th>Jumlah Anak</th><td>{{ $pegawai->keluarga_anak }}</td></tr>
                    </table>
                </td>
                
                {{-- Kolom Kanan: Foto Pegawai --}}
                <td class="photo-cell">
                    @php
                        $image_path = null;
                        if ($pegawai->foto) {
                            $full_path = storage_path('app/public/' . $pegawai->foto);
                            if (file_exists($full_path)) {
                                $image_path = $full_path;
                            }
                        }
                    @endphp

                    @if($image_path)
                        @php
                            $type = pathinfo($image_path, PATHINFO_EXTENSION);
                            $data = file_get_contents($image_path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        @endphp
                        <img src="{{ $base64 }}" alt="Foto">
                    @else
                        {{-- Placeholder jika tidak ada foto (ukuran disesuaikan) --}}
                        <div style="width: 140px; height: 180px; border: 1px solid #ddd; display: table-cell; vertical-align: middle; text-align: center; color: #888; background-color: #f9f9f9;">
                            (No Photo)
                        </div>
                    @endif
                </td>
            </tr>
        </table>

        {{-- Tabel "Data Kepegawaian" sekarang berada di bawah --}}
        <h3>Data Kepegawaian</h3>
        <table>
            <tr><th>Tanggal Masuk</th><td>{{ optional($pegawai->tanggal_masuk)->format('d-m-Y') }}</td></tr>
            <tr><th>Jabatan</th><td>{{ $pegawai->jabatan }}</td></tr>
            <tr><th>Bagian</th><td>{{ $pegawai->bagian }}</td></tr>
            <tr><th>Unit Kerja</th><td>{{ $pegawai->unit_kerja }}</td></tr>
            <tr><th>Golongan</th><td>{{ $pegawai->golongan }}</td></tr>
            <tr><th>Klasifikasi</th><td>{{ $pegawai->klasifikasi }}</td></tr>
            <tr><th>Status Pegawai</th><td>{{ $pegawai->status }}</td></tr>
        </table>

        {{-- Sisa dokumen (tidak ada perubahan) --}}
        <h3>Informasi Gaji & Sanksi</h3>
        <table>
            <tr><th>Gaji Saat Ini</th><td>Rp {{ number_format($pegawai->gaji, 0, ',', '.') }}</td></tr>
            <tr><th>Prospek Kenaikan Gaji</th><td>{{ $pegawai->kenaikan_gaji_dihitung ? 'Rp ' . number_format($pegawai->kenaikan_gaji_dihitung, 0, ',', '.') : '-' }}</td></tr>
            <tr><th>Status Kenaikan</th><td>{{ $pegawai->status_kenaikan }}</td></tr>
            <tr><th>Jenis Hukuman</th><td>{{ $pegawai->jenis_hukuman ?: 'Tidak Ada' }}</td></tr>
            <tr><th>Alasan Hukuman</th><td>{{ $pegawai->alasan_hukuman }}</td></tr>
        </table>

        <h3>Riwayat Status Kepegawaian</h3>
        <table>
            <thead>
                <tr>
                    <th>Status Kepegawaian</th>
                    <th>Tanggal</th>
                    <th>No. SP / ST / SK</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pegawai->riwayatStatusKepegawaians as $riwayat)
                    <tr>
                        <td>{{ $riwayat->status_kepegawaian }}</td>
                        <td>{{ optional($riwayat->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $riwayat->keterangan }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>

        <h3>Riwayat Jabatan</h3>
        <table>
              <thead>
                <tr>
                    <th>Jabatan</th>
                    <th>Terhitung Mulai Tanggal</th>
                    <th>Nomor SK / Surat Tugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pegawai->riwayatJabatans as $riwayat)
                    <tr>
                        <td>{{ $riwayat->status_kepegawaian }}</td>
                        <td>{{ optional($riwayat->tgl_mulai)->format('d-m-Y') }}</td>
                        <td>{{ $riwayat->nomor_sk }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>

        <h3>Riwayat Diklat</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama / Materi Diklat</th>
                    <th>Tempat</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Berakhir</th>
                    <th>Penyelenggara</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pegawai->riwayatDiklats as $riwayat)
                    <tr>
                        <td>{{ $riwayat->nama_materi }}</td>
                        <td>{{ $riwayat->tempat }}</td>
                        <td>{{ optional($riwayat->tanggal_mulai)->format('d-m-Y') }}</td>
                        <td>{{ optional($riwayat->tanggal_berakhir)->format('d-m-Y') }}</td>
                        <td>{{ $riwayat->penyelenggara }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>

        @if(!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
</body>
</html>

