<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Menggunakan variabel tunggal $karyawanKontrak --}}
    <title>Detail Karyawan - {{ $karyawanKontrak->nama }}</title>
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
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #7f8c8d;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .content-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .content-table .label {
            background-color: #f9f9f9;
            font-weight: bold;
            width: 30%;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 10px;
            color: #999;
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
    </style>
</head>
<body>

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

    <div class="container">
        <table class="content-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td>{{ $karyawanKontrak->nama }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Induk</td>
                <td>{{ $karyawanKontrak->nomor_induk ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Lahir</td>
                <td>{{ $karyawanKontrak->tanggal_lahir ? \Carbon\Carbon::parse($karyawanKontrak->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Gender</td>
                <td>{{ $karyawanKontrak->gender == 'Male' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="label">Jabatan</td>
                <td>{{ $karyawanKontrak->jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Bagian</td>
                <td>{{ $karyawanKontrak->bagian ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Unit Kerja</td>
                <td>{{ $karyawanKontrak->unit_kerja ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Pendidikan Terakhir</td>
                <td>{{ $karyawanKontrak->pendidikan ?? '-' }}</td>
            </tr>
             <tr>
                <td class="label">Status Keluarga</td>
                <td>{{ $karyawanKontrak->keluarga_status ?? '-' }}</td>
            </tr>
             <tr>
                <td class="label">Jumlah Anak</td>
                <td>{{ $karyawanKontrak->keluarga_anak ?? '0' }}</td>
            </tr>
            <tr>
                <td class="label">Gaji Pokok</td>
                <td>Rp {{ $karyawanKontrak->gaji ? number_format($karyawanKontrak->gaji, 0, ',', '.') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Status Karyawan</td>
                <td>{{ $karyawanKontrak->status ?? '-' }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
