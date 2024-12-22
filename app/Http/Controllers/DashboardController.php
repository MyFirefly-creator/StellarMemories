<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $fotoss = $query
            ? Foto::where('JudulFoto', 'like', '%' . $query . '%')
                ->orWhere('DeskripsiFoto', 'like', '%' . $query . '%')
                ->orderBy('created_at', 'desc')
                ->get()
            : Foto::all();

        return view('dashboard.index', compact('fotoss', 'query'));
    }
}
