<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatStatusKepegawaian;
use App\Models\RiwayatDiklat;
use App\Models\KaryawanKontrak;
use DateTime;
use App\Models\RiwayatKenaikan;
use Illuminate\Support\Facades\Storage; // <-- JANGAN LUPA TAMBAHKAN INI di bagian atas file controller

use Illuminate\Support\Collection;

class KaryawanTetapController extends Controller
{
    private $golonganOptions = ['A1', 'A2', 'A3', 'A4', 'B1', 'B2', 'B3', 'B4', 'C1', 'C2', 'C3', 'C4', 'D1', 'D2', 'D3', 'D4'];
    private $klasifikasiOptions = ['ADM/Keuangan', 'Hublang', 'Pengolahan', 'SPI', 'Sumber', 'Trandist'];
    private $unitKerjaOptions = ['Direksi', 'Dewas', 'Cigasong', 'Jatitujuh', 'Kadipaten', 'Majalengka', 'Panyingkiran', 'Pusat', 'Rajagaluh', 'Sukahaji', 'Sukaraja', 'Talaga', 'Usaha Terminal Air'];
    private $jabatanOptions = ['Direktur', 'Dewan Pengawas', 'Bendahara', 'Fungsional SPI', 'Ka SPI', 'Kabag', 'Kacab', 'Kasubag', 'Kaunit', 'Kaur', 'Staf', 'Kontrak'];
    private $bagianOptions = ['Dirut', 'Dewas', 'Admin & Keuangan', 'ADM Umum & Sarana', 'Baca Meter', 'Distribusi', 'Distribusi & Penyambungan', 'Fungsional SPI ADM & Keuangan', 'Fungsional SPI Teknik', 'Teknik', 'Rutin', 'Gudang', 'Hublang', 'Ka SPI', 'Kacab', 'Kasir', 'Kaunit', 'Keuangan', 'Lahta', 'MSDM', 'Operator', 'Pemasaran & Informasi', 'Pembukuan', 'Pemeliharaan', 'Pengaduan & Tagihan', 'Pengolahan Data', 'Perencanaan', 'Produksi', 'Rutin Teknik', 'Koordinator Satpam Pusat', 'Satpam', 'Staf Baca Meter', 'Pembaca Meter', 'Staf Distribusi & Penyambungan', 'Staf Kasir', 'Staf Pembukuan & Keu', 'Staf Produksi Pusat', 'Staf Produksi (Operator)', 'Staf Operator', 'Staf Adm', 'Staf IKK Dawuan', 'Staf Produksi', 'Staf Umum', 'Staf Pelaksana', 'Office Boy'];
    private $statusKenaikanOptions = ['Diproses', 'Ditunda', 'Dibatalkan', 'Disetujui'];
    private $jenisHukumanOptions = ['Surat Peringatan 1', 'Surat Peringatan 2', 'Surat Peringatan 3', 'Penangguhan KGB', 'Penurunan Pangkat', 'Penurunan Golongan', 'Skorsing', 'Pemotongan Gaji'];
    private $salaryMapping = [
        'A1' => [ 0 => 1256831, 2 => 1296353, 3 => 1372530, 4 => 1337220, 5 => 1415727, 6 => 1379341, 7 => 1460358, 8 => 1422807, 9 => 1506333, 10 => 1467617, 11 => 1553742, 12 => 1513861, 13 => 1602674, 14 => 1561539, 15 => 1653220, 16 => 1610651, 17 => 1705200, 18 => 1661376, 19 => 1758972, 20 => 1713714, 21 => 1814357, 22 => 1767665, 23 => 1871534, 24 => 1823409, 25 => 1930415, 26 => 1880765, 27 => null],
        'A2' => [ 3 => 1430604, 5 => 1475593, 7 => 1522106, 9 => 1570053, 11 => 1619523, 13 => 1670517, 15 => 1723124, 17 => 1777344, 19 => 1833356, 21 => 1891072, 23 => 1950669, 25 => 2012059, 27 => null],
        'A3' => [ 3 => 1491098, 5 => 1538058, 7 => 1586453, 9 => 1636461, 11 => 1687993, 13 => 1741137, 15 => 1795985, 17 => 1852535, 19 => 1910878, 21 => 1971102, 23 => 2033209, 25 => 2097198, 27 => null],
        'A4' => [ 3 => 1539100, 5 => 1590000, 7 => 1642500, 9 => 1696600, 11 => 1752300, 13 => 1809700, 15 => 1868800, 17 => 1929600, 19 => 1992200, 21 => 2056500, 23 => 2122600, 25 => 2190500, 27 => null],
        'B1' => [ 0 => 1628306, 1 => 1654027, 3 => 1706096, 5 => 1759778, 7 => 1815253, 9 => 1872431, 11 => 1931401, 13 => 1992253, 15 => 2054987, 17 => 2119692, 19 => 2186459, 21 => 2255287, 23 => 2326356, 25 => 2399576, 27 => 2475215, 29 => 2553095, 31 => 2633573, 33 => 2716472],
        'B2' => [ 3 => 1778240, 5 => 1834253, 7 => 1892057, 9 => 1951655, 11 => 2013044, 13 => 2076495, 15 => 2141918, 17 => 2209312, 19 => 2278947, 21 => 2350733, 23 => 2424759, 25 => 2501115, 27 => 2579891, 29 => 2661087, 31 => 2744971, 33 => 2831365],
        'B3' => [ 3 => 1853431, 5 => 1911863, 7 => 1972088, 9 => 2034195, 11 => 2098273, 13 => 2164323, 15 => 2232524, 17 => 2302786, 19 => 2375288, 21 => 2450121, 23 => 2527284, 25 => 2606867, 27 => 2688958, 29 => 2773649, 31 => 2861029, 33 => 2951187],
        'B4' => [ 0 => 1931849, 5 => 1992701, 7 => 2055435, 9 => 2120230, 11 => 2186997, 13 => 2255915, 15 => 2326894, 17 => 2400203, 19 => 2475842, 21 => 2553812, 23 => 2634201, 25 => 2717189, 27 => 2802776, 29 => 2891052, 31 => 2982106, 33 => 3076027],
        'C1' => [ 0 => 2077033, 2 => 2142456, 4 => 2209940, 6 => 2279485, 8 => 2351270, 10 => 2425386, 12 => 2501742, 14 => 2580518, 16 => 2661804, 18 => 2745598, 20 => 2832082, 22 => 2921343, 24 => 3013293, 26 => 3108201, 28 => 3206066, 30 => 3307068, 32 => 3411206],
        'C2' => [ 0 => 2164861, 2 => 2233062, 4 => 2303413, 6 => 2375916, 8 => 2450749, 10 => 2527911, 12 => 2607584, 14 => 2689675, 16 => 2774366, 18 => 2861746, 20 => 2951904, 22 => 3044840, 24 => 3140733, 26 => 3239673, 28 => 3341751, 30 => 3446964, 32 => 3555494],
        'C3' => [ 0 => 2256452, 2 => 2327521, 4 => 2400830, 6 => 2476469, 8 => 2554439, 10 => 2634914, 12 => 2717974, 14 => 2803779, 16 => 2892406, 18 => 2983931, 20 => 3078446, 22 => 3176032, 24 => 3276776, 26 => 3380767, 28 => 3488093, 30 => 3598839, 32 => 3713092],
        'C4' => [ 0 => 2351898, 2 => 2425924, 4 => 2502370, 6 => 2581146, 8 => 2662431, 10 => 2746315, 12 => 2832799, 14 => 2922060, 16 => 3014100, 18 => 3109007, 20 => 3206962, 22 => 3307964, 24 => 3412102, 26 => 3519557, 28 => 3630417, 30 => 3744772, 32 => 3862712],
        'D1' => [ 0 => 2451376, 2 => 2528539, 4 => 2608211, 6 => 2690392, 8 => 2775083, 10 => 2862463, 12 => 2952621, 14 => 3045646, 16 => 3141539, 18 => 3240480, 20 => 3342557, 22 => 3447861, 24 => 3556390, 26 => 3668415, 28 => 3784025, 30 => 3903130, 32 => 4026089],
        'D2' => [ 0 => 2555066, 2 => 2635545, 4 => 2718533, 6 => 2804120, 8 => 2892486, 10 => 2983539, 12 => 3077551, 14 => 3174520, 16 => 3274446, 18 => 3377599, 20 => 3483978, 22 => 3593672, 24 => 3706862, 26 => 3823637, 28 => 3944087, 30 => 4068300, 32 => 4196367],
        'D3' => [ 0 => 2663148, 2 => 2747032, 4 => 2833516, 6 => 2922777, 8 => 3014817, 10 => 3109814, 12 => 3207769, 14 => 3308770, 16 => 3412998, 18 => 3520453, 20 => 3631313, 22 => 3745668, 24 => 3863697, 26 => 3985401, 28 => 4110869, 30 => 4240370, 32 => 4373904],
        'D4' => [ 0 => 2775800, 2 => 2863180, 4 => 2953427, 6 => 3046453, 8 => 3142346, 10 => 3241287, 12 => 3343453, 14 => 3448757, 16 => 3557376, 18 => 3669401, 20 => 3784921, 22 => 3904116, 24 => 4027075, 26 => 4153977, 28 => 4284732, 30 => 4419700, 32 => 4558880]
    ];
    
    public function index(Request $request)
    {
        $filteredQuery = $this->getFilteredPegawaiQuery($request);
        $jumlahAktif = (clone $filteredQuery)->where('status', 'Aktif')->count();
        $jumlahNonAktif = (clone $filteredQuery)->where('status', 'Tidak Aktif')->count();

        $pegawais = $filteredQuery->paginate(10)->withQueryString();

        $pegawais->getCollection()->transform(function ($pegawai) {
            $prospect = $this->calculateProspectiveSalary($pegawai->golongan, $pegawai->tanggal_masuk);
            $pegawai->kenaikan_gaji_dihitung = $prospect ? $prospect['gaji_baru'] : null;
            $pegawai->masa_kerja = $pegawai->tanggal_masuk ? Carbon::parse($pegawai->tanggal_masuk)->age : 0;
            return $pegawai;
        });
        
        return view('karyawantetap', [
            'pegawais' => $pegawais,
            'genders' => Pegawai::select('gender')->distinct()->whereNotNull('gender')->pluck('gender'),
            'statuses' => Pegawai::select('status')->distinct()->whereNotNull('status')->pluck('status'),
            'golonganOptions' => $this->golonganOptions,
            'klasifikasiOptions' => $this->klasifikasiOptions,
            'unitKerjaOptions' => $this->unitKerjaOptions,
            'jabatanOptions' => $this->jabatanOptions,
            'bagianOptions' => $this->bagianOptions,
            'statusKenaikanOptions' => $this->statusKenaikanOptions,
            'jenisHukumanOptions' => $this->jenisHukumanOptions,
            'jumlahAktif' => $jumlahAktif,
            'jumlahNonAktif' => $jumlahNonAktif,
        ]);
    }

    private function getFilteredPegawaiQuery(Request $request)
    {
        $query = Pegawai::query();

        if ($request->filled('search')) { $query->where('nama', 'like', '%' . $request->search . '%'); }
        if ($request->filled('gender')) { $query->where('gender', 'like', '%' . $request->gender . '%'); }
        if ($request->filled('status')) { $query->where('status', 'like', '%' . $request->status . '%'); }
        if ($request->filled('golongan')) { $query->where('golongan', 'like', '%' . $request->golongan . '%'); }
        if ($request->filled('klasifikasi')) { $query->where('klasifikasi', 'like', '%' . $request->klasifikasi . '%'); }
        if ($request->filled('unit_kerja')) { $query->where('unit_kerja', 'like', '%' . $request->unit_kerja . '%'); }
        if ($request->filled('jabatan')) { $query->where('jabatan', 'like', '%' . $request->jabatan . '%'); }
        if ($request->filled('bagian')) { $query->where('bagian', 'like', '%' . $request->bagian . '%'); }
        if ($request->filled('status_kenaikan')) { $query->where('status_kenaikan', 'like', '%' . $request->status_kenaikan . '%'); }
        if ($request->filled('jenis_hukuman')) { $query->where('jenis_hukuman', 'like', '%' . $request->jenis_hukuman . '%'); }

        if ($request->filled('kelipatan')) {
            $kelipatan = (int)$request->kelipatan;
            $tahun = $request->filled('tahun_kelipatan') ? (int)$request->tahun_kelipatan : Carbon::now()->year;

            if ($kelipatan > 0) {
                $dbDriver = DB::connection()->getDriverName();
                $yearFunction = ($dbDriver === 'sqlite') ? "strftime('%Y', tanggal_masuk)" : "YEAR(tanggal_masuk)";
                
                $query->whereRaw("({$tahun} - {$yearFunction}) % {$kelipatan} = 0 AND tanggal_masuk IS NOT NULL");
            }
        }

        return $query;
    }

    private function getNextGolongan($currentGolongan)
    {
        $currentIndex = array_search($currentGolongan, $this->golonganOptions);
        if ($currentIndex !== false && $currentIndex < count($this->golonganOptions) - 1) {
            return $this->golonganOptions[$currentIndex + 1];
        }
        return null;
    }

    public function create()
    {
        return view('tambah', [
            'golonganOptions' => $this->golonganOptions,
            'klasifikasiOptions' => $this->klasifikasiOptions,
            'unitKerjaOptions' => $this->unitKerjaOptions,
            'jabatanOptions' => $this->jabatanOptions,
            'bagianOptions' => $this->bagianOptions,
            'statusKenaikanOptions' => $this->statusKenaikanOptions,
            'jenisHukumanOptions' => $this->jenisHukumanOptions,
            'genders' => ['Male', 'Female'],
            'statuses' => ['Aktif', 'Tidak Aktif'],
            'keluargaStatusList' => ['Kawin', 'Belum Kawin', 'Duda', 'Janda'],
        ]);
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // <-- BARIS 1: Validasi untuk foto
        'tanggal_lahir' => 'nullable|date',
        'gender' => 'nullable|in:Male,Female',
        'nomor_induk' => 'nullable|string|max:50|unique:pegawais,nomor_induk',
        'jabatan' => 'nullable|string|max:100',
        'bagian' => 'nullable|string|max:100',
        'unit_kerja' => 'nullable|string|max:100',
        'pendidikan' => 'nullable|string|max:100',
        'klasifikasi' => 'nullable|string|max:100',
        'keluarga_status' => 'nullable|string|max:100',
        'keluarga_anak' => 'nullable|string|max:100',
        'tanggal_masuk' => 'nullable|date',
        'golongan' => 'nullable|string',
        'gaji' => 'nullable|numeric',
        'status' => 'nullable|in:Aktif,Tidak Aktif',
        'status_kenaikan' => 'nullable|in:' . implode(',', $this->statusKenaikanOptions),
        'jenis_hukuman' => 'nullable|in:' . implode(',', $this->jenisHukumanOptions),
        'alasan_hukuman' => 'nullable|string',
    ]);

    // --- BARIS 2: Logika untuk menyimpan foto ---
    if ($request->hasFile('foto')) {
        // Simpan foto ke folder: storage/app/public/photos
        $path = $request->file('foto')->store('photos', 'public');
        // Simpan path file (contoh: 'photos/namafile.jpg') ke dalam data yang akan disimpan ke database
        $validated['foto'] = $path;
    }
    // --- AKHIR DARI LOGIKA FOTO ---
    
    if ($request->filled('tanggal_masuk')) {
        $validated['masa_kerja'] = Carbon::now()->year - Carbon::parse($request->tanggal_masuk)->year;
    }

    Pegawai::create($validated);
    
    return redirect()->route('karyawan-tetap.index')->with('success', 'Data pegawai baru berhasil disimpan.');
}

public function edit($id)
{
    // 1. Mencari data pegawai (logika ini sudah bagus)
    $pegawai = Pegawai::find($id);
    $isKontrak = false;

    if ($pegawai) {
        $dataToEdit = $pegawai;
    } else {
        $karyawanKontrak = KaryawanKontrak::find($id);
        if (!$karyawanKontrak) {
            abort(404, 'Data karyawan tidak ditemukan.');
        }
        $dataToEdit = $karyawanKontrak;
        $isKontrak = true;
    }

    // 2. Mengambil data untuk dropdown (tanpa helper)
    // FIX: Sesuaikan nama tabel 'karyawan_kontrak' jika berbeda di database Anda
    $genders = Pegawai::select('gender')->distinct()->whereNotNull('gender')->pluck('gender')
        ->merge(KaryawanKontrak::select('gender')->distinct()->whereNotNull('gender')->pluck('gender'))
        ->unique()->sort()->values();

    $statuses = Pegawai::select('status')->distinct()->whereNotNull('status')->pluck('status')
        ->merge(KaryawanKontrak::select('status')->distinct()->whereNotNull('status')->pluck('status'))
        ->unique()->sort()->values();

    $keluargaStatusList = Pegawai::select('keluarga_status')->distinct()->whereNotNull('keluarga_status')->pluck('keluarga_status')
        ->merge(KaryawanKontrak::select('keluarga_status')->distinct()->whereNotNull('keluarga_status')->pluck('keluarga_status'))
        ->unique()->sort()->values();
        
    // 3. FIX: Menambahkan variabel '$kenaikan_gaji_dihitung' yang dibutuhkan oleh View
    $kenaikan_gaji_dihitung = null; // Default value agar tidak error
    if (!$isKontrak) {
        // Ganti ini dengan logika perhitungan gaji Anda yang sebenarnya jika ada
        // Contoh: menghitung kenaikan 10% dari gaji saat ini
        $kenaikan_gaji_dihitung = $dataToEdit->gaji * 1.1; 
    }

    // 4. Mengirim semua data yang dibutuhkan ke View
    return view('edit', [
        'dataToEdit' => $dataToEdit,
        'isKontrak' => $isKontrak,
        'kenaikan_gaji_dihitung' => $kenaikan_gaji_dihitung, // Variabel penting yang hilang
        'genders' => $genders,
        'statuses' => $statuses,
        'keluargaStatusList' => $keluargaStatusList,
        'golonganOptions' => $this->golonganOptions,
        'klasifikasiOptions' => $this->klasifikasiOptions,
        'unitKerjaOptions' => $this->unitKerjaOptions,
        'jabatanOptions' => $this->jabatanOptions,
        'bagianOptions' => $this->bagianOptions,
        'statusKenaikanOptions' => $this->statusKenaikanOptions,
        'jenisHukumanOptions' => $this->jenisHukumanOptions,
    ]);
}
    // PERBAIKAN: Mengirim 2 argumen

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // <-- BARIS 1: Validasi untuk foto
        'tanggal_lahir' => 'nullable|date',
        'gender' => 'nullable|in:Male,Female',
        'nomor_induk' => 'nullable|string|max:50|unique:pegawais,nomor_induk,' . $id,
        'jabatan' => 'nullable|string|max:100',
        'bagian' => 'nullable|string|max:100',
        'unit_kerja' => 'nullable|string|max:100',
        'pendidikan' => 'nullable|string|max:100',
        'klasifikasi' => 'nullable|string|max:100',
        'keluarga_status' => 'nullable|string|max:100',
        'keluarga_anak' => 'nullable|string|max:100',
        'tanggal_masuk' => 'nullable|date',
        'golongan' => 'nullable|string',
        'gaji' => 'nullable|numeric',
        'status' => 'nullable|in:Aktif,Tidak Aktif',
        'status_kenaikan' => 'nullable|in:' . implode(',', $this->statusKenaikanOptions),
        'jenis_hukuman' => 'nullable|in:' . implode(',', $this->jenisHukumanOptions),
        'alasan_hukuman' => 'nullable|string',
    ]);

    if ($request->input('jabatan') === 'Kontrak') {
        // Logika untuk pindah ke kontrak (biarkan sama)
        DB::beginTransaction();
        try {
            $pegawaiTetap = Pegawai::findOrFail($id);
            $dataUntukKontrak = array_merge($pegawaiTetap->toArray(), $validated);
            unset($dataUntukKontrak['id'], $dataUntukKontrak['created_at'], $dataUntukKontrak['updated_at']);
            KaryawanKontrak::create($dataUntukKontrak);
            $pegawaiTetap->delete();
            DB::commit();
            return redirect()->route('karyawan-kontrak.index')
                ->with('success', 'Data ' . $pegawaiTetap->nama . ' berhasil dipindahkan ke Karyawan Kontrak.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memindahkan data: ' . $e->getMessage());
        }

    } else {
        // Logika untuk update data pegawai tetap
        $pegawai = Pegawai::findOrFail($id);
        
        // --- BARIS 2: Logika untuk update foto ---
        if ($request->hasFile('foto')) {
            // 1. Hapus foto lama jika ada
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            // 2. Simpan foto baru dan dapatkan path-nya
            $path = $request->file('foto')->store('photos', 'public');
            // 3. Tambahkan path baru ke data yang akan diupdate
            $validated['foto'] = $path;
        }
        // --- AKHIR DARI LOGIKA FOTO ---

        if ($request->filled('tanggal_masuk')) {
            $validated['masa_kerja'] = Carbon::now()->year - Carbon::parse($request->tanggal_masuk)->year;
        }
        
        $pegawai->update($validated);
        $this->syncRiwayat($request->input('riwayat_jabatans', []), $pegawai, RiwayatJabatan::class);
        $this->syncRiwayat($request->input('riwayat_status_kepegawaians', []), $pegawai, RiwayatStatusKepegawaian::class);
        $this->syncRiwayat($request->input('riwayat_diklats', []), $pegawai, RiwayatDiklat::class);
        
        return redirect()->route('karyawan-tetap.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }
}

private function syncRiwayat(array $data, $pegawai, $modelClass)
{
    $modelName = (new $modelClass)->getTable();
    $relationName = \Illuminate\Support\Str::camel(\Illuminate\Support\Str::singular($modelName)) . 's';

    if (!method_exists($pegawai, $relationName)) {
        throw new \BadMethodCallException("Relasi '{$relationName}' tidak ditemukan di model Pegawai.");
    }

    $existingIds = collect($data)->pluck('id')->filter()->toArray();

    $pegawai->{$relationName}()->whereNotIn('id', $existingIds)->delete();

    foreach ($data as $record) {
        if (isset($record['id']) && $record['id'] !== null) {
            $pegawai->{$relationName}()->where('id', $record['id'])->update($record);
        } else {
            $pegawai->{$relationName}()->create($record);
        }
    }
}

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();
        return redirect()->route('karyawan-tetap.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function destroyBulk(Request $request)
    {
        $ids = json_decode($request->input('ids_to_delete'), true);
        if (!is_array($ids) || empty($ids)) {
            return back()->with('error', 'Tidak ada data yang dipilih untuk dihapus.');
        }
        Pegawai::whereIn('id', $ids)->delete();
        return redirect()->route('karyawan-tetap.index')->with('success', count($ids) . ' data pegawai berhasil dihapus.');
    }

    public function previewPdf(Request $request, $id = null)
    {
        if ($id) {
            $pegawai = Pegawai::with([
                'riwayatJabatans',
                'riwayatStatusKepegawaians',
                'riwayatDiklats'
            ])->findOrFail($id);
            $prospect = $this->calculateProspectiveSalary($pegawai);
            $pegawai->kenaikan_gaji_dihitung = $prospect ? $prospect['gaji_baru'] : null;
            $pegawais = collect([$pegawai]);
            return view('pdf_detail', compact('pegawais'));
        } else {
            $pegawais = $this->getFilteredPegawaiQuery($request)->get();
            return view('pdf', compact('pegawais'));
        }
    }

public function exportPdf(Request $request, $id = null)
{
    // Kondisi ini berjalan saat Anda download dari halaman EDIT (spesifik per ID)
    if ($id) {
        $pegawai = Pegawai::with([
            'riwayatJabatans',
            'riwayatStatusKepegawaians',
            'riwayatDiklats'
        ])->findOrFail($id);
        
        $prospect = $this->calculateProspectiveSalary($pegawai->golongan, $pegawai->tanggal_masuk);
        $pegawai->kenaikan_gaji_dihitung = $prospect ? $prospect['gaji_baru'] : null;

        $pegawais = collect([$pegawai]);
        $fileName = 'data_pegawai_' . \Illuminate\Support\Str::slug($pegawai->nama) . '.pdf';
        
        // --- PERUBAHAN DI SINI ---
        $pdf = PDF::loadView('pdf_detail', compact('pegawais'))->setPaper('a4', 'portrait');
        
        // KODE PENTING YANG HILANG SEBELUMNYA
        $pdf->setOptions(['isRemoteEnabled' => true, 'chroot' => public_path()]); 
        // --- AKHIR PERUBAHAN ---

    // Kondisi ini berjalan saat Anda download dari halaman UTAMA (semua data)
    } else {
        $pegawais = $this->getFilteredPegawaiQuery($request)->get();
        $fileName = 'data_semua_pegawai_tetap-' . date('Y-m-d') . '.pdf';
        
        $pdf = PDF::loadView('pdf', compact('pegawais'))->setPaper('a4', 'landscape');
        
        // Di bagian ini sudah benar dari sebelumnya
        $pdf->setOptions(['isRemoteEnabled' => true, 'chroot' => public_path()]); 
    }
    
    return $pdf->download($fileName);
}
    private function calculateProspectiveSalary($golongan, $tanggal_masuk)
    {
        if (!$tanggal_masuk || !$golongan) {
            return null;
        }

        $masaKerjaSaatIni = Carbon::parse($tanggal_masuk)->age;

        if (isset($this->salaryMapping[$golongan])) {
            $availableMK = array_keys($this->salaryMapping[$golongan]);
            sort($availableMK);
            foreach ($availableMK as $mk) {
                if ($mk > $masaKerjaSaatIni) {
                    return ['gaji_baru' => $this->salaryMapping[$golongan][$mk]];
                }
            }
        }

        $nextGolongan = $this->getNextGolongan($golongan);
        if ($nextGolongan && isset($this->salaryMapping[$nextGolongan])) {
            $availableMKNextGrade = array_keys($this->salaryMapping[$nextGolongan]);
            sort($availableMKNextGrade);

            foreach($availableMKNextGrade as $mk) {
                if ($mk >= $masaKerjaSaatIni) {
                    return ['gaji_baru' => $this->salaryMapping[$nextGolongan][$mk]];
                }
            }
            
            if (!empty($availableMKNextGrade)) {
                $lastMK = end($availableMKNextGrade);
                return ['gaji_baru' => $this->salaryMapping[$nextGolongan][$lastMK]];
            }
        }

        return null;
    }
    
    public function approveRaise(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $prospect = $this->calculateProspectiveSalary($pegawai->golongan, $pegawai->tanggal_masuk);
        $prospekGajiSaatIni = $prospect ? $prospect['gaji_baru'] : null;
        
        if (!$prospekGajiSaatIni) {
            return redirect()->route('karyawan-tetap.index')->with('error', 'Tidak ada kenaikan gaji untuk ' . $pegawai->nama);
        }

        RiwayatKenaikan::create([
            'pegawai_id' => $pegawai->id,
            'tanggal_kenaikan' => now(),
            'gaji_sebelumnya' => $pegawai->gaji,
            'golongan_sebelumnya' => $pegawai->golongan,
        ]);

        $pegawai->gaji = $prospekGajiSaatIni;
        $pegawai->status_kenaikan = 'Disetujui';
        
        $masaKerjaTahun = Carbon::parse($pegawai->tanggal_masuk)->age;
        if ($masaKerjaTahun > 0 && $masaKerjaTahun % 4 == 0) {
            $nextGolongan = $this->getNextGolongan($pegawai->golongan);
            if ($nextGolongan) {
                $pegawai->golongan = $nextGolongan;
            }
        }
        
        $pegawai->save();
        return redirect()->route('karyawan-tetap.index')->with('success', 'Kenaikan gaji untuk ' . $pegawai->nama . ' berhasil.');
    }

    public function revertRaise(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $riwayat = RiwayatKenaikan::where('pegawai_id', $pegawai->id)->latest()->first();

        if ($riwayat) {
            $pegawai->gaji = $riwayat->gaji_sebelumnya;
            $pegawai->golongan = $riwayat->golongan_sebelumnya;
            $pegawai->status_kenaikan = 'Diproses';
            $pegawai->save();
            $riwayat->delete();
            return redirect()->route('karyawan-tetap.index')->with('success', 'Kenaikan gaji untuk ' . $pegawai->nama . ' berhasil dibatalkan.');
        }

        return redirect()->route('karyawan-tetap.index')->with('error', 'Tidak ada riwayat kenaikan yang bisa dibatalkan.');
    }

    public function cekSemuaProspek(Request $request)
    {
        $pegawais = Pegawai::where('status', 'Aktif')->get();
        $results = [];

        foreach ($pegawais as $pegawai) {
            $prospect = $this->calculateProspectiveSalary(
                $pegawai->golongan,
                $pegawai->tanggal_masuk
            );
            $results[$pegawai->id] = $prospect ? $prospect['gaji_baru'] : null;
        }

        return response()->json($results);
    }
}
