<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Ban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserBan
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->banned) {
            if (Carbon::now('Asia/Jakarta')->lessThan($user->banned->BannedUntil)) {
                return redirect()->route('banned.index');
            } else {
                $user->banned->delete();
            }
        }

        return $next($request);
    }
}
