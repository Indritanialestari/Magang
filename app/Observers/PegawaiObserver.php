<?php

namespace App\Observers;

use App\Models\Pegawai;
use App\Models\PegawaiHistory;
use Illuminate\Support\Facades\Log;

class PegawaiObserver
{
    public function created(Pegawai $pegawai): void
    {
        $this->logHistory($pegawai, 'dibuat');
    }

    public function updated(Pegawai $pegawai): void
    {
        $this->logHistory($pegawai, 'diperbarui');
    }

    protected function logHistory(Pegawai $pegawai, string $event): void
    {
        $perubahan = $this->formatChanges($pegawai);
        
        if ($event === 'diperbarui' && empty($perubahan)) {
            return;
        }

        PegawaiHistory::create([
            'pegawai_id' => $pegawai->id,
            'nama' => $pegawai->nama,
            'nomor_induk' => $pegawai->nomor_induk,
            'jabatan' => $pegawai->jabatan,
            'bagian' => $pegawai->bagian,
            'unit_kerja' => $pegawai->unit_kerja,
            'klasifikasi' => $pegawai->klasifikasi,
            'tanggal_masuk' => $pegawai->tanggal_masuk,
            'tanggal_lahir' => $pegawai->tanggal_lahir,
            'event' => $event,
            'perubahan' => $event === 'diperbarui' ? $perubahan : null,
        ]);
    }

    protected function formatChanges(Pegawai $pegawai): array
    {
        $changes = [];
        foreach ($pegawai->getDirty() as $key => $newValue) {
            if (in_array($key, ['updated_at', 'remember_token'])) {
                continue;
            }
            $changes[$key] = [
                'sebelum' => $pegawai->getOriginal($key),
                'sesudah' => $newValue,
            ];
        }
        return $changes;
    }
}