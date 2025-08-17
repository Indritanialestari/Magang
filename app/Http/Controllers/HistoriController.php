<?php

namespace App\Http\Controllers;

use App\Models\PegawaiHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistoriController extends Controller
{
    public function index(Request $request)
    {
        $query = PegawaiHistory::query()->latest(); // Urutkan dari yang terbaru

        // Fitur Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nomor_induk', 'like', "%{$search}%");
            });
        }

        $histories = $query->paginate(15)->withQueryString();

        // Menambahkan data Umur dan Tanggal Pensiun
        $histories->getCollection()->transform(function ($history) {
            if ($history->tanggal_lahir) {
                $tglLahir = Carbon::parse($history->tanggal_lahir);
                $history->umur = $tglLahir->age;
                // Asumsi usia pensiun 58 tahun
                $history->tanggal_pensiun = $tglLahir->copy()->addYears(58)->format('d M Y');
            } else {
                $history->umur = '-';
                $history->tanggal_pensiun = '-';
            }
            return $history;
        });

        return view('histori', [
            'histories' => $histories
        ]);
    }
}