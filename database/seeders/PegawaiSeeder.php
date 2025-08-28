<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pegawai; // Pastikan Anda meng-import model Pegawai
use Carbon\Carbon; // Untuk mengelola tanggal

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua data yang ada di tabel 'pegawais' sebelum menambahkan yang baru
        Pegawai::truncate();

$nipAndEntryDateData = [
    'BAGUS SETIAWAN D. S.Sos.' => ['nip' => '01 74 101', 'tanggal_masuk' => '08/02/1974'],
    'YUNITA APRIANI W., S.E.' => ['nip' => '02 75 102', 'tanggal_masuk' => '12/05/1975'],
    'HERU PRATAMA, S.E.' => ['nip' => '03 71 103', 'tanggal_masuk' => '20/05/1971'],
    'HENDRA RIFKI, Ir' => ['nip' => '04 70 104', 'tanggal_masuk' => '14/06/1970'],
    'GALIH RAHARJA, S.T.' => ['nip' => '05 75 105', 'tanggal_masuk' => '29/11/1975'],
    'RUDI SETYAWAN, S.T.' => ['nip' => '06 72 106', 'tanggal_masuk' => '09/09/1972'],
    'ANISA LESTARI, S.E.' => ['nip' => '07 78 107', 'tanggal_masuk' => '06/01/1978'],
    'RAHMAT HIDAYAT, S.E.' => ['nip' => '08 88 108', 'tanggal_masuk' => '04/09/1988'],
    'ADITYA KURNIAWAN' => ['nip' => '09 70 109', 'tanggal_masuk' => '12/06/1970'],
    'DEWI KARTIKA SARI' => ['nip' => '10 73 110', 'tanggal_masuk' => '08/10/1973'],
    'FITRIANI SUNDARI' => ['nip' => '11 71 111', 'tanggal_masuk' => '31/03/1971'],
    'ASEP SURYANA' => ['nip' => '12 70 112', 'tanggal_masuk' => '01/05/1970'],
    'MAYA ANGGRAINI' => ['nip' => '01 76 113', 'tanggal_masuk' => '20/08/1976'],
    'IRFAN NUGROHO, S.T.' => ['nip' => '02 89 114', 'tanggal_masuk' => '09/09/1989'],
    'AGUNG SAPUTRA, S.A.P.' => ['nip' => '03 92 115', 'tanggal_masuk' => '27/02/1992'],
    'FIRDAUS KUSNADI' => ['nip' => '04 73 116', 'tanggal_masuk' => '17/07/1973'],
    'SILVIANI PUTRI, S.E.' => ['nip' => '05 90 117', 'tanggal_masuk' => '17/02/1990'],
    'RIZKY ARDIANSYAH' => ['nip' => '06 71 118', 'tanggal_masuk' => '03/07/1971'],
    'DINDA KARTINI, S.E.' => ['nip' => '07 80 119', 'tanggal_masuk' => '25/09/1980'],
    'MELI ANGGI, Amd.' => ['nip' => '08 85 120', 'tanggal_masuk' => '02/04/1985'],
    'LUTFI HIDAYAT' => ['nip' => '09 86 121', 'tanggal_masuk' => '14/08/1986'],
    'ANGGA KURNIAWAN' => ['nip' => '10 83 122', 'tanggal_masuk' => '21/02/1983'],
    'CITRA MELATI' => ['nip' => '11 88 123', 'tanggal_masuk' => '30/09/1988'],
    'FAHMI RIZAL' => ['nip' => '12 84 124', 'tanggal_masuk' => '19/11/1984'],
    'NUR AINI' => ['nip' => '01 81 125', 'tanggal_masuk' => '05/05/1981'],
    'SEPTIAN WICAKSANA' => ['nip' => '02 87 126', 'tanggal_masuk' => '12/12/1987'],
    'ANDINI MAHARANI' => ['nip' => '03 90 127', 'tanggal_masuk' => '08/06/1990'],
    'MUHAMMAD IQBAL' => ['nip' => '04 82 128', 'tanggal_masuk' => '23/03/1982'],
    'DWI CAHYONO' => ['nip' => '05 77 129', 'tanggal_masuk' => '07/07/1977'],
    'LINA APRILIA' => ['nip' => '06 91 130', 'tanggal_masuk' => '14/10/1991'],
    'FAUZI RAMDHAN' => ['nip' => '07 74 131', 'tanggal_masuk' => '09/01/1974'],
    'TIARA PUSPITA' => ['nip' => '08 86 132', 'tanggal_masuk' => '28/11/1986'],
    'HANIF SETYO' => ['nip' => '09 89 133', 'tanggal_masuk' => '16/04/1989'],
    'KARINA WULANDARI' => ['nip' => '10 79 134', 'tanggal_masuk' => '02/02/1979'],
    'BAGAS PRABOWO' => ['nip' => '11 83 135', 'tanggal_masuk' => '19/08/1983'],
    'YULIANA RAHMA' => ['nip' => '12 85 136', 'tanggal_masuk' => '06/06/1985'],
    'RANGGA PRATAMA' => ['nip' => '01 84 137', 'tanggal_masuk' => '13/03/1984'],
    'SUSANTI ANGGRAINI' => ['nip' => '02 82 138', 'tanggal_masuk' => '11/07/1982'],
    'ALDI SAPUTRA' => ['nip' => '03 78 139', 'tanggal_masuk' => '04/09/1978'],
    'RINA KARTIKA' => ['nip' => '04 91 140', 'tanggal_masuk' => '22/05/1991'],
    'ANDREAS SITOMPUL' => ['nip' => '05 72 141', 'tanggal_masuk' => '17/12/1972'],
    'NOVI YULIANTI' => ['nip' => '06 80 142', 'tanggal_masuk' => '08/08/1980'],
    'WIDYA AMALIA' => ['nip' => '07 88 143', 'tanggal_masuk' => '26/04/1988'],
    'BAYU ANGGARA' => ['nip' => '08 79 144', 'tanggal_masuk' => '30/01/1979'],
    'IKA MARLINA' => ['nip' => '09 76 145', 'tanggal_masuk' => '14/09/1976'],
    'FITRA HIDAYAH' => ['nip' => '10 87 146', 'tanggal_masuk' => '27/11/1987'],
    'AKBAR SUSANTO' => ['nip' => '11 90 147', 'tanggal_masuk' => '05/02/1990'],
    'RATNA DEWI' => ['nip' => '12 73 148', 'tanggal_masuk' => '11/11/1973'],
    'JOKO SANTOSO' => ['nip' => '01 75 149', 'tanggal_masuk' => '07/07/1975'],
    'NURUL AZIZAH' => ['nip' => '02 81 150', 'tanggal_masuk' => '02/06/1981'],
];



$rawData = "BAGUS SETIAWAN D. S.Sos.	D1	K	1	KABAG	HUBLANG	PUSAT	1	3.903.130	 8.288.144 	HUBLANG	HUBLANGPUSAT	24	 4.488.600 	08-02-1974	1	1	 8.108.600 		700000	100%	700000
YUNITA APRIANI W., S.E.	C4	K	1	KASUBAG	PEMASARAN & INFORMASI	PUSAT	1	3.519.557	 6.729.390 	HUBLANG	HUBLANGPUSAT	24	 4.047.490 	12-05-1975	1	1	 6.567.490 		700000	100%	700000
HERU PRATAMA, S.E.	C4	TK	1	KASUBAG	MSDM	PUSAT	1	3.744.772	 6.469.291 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 3.932.010 	20-05-1971	0	1	 6.312.010 		700000	100%	700000
HENDRA RIFKI, Ir	C4	K	2	KA SPI	KA SPI	PUSAT	1	3.206.962	 8.012.289 	SPI	SPIPUSAT	38	 3.848.354 	14-06-1970	1	1	 7.858.354 		700000	100%	700000
GALIH RAHARJA, S.T.	C3	K	1	KABAG	TEKNIK	PUSAT	1	2.891.769	 7.078.555 	TRANDIST	TRANDISTPUSAT	2	 3.325.534 	29-11-1975	1	1	 6.945.534 		700000	100%	700000
RUDI SETYAWAN, S.T.	C3	K	2	KASUBAG	PENGADUAN & TAGIHAN	PUSAT	1	2.982.822	 6.382.562 	HUBLANG	HUBLANGPUSAT	24	 3.579.387 	09-09-1972	1	1	 6.239.387 		700000	100%	700000
ANISA LESTARI, S.E.	C3	K	2	FUNGSIONAL SPI	FUNGSIONAL SPI ADM & KEU	PUSAT	1	3.273.639	 6.195.502 	SPI	SPIPUSAT	38	 3.928.367 	06-01-1978	1	1	 6.038.367 		700000	100%	700000
RAHMAT HIDAYAT, S.E.	C1	K	0	KABAG	ADM & KEUANGAN	PUSAT	1	2.425.386	 6.254.642 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.667.925 	04-09-1988	1	1	 6.147.925 		700000	100%	700000
ADITYA KURNIAWAN	C1	K	1	FUNGSIONAL SPI	FUNGSIONAL SPI TEKNIK	PUSAT	1	3.108.201	 5.687.408 	SPI	SPIPUSAT	38	 3.574.431 	12-06-1970	1	1	 5.544.431 		700000	100%	700000
DEWI KARTIKA SARI	C1	TK	1	STAF	ADM UMUM & SARANA	PUSAT	1	3.307.068	 4.591.318 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 3.472.421 	08-10-1973	1	1	 4.452.421 		700000	100%	700000
FITRIANI SUNDARI	C1	K	1	KASUBAG	PEMBUKUAN	PUSAT	1	3.307.068	 6.475.253 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 3.803.128 	31-03-1971	1	1	 6.323.128 		700000	100%	700000
ASEP SURYANA	C1	K	2	STAF	PEMASARAN & INFORMASI	PUSAT	1	3.307.068	 5.387.220 	HUBLANG	HUBLANGPUSAT	24	 3.968.481 	01-05-1970	1	1	 5.228.481 		700000	100%	700000
MAYA ANGGRAINI	C1	K	2	STAF	DISTRIBUSI	PUSAT	1	2.921.343	 4.905.836 	TRANDIST	TRANDISTPUSAT	2	 3.505.612 	20-08-1976	1	1	 4.765.612 		700000	100%	700000
IRFAN NUGROHO, S.T.	C1	K	2	KASUBAG	LAHTA	PUSAT	1	2.351.270	 5.594.385 	HUBLANG	HUBLANGPUSAT	24	 2.821.524 	09-09-1989	1	1	 5.481.524 		700000	100%	700000
AGUNG SAPUTRA, S.A.P.	C1	K	1	KASUBAG	KEUANGAN	PUSAT	1	2.425.386	 5.420.762 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.789.194 	27/02/1992	1	1	 5.309.194 		700000	100%	700000
FIRDAUS KUSNADI	C1	K	2	KASUBAG	ADM UMUM & SARANA	PUSAT	1	3.411.206	 6.917.185 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 4.093.447 	17-07-1973	1	1	 6.753.447 		700000	100%	700000
SILVIANI PUTRI, S.E.	C1	K	1	STAF	PEMBUKUAN	PUSAT	1	2.351.270	 3.932.119 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.703.961 	17-02-1990	1	1	 3.823.961 		700000	100%	700000
RIZKY ARDIANSYAH	C1	K	2	KASUBAG	PERENCANAAN	PUSAT	1	3.307.068	 6.787.220 	TRANDIST	TRANDISTPUSAT	2	 3.968.481 	03-07-1971	1	1	 6.628.481 		700000	100%	700000
DINDA KARTINI, S.E.	C1	K	2	STAF	KEUANGAN	PUSAT	1	2.425.386	 4.286.882 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.910.463 	25-09-1980	1	1	 4.170.463 		700000	100%	700000
MELI ANGGI, Amd.	C1	K	2	BENDAHARA	RUTIN	PUSAT	1	2.580.518	 5.180.487 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 3.096.622 	02-04-1985	1	1	 5.056.622 		700000	100%	700000
LUTFI HIDAYAT	B4	K	2	STAF	ADM UMUM & SARANA	PUSAT	1	2.326.894	 4.163.963 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.792.272 	02-02-1980	1	1	 4.052.272 		700000	100%	700000
ANGGA KURNIAWAN	B4	K	1	STAF	ADM UMUM & SARANA	PUSAT	1	1.992.701	 3.503.270 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.291.606 	11-05-1987	1	1	 3.411.606 		700000	100%	700000
CITRA MELATI	B4	K	0	KASUBAG	PEMELIHARAAN	PUSAT	1	1.992.701	 4.659.650 	TRANDIST	TRANDISTPUSAT	2	 2.191.971 	19-08-1984	1	1	 4.571.971 		700000	100%	700000
FAHMI RIZAL	C1	K	2	STAF	PENGADUAN & TAGIHAN	PUSAT	1	2.661.804	 4.581.931 	HUBLANG	HUBLANGPUSAT	24	 3.194.164 	08-02-1983	1	1	 4.454.164 		700000	100%	700000
NUR AINI	C1	K	1	STAF	KEUANGAN	PUSAT	1	2.661.804	 4.303.517 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 3.061.074 	15-02-1984	1	1	 4.181.074 		700000	100%	700000
SEPTIAN WICAKSANA	C1	TK	0	STAF	PRODUKSI	PUSAT	1	1.931.849	 2.849.123 	SUMBER	SUMBERPUSAT	1	 1.931.849 	05-04-1994	1	1	 2.771.849 		700000	100%	700000
ANDINI MAHARANI	B4	K	1	STAF	PERENCANAAN	PUSAT	1	1.931.849	 3.430.491 	TRANDIST	TRANDISTPUSAT	2	 2.221.626 	26/10/1987	1	1	 3.341.626 		700000	100%	700000
MUHAMMAD IQBAL	B4	K	2	KASUBAG	PRODUKSI	PUSAT	1	1.931.849	 5.070.947 	SUMBER	SUMBERPUSAT	1	 2.318.218 	24-12-1990	1	1	 4.978.218 		700000	100%	700000
DWI CAHYONO	B4	K	2	STAF	PEMELIHARAAN	PUSAT	1	1.931.849	 3.670.947 	TRANDIST	TRANDISTPUSAT	2	 2.318.218 	01-09-1986	1	1	 3.578.218 		700000	100%	700000
LINA APRILIA	B3	K	1	STAF	LAHTA	PUSAT	1	1.853.431	 3.336.704 	HUBLANG	HUBLANGPUSAT	24	 2.131.446 		1	1	 3.251.446 		700000	100%	700000
FAUZI RAMDHAN	B3	K	2	STAF	GUDANG	PUSAT	1	2.034.195	 3.798.675 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.441.034 	02/01/1976	1	1	 3.701.034 		700000	100%	700000
TIARA PUSPITA	B3	K	2	STAF	PEMASARAN & INFORMASI	PUSAT	1	2.034.195	 3.798.675 	HUBLANG	HUBLANGPUSAT	24	 2.441.034 	03-01-1975	1	1	 3.701.034 		700000	100%	700000
HANIF SETYO	B4	K	2	STAF	MSDM	PUSAT	1	1.931.849	 3.670.947 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.318.218 	24-07-1990	1	1	 3.578.218 		700000	100%	700000
KARINA WULANDARI	IVAN IVANA HANGGADITYA	B2	TK	0	STAF	PRODUKSI	PUSAT	1	1.834.253	 2.747.623 	SUMBER	SUMBERPUSAT	1	 1.834.253 	06-10-1979	1	1	 2.674.253 		700000	100%	700000
BAGAS PRABOWO	GUGUN GUMELAR	B2	K	1	STAF	PERENCANAAN	PUSAT	1	1.834.253	 3.313.766 	TRANDIST	TRANDISTPUSAT	2	 2.109.390 	12-11-1992	1	1	 3.229.390 		700000	100%	700000
YULIANA RAHMA	EDI SUDRAJAT	B1	K	2	STAF	PRODUKSI	PUSAT	1	1.302.645	 2.633.700 	SUMBER	SUMBERPUSAT	1	 1.563.174 	20-06-1979	1	1	 2.571.174 		560000	100%	560000
RANGGA PRATAMA	RINA NURAENA	B1	K	2	STAF	PEMBUKUAN	PUSAT	1	1.706.096	 3.389.208 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 2.047.315 		1	1	 3.307.315 		700000	100%	700000
SUSANTI ANGGRAINI	ALDY DWICAHYA, S.E	B1	TK	0	STAF	PEMBUKUAN	PUSAT	1	1.654.027	 2.560.188 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 1.654.027 		1	1	 2.494.027 		700000	100%	700000
ALDI SAPUTRA	DIMAS PRAMESETIA, S.T	B1	K	1	STAF	PERENCANAAN	PUSAT	1	1.654.027	 3.098.216 	TRANDIST	TRANDISTPUSAT	2	 1.902.131 		1	1	 3.022.131 		700000	100%	700000
RINA KARTIKA	JENITA NURMALA	B1	K	1	STAF	MSDM	PUSAT	1	1.628.306	 3.067.454 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 1.872.552 		1	1	 2.992.552 		700000	100%	700000
ANDREAS SITOMPUL	PRASETYO ADHIUTAMA	B1	K	0	STAF	PENGOLAHAN DATA	PUSAT	1	1.628.306	 2.842.782 	HUBLANG	HUBLANGPUSAT	24	 1.791.136 		1	1	 2.771.136 		700000	100%	700000
NOVI YULIANTI	LILI HAMBALI	A4	K	2	STAF	PRODUKSI	PUSAT	1	1.636.461	 3.302.304 	SUMBER	SUMBERPUSAT	1	 1.963.753 	26-02-1977	1	1	 3.223.753 		700000	100%	700000
WIDYA AMALIA	ANDANG SUHENDAR	A4	K	2	STAF	PRODUKSI	PUSAT	1	1.636.461	 3.302.304 	SUMBER	SUMBERPUSAT	1	 1.963.753 	14-08-1979	1	1	 3.223.753 		700000	100%	700000
BAYU ANGGARA	ADI RISMAYANTO	B1	TK	0	STAF	ADM UMUM & SARANA	PUSAT	1	1.302.645	 2.026.750 	ADM/KEUANGAN	ADM/KEUANGANPUSAT	13	 1.302.645 		1	1	 1.974.645 		560000	100%	560000
IKA MARLINA	ENO C. JUARSIH	C1	K	2	KAUR	ADM & KEUANGAN	MAJALENGKA	2	3.108.201	 5.989.035 	ADM/KEUANGAN	ADM/KEUANGANMAJALENGKA	14	 3.729.841 	27-05-1975	1	1	 5.839.841 		700000	100%	700000
FITRA HIDAYAH	ACHMAD SAHIDIN	C1	K	1	KAUR	DISTRIBUSI & PENYAMBUNGAN	MAJALENGKA	2	3.108.201	 5.687.408 	TRANDIST	TRANDISTMAJALENGKA	3	 3.574.431 	13/03/1973	1	1	 5.544.431 		700000	100%	700000
AKBAR SUSANTO	YAYAT SUPRIATNA	C1	K	2	STAF	DISTRIBUSI & PENYAMBUNGAN	MAJALENGKA	2	3.108.201	 5.139.035 	TRANDIST	TRANDISTMAJALENGKA	3	 3.729.841 	18-03-1972	1	1	 4.989.841 		700000	100%	700000
RATNA DEWI	ADI HARTONO	C1	K	2	KACAB	KACAB	MAJALENGKA	2	3.307.068	 7.387.220 	ADM/KEUANGAN	ADM/KEUANGANMAJALENGKA	14	 3.968.481 	05-01-1972	1	1	 7.228.481 		700000	100%	700000
JOKO SANTOSO	INDRA SUPRIATNO, S.I.P.	B4	K	1	STAF	ADM & KEUANGAN	MAJALENGKA	2	1.992.701	 3.503.270 	ADM/KEUANGAN	ADM/KEUANGANMAJALENGKA	14	 2.291.606 	12/04/1992	1	1	 3.411.606 		700000	100%	700000
NURUL AZIZAH	AFRIZAL IQBALI	B2	K	2	STAF	DISTRIBUSI & PENYAMBUNGAN	MAJALENGKA	2	1.778.240	 3.479.244 	TRANDIST	TRANDISTMAJALENGKA	3	 2.133.888 	05-09-1996	1	1	 3.393.888 		700000	100%	700000";



$lines = explode("\n", $rawData);
$nipCounter = 1;

// Gender mapping helper (simplified)
$genderMap = [
    'ANISA' => 'Female', 'RATNA' => 'Female', 'PUTRI' => 'Female', 'DINA' => 'Female',
    'GITA' => 'Female', 'HANIFAH' => 'Female', 'JASMINE' => 'Female', 'Nabila' => 'Female',
    'OLIVIA' => 'Female', 'QUEENSHA' => 'Female', 'RIANA' => 'Female', 'ULFA' => 'Female',
    'WULAN' => 'Female', 'FITRIANI' => 'Female', 'IKA' => 'Female', 'KARINA' => 'Female',
    'LINA' => 'Female', 'MIA' => 'Female', 'QORI' => 'Female', 'SARI' => 'Female',
    'TITA' => 'Female', 'VINA' => 'Female', 'YULIA' => 'Female', 'ZAHRA' => 'Female',
    'ADINDA' => 'Female', 'CINTA' => 'Female', 'ELVIRA' => 'Female', 'GHEA' => 'Female',
    'JIHAN' => 'Female', 'KIKI' => 'Female', 'LALA' => 'Female', 'MAWAR' => 'Female',
    'NOVA' => 'Female', 'ZASKIA' => 'Female', 'BELLA' => 'Female', 'CHIKA' => 'Female',
    'HAPPY' => 'Female', 'INUL' => 'Female', 'KRIS' => 'Female', 'LESTI' => 'Female',
    'NAFA' => 'Female', 'UMI' => 'Female', 'VIA' => 'Female', 'YUNI' => 'Female',
    'ZIVILIA' => 'Female', 'AYU' => 'Female', 'CITA' => 'Female', 'EVI' => 'Female',
    'IIS' => 'Female', 'JENITA' => 'Female', 'LIA' => 'Female',
];

        foreach ($lines as $line) {
            $line = trim($line); // Hapus spasi di awal/akhir baris
            if (empty($line)) {
                continue; // Lewati baris kosong
            }

            // Pisahkan kolom berdasarkan tab
            $parts = explode("\t", $line);

            // Pastikan baris memiliki jumlah kolom yang diharapkan
            // Berdasarkan analisis data yang diberikan, ada 21 kolom per baris
            if (count($parts) < 21) {
                // Jika baris tidak memiliki cukup kolom, mungkin itu baris header atau formatnya berbeda.
                // Anda bisa log error atau melewatkannya.
                error_log("Baris tidak memiliki cukup kolom (diharapkan 21): " . $line);
                continue;
            }

            // Ekstrak data dan lakukan pembersihan/transformasi
            $nama = trim($parts[0]);
            $golonganRaw = trim($parts[1]); // Ambil golongan mentah
            $keluargaStatusRaw = trim($parts[2]);
            $keluargaAnak = (int) trim($parts[3]);
            $jabatanRaw = trim($parts[4]); // Ambil jabatan mentah
            $bagianRaw = trim($parts[5]); // Ambil bagian mentah
            $unitKerjaRaw = trim($parts[6]); // Ambil unit_kerja mentah
            $gajiRaw = trim($parts[8]); // Kolom Gaji Pokok
            $klasifikasiRaw = trim($parts[10]); // Ambil klasifikasi mentah
            $tanggalLahirRaw = trim($parts[14]); // Kolom Tanggal Lahir

            // --- Transformasi Data ---
// 1. Nomor Induk: Ambil dari data yang disediakan
            $nomorInduk = null;
            $tanggalMasuk = null;

            // Cari data NIP dan Tanggal Masuk berdasarkan nama pegawai
            if (isset($nipAndEntryDateData[$nama])) {
                $nomorInduk = $nipAndEntryDateData[$nama]['nip'];
                $tanggalMasukRaw = $nipAndEntryDateData[$nama]['tanggal_masuk'];
                
                // Format Tanggal Masuk ke Y-m-d
                try {
                    // Coba format DD/MM/YYYY
                    $tanggalMasuk = Carbon::createFromFormat('d/m/Y', $tanggalMasukRaw)->format('Y-m-d');
                } catch (\Exception $e) {
                    try {
                        // Coba format DD-MM-YYYY
                        $tanggalMasuk = Carbon::createFromFormat('d-m-Y', $tanggalMasukRaw)->format('Y-m-d');
                    } catch (\Exception $e) {
                        // Jika kedua format gagal, gunakan tanggal default
                        $tanggalMasuk = '1900-01-01';
                        error_log("Format tanggal masuk tidak valid untuk '" . $nama . "': " . $tanggalMasukRaw);
                    }
                }
            } else {
                error_log("Data NIP dan Tanggal Masuk tidak ditemukan untuk pegawai: " . $nama);
                // Jika tidak ditemukan, Anda bisa memilih untuk melewatkan entri ini
                // atau memberikan nilai default/dummy
                $nomorInduk = 'NIP_UNKNOWN'; // Default jika tidak ditemukan
                $tanggalMasuk = '1900-01-01'; // Default jika tidak ditemukan
            }

            // 2. Gender: Ditebak berdasarkan nama depan atau default 'Male'
            $firstName = explode(' ', $nama)[0];
            $gender = 'Male'; // Default
            foreach ($genderMap as $prefix => $mappedGender) {
                if (str_starts_with(strtoupper($firstName), strtoupper($prefix))) {
                    $gender = $mappedGender;
                    break;
                }
            }
            // Penyesuaian khusus jika nama depan tidak cukup spesifik atau ada typo
            if (str_contains(strtoupper($nama), 'LILIS') || str_contains(strtoupper($nama), 'NENENG') || str_contains(strtoupper($nama), 'HJ. ELI')) {
                $gender = 'Female';
            }
            if (str_contains(strtoupper($nama), 'CECEP') || str_contains(strtoupper($nama), 'ROLLAN') || str_contains(strtoupper($nama), 'JADI')) {
                $gender = 'Male';
            }


            // 3. Status Keluarga: 'K' menjadi 'Menikah', 'TK' menjadi 'Belum Menikah'
            $keluargaStatus = '';
            if (strtoupper($keluargaStatusRaw) === 'K') {
                $keluargaStatus = 'Menikah';
            } elseif (strtoupper($keluargaStatusRaw) === 'TK') {
                $keluargaStatus = 'Belum Menikah';
            } else {
                $keluargaStatus = 'Lainnya'; // Default jika ada nilai lain
            }

            // 4. Gaji: Menghapus titik pemisah ribuan dan mengkonversi ke integer
            $gaji = (int) str_replace('.', '', $gajiRaw);

            // 5. Tanggal Lahir: Menangani format DD-MM-YYYY atau DD/MM/YYYY. Jika kosong/invalid, gunakan default.
            $tanggalLahir = '1900-01-01'; // Default date if parsing fails or raw data is empty
            if (!empty($tanggalLahirRaw)) {
                try {
                    $tanggalLahir = Carbon::createFromFormat('d-m-Y', $tanggalLahirRaw)->format('Y-m-d');
                } catch (\Exception $e) {
                    try {
                        $tanggalLahir = Carbon::createFromFormat('d/m/Y', $tanggalLahirRaw)->format('Y-m-d');
                    } catch (\Exception $e) {
                        // Jika kedua format gagal, tanggal default '1900-01-01' sudah diset di awal
                        error_log("Format tanggal lahir tidak valid untuk '" . $tanggalLahirRaw . "'. Menggunakan default '1900-01-01'.");
                    }
                }
            }

            // 7. Masa Kerja: Dihitung dari tanggal_masuk hingga tanggal saat ini
            $masaKerja = 0;
            if ($tanggalMasuk) {
                $masaKerja = Carbon::parse($tanggalMasuk)->diffInYears(Carbon::now());
            }

            // 8. Pendidikan: Default string kosong (tidak ada di data mentah)
            $pendidikan = '';

            // 9. Status: Default 'Aktif' (tidak ada di data mentah)
            $status = 'Aktif';

            // Buat record Pegawai, pastikan semua kolom yang relevan di-uppercase
            Pegawai::create([
                'nama' => $nama,
                'nomor_induk' => $nomorInduk,
                'tanggal_lahir' => $tanggalLahir,
                'gender' => $gender,
                'jabatan' => $this->transformCasing($jabatanRaw, 'jabatan'),
                'bagian' => $this->transformCasing($bagianRaw, 'bagian'),
                'unit_kerja' => $this->transformCasing($unitKerjaRaw, 'unit_kerja'),
                'pendidikan' => $pendidikan,
                'klasifikasi' => $this->transformCasing($klasifikasiRaw, 'klasifikasi'),
                'keluarga_status' => $keluargaStatus,
                'keluarga_anak' => $keluargaAnak,
                'tanggal_masuk' => $tanggalMasuk,
                'masa_kerja' => (int)$masaKerja,
                'golongan' => strtoupper($golonganRaw), // Golongan tetap uppercase
                'gaji' => $gaji,
                'status' => $status,
            ]);
        }
    }

    /**
     * Helper function to transform casing based on PegawaiController's fixed options.
     *
     * @param string $value The raw value from the seeder data.
     * @param string $type The type of field (e.g., 'jabatan', 'bagian').
     * @return string The transformed value with matching casing.
     */
    private function transformCasing($value, $type)
    {
        $value = trim($value);
        $valueUpper = strtoupper($value);

        // Define the exact casings as they appear in PegawaiController's options
        // This mapping ensures the seeder outputs data with the exact casing expected by the controller.
        $controllerOptionsMapping = [
            'klasifikasi' => [
                'ADM/KEUANGAN' => 'ADM/Keuangan',
                'HUBLANG' => 'Hublang',
                'PENGOLAHAN' => 'Pengolahan',
                'SPI' => 'SPI',
                'SUMBER' => 'Sumber',
                'TRANDIST' => 'Trandist',
            ],
            'unit_kerja' => [
                'DIREKSI' => 'Direksi',
                'DEWAS' => 'Dewas',
                'CIGASONG' => 'Cigasong',
                'JATITUJUH' => 'Jatitujuh',
                'KADIPATEN' => 'Kadipaten',
                'MAJALENGKA' => 'Majalengka',
                'PANYINGKIRAN' => 'Panyingkiran',
                'PUSAT' => 'Pusat',
                'RAJAGALUH' => 'Rajagaluh',
                'SUKAHAJI' => 'Sukahaji',
                'SUKARAJA' => 'Sukaraja',
                'TALAGA' => 'Talaga',
                'USAHA TERMINAL AIR' => 'Usaha Terminal Air',
            ],
            'jabatan' => [
                'DIREKTUR' => 'Direktur',
                'DEWAN PENGAWAS' => 'Dewan Pengawas',
                'BENDAHARA' => 'Bendahara',
                'FUNGSIONAL SPI' => 'Fungsional SPI',
                'KA SPI' => 'Ka SPI',
                'KABAG' => 'Kabag',
                'KACAB' => 'Kacab',
                'KASUBAG' => 'Kasubag',
                'KAUNIT' => 'Kaunit',
                'KAUR' => 'Kaur',
                'STAF' => 'Staf',
                'KONTRAK' => 'Kontrak',
            ],
            'bagian' => [
                'DIRUT' => 'Dirut',
                'DEWAS' => 'Dewas',
                'ADMIN & KEUANGAN' => 'Admin & Keuangan',
                'ADM UMUM & SARANA' => 'ADM Umum & Sarana',
                'BACA METER' => 'Baca Meter',
                'DISTRIBUSI' => 'Distribusi',
                'DISTRIBUSI & PENYAMBUNGAN' => 'Distribusi & Penyambungan',
                'FUNGSIONAL SPI ADM & KEUANGAN' => 'Fungsional SPI ADM & Keuangan',
                'FUNGSIONAL SPI TEKNIK' => 'Fungsional SPI Teknik',
                'GUDANG' => 'Gudang',
                'HUBLANG' => 'Hublang',
                'KA SPI' => 'Ka SPI',
                'KACAB' => 'Kacab',
                'KASIR' => 'Kasir',
                'KAUNIT' => 'Kaunit',
                'KEU' => 'Keu',
                'LAHTA' => 'Lahta',
                'MSDM' => 'MSDM',
                'OPERATOR' => 'Operator',
                'PEMASARAN & INFORMASI' => 'Pemasaran & Informasi',
                'PEMBUKUAN' => 'Pembukuan',
                'PEMELIHARAAN' => 'Pemeliharaan',
                'PENGADUAN & TAGIHAN' => 'Pengaduan & Tagihan',
                'PENGOLAHAN DATA' => 'Pengolahan Data',
                'PERENCANAAN' => 'Perencanaan',
                'PRODUKSI' => 'Produksi',
                'RUTIN TEKNIK' => 'Rutin Teknik',
                'KOORDINATOR SATPAM PUSAT' => 'Koordinator Satpam Pusat',
                'SATPAM' => 'Satpam',
                'STAF BACA METER' => 'Staf Baca Meter',
                'STAF DISTRIBUSI & PENYAMBUNGAN' => 'Staf Distribusi & Penyambungan',
                'STAF KASIR' => 'Staf Kasir',
                'STAF PEMBUKUAN & KEU' => 'Staf Pembukuan & Keu',
                'STAF PRODUKSI PUSAT' => 'Staf Produksi Pusat',
                'STAF PRODUKSI (OPERATOR)' => 'Staf Produksi (Operator)',
                'STAF IKK DAWUAN' => 'Staf IKK Dawuan',
                'STAF PRODUKSI' => 'Staf Produksi',
                'STAF UMUM' => 'Staf Umum',
            ],
        ];

        // Find a match ignoring case, and return the matched option's casing
        if (isset($controllerOptionsMapping[$type])) {
            foreach ($controllerOptionsMapping[$type] as $upperKey => $exactCasing) {
                if ($upperKey === $valueUpper) {
                    return $exactCasing; // Return the option with its original casing from the controller's list
                }
            }
        }

        // Fallback: If not found in the explicit list, try ucwords(strtolower())
        // This handles cases where raw data might have variations not in the fixed list
        return ucwords(strtolower($value));
    }
}