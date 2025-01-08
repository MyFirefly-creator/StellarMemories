<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarningController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'FotoID' => 'required|exists:fotos,id',
            'jenis_pelanggaran' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $warning = Warning::create([
            'FotoID' => $request->FotoID,
            'UserID' => Auth::id(),
            'jenis_pelanggaran' => $request->jenis_pelanggaran,
            'keterangan' => $request->keterangan,
        ]);

        $user = User::find($warning->UserID);
        $user->increment('warnings_count');

        return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
    }
}
