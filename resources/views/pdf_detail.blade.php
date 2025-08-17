<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        h1, h2, h3 { color: #333; border-bottom: 2px solid #f2f2f2; padding-bottom: 5px; }
        .section-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .section {
            width: 48%;
        }
    </style>
</head>
<body>
    @foreach($pegawais as $pegawai)
        <h1>Detail Data Karyawan</h1>
        
        <div class="section-container">
            <div class="section">
                <h3>Data Pribadi</h3>
                <table>
                    <tr><th>Nama Lengkap</th><td>{{ $pegawai->nama }}</td></tr>
                    <tr><th>Nomor Induk</th><td>{{ $pegawai->nomor_induk }}</td></tr>
                    <tr><th>Tanggal Lahir</th><td>{{ optional($pegawai->tanggal_lahir)->format('d-m-Y') }}</td></tr>
                    <tr><th>Gender</th><td>{{ $pegawai->gender }}</td></tr>
                    <tr><th>Pendidikan Terakhir</th><td>{{ $pegawai->pendidikan }}</td></tr>
                    <tr><th>Status Keluarga</th><td>{{ $pegawai->keluarga_status }}</td></tr>
                    <tr><th>Jumlah Anak</th><td>{{ $pegawai->keluarga_anak }}</td></tr>
                </table>
            </div>
            <div class="section">
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
            </div>
        </div>

        <h3>Informasi Gaji & Sanksi</h3>
        <table>
            <tr><th>Gaji Saat Ini</th><td>Rp {{ number_format($pegawai->gaji, 0, ',', '.') }}</td></tr>
            {{-- PERBAIKAN: Menambahkan Prospek Kenaikan Gaji --}}
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
                    <th>Keterangan (No. SK)</th>
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
                    <th>TMT</th>
                    <th>Nomor SK</th>
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
                    <th>Nama Materi</th>
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
