<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    public function postuler(Request $request, Offre $offre)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'nullable|string',
            'cover_letter' => 'nullable|string',
        ]);

        $existe = Candidature::where('user_id', $request->user()->id)
            ->where('offre_id', $offre->id)
            ->exists();

        if ($existe) {
            return response()->json(['message' => 'Vous avez déjà postulé.'], 409);
        }

        $candidature = Candidature::create([
            ...$data,
            'user_id'  => $request->user()->id,
            'offre_id' => $offre->id,
        ]);

        return response()->json(['message' => 'Candidature envoyée !', 'candidature' => $candidature], 201);
    }

    public function mesCandidatures(Request $request)
    {
        $list = $request->user()
            ->candidatures()
            ->with('offre')
            ->latest()
            ->get();

        return response()->json($list);
    }

    public function changerStatut(Request $request, Candidature $candidature)
    {
        $request->validate(['status' => 'required|in:pending,reviewed,accepted,rejected']);
        $candidature->update(['status' => $request->status]);
        return response()->json($candidature);
    }
}
