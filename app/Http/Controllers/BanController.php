<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ban;
use Carbon\Carbon;

class BanController extends Controller
{
    public function index()
    {
        $ban = Ban::where('UserID', auth()->id())->latest()->first();
        return view('ban.index', compact('ban'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'Deskripsi' => 'required|string|max:255',
            'duration' => 'required|numeric',
            'unit' => 'required|in:minutes,hours,days',
            'UserID' => 'required|exists:users,id',
        ]);

        $banUntil = match ($request->unit) {
            'minutes' => Carbon::now('Asia/Jakarta')->addMinutes($request->duration),
            'hours' => Carbon::now('Asia/Jakarta')->addHours($request->duration),
            'days' => Carbon::now('Asia/Jakarta')->addDays($request->duration),
        };

        $ban = Ban::create([
            'Deskripsi' => $request->Deskripsi,
            'Ban_Until' => $banUntil,
            'UserID' => $request->UserID,
        ]);

        return redirect()->back()->with('success', 'User Berhasil di banned.');
    }
}
