<?php

namespace App\Http\Controllers;

use App\Models\Univers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $univers = Univers::findOrFail($request->univers_id);
        $user = Auth::user();

        if ($user->favorites()->where('univers_id', $univers->id)->exists()) {
            $user->favorites()->detach($univers->id);
            $status = 'removed';
        } else {
            $user->favorites()->attach($univers->id);
            $status = 'added';
        }

        return response()->json(['status' => $status]);
    }
}
