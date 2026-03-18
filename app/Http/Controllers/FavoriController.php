<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class FavoriController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->favoris()->latest('favoris.created_at')->get()
        );
    }

    public function toggle(Request $request, Offre $offre)
    {
        $user = $request->user();

        if ($user->favoris()->where('offre_id', $offre->id)->exists()) {
            $user->favoris()->detach($offre->id);
            return response()->json(['favori' => false]);
        }

        $user->favoris()->attach($offre->id);
        return response()->json(['favori' => true]);
    }
}
