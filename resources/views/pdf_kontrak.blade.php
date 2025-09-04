<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan Kontrak</title>
    <style>
        /* Gaya dasar untuk PDF */
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
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>DATA KARYAWAN KONTRAK</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tgl. Lahir</th>
                <th>Gender</th>
                <th>Jabatan</th>
                <th>Bagian</th>
                <th>Unit Kerja</th>
                <th>Pendidikan</th>
                <th>Status Keluarga</th>
                <th>Jml. Anak</th>
                <th>Masa Kerja</th>
                <th>Tgl. Perhitungan</th>
                <th>Gaji</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            {{-- PERBAIKAN DI SINI: dari $karyawanKontrak menjadi $karyawanKontraks --}}
            @forelse($karyawanKontraks as $index => $data)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->tanggal_lahir ? \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                    <td>{{ $data->gender ?? '-' }}</td>
                    <td>{{ $data->jabatan ?? '-' }}</td>
                    <td>{{ $data->bagian ?? '-' }}</td>
                    <td>{{ $data->unit_kerja ?? '-' }}</td>
                    <td>{{ $data->pendidikan ?? '-' }}</td>
                    <td>{{ $data->keluarga_status ?? '-' }}</td>
                    <td class="text-center">{{ $data->keluarga_anak ?? '-' }}</td>
                    <td>{{ $data->masa_kerja ?? '-' }}</td>
                    <td>{{ $data->tanggal_perhitungan ? \Carbon\Carbon::parse($data->tanggal_perhitungan)->format('d-m-Y') : '-' }}</td>
                    <td class="text-right">Rp {{ $data->gaji ? number_format($data->gaji, 0, ',', '.') : '-' }}</td>
                    <td>{{ $data->status ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="15" class="text-center">Tidak ada data karyawan kontrak.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
