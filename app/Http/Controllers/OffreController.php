<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    public function index(Request $request)
    {
        $offres = Offre::active()
            ->filtre($request->only(['search', 'city', 'type', 'salary']))
            ->latest()
            ->paginate(12);

        return response()->json($offres);
    }

    public function show(Offre $offre)
    {
        return response()->json($offre);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'logo'        => 'nullable|string|max:5',
            'color'       => 'nullable|string|max:10',
            'city'        => 'required|string',
            'salary'      => 'required|integer|min:0',
            'type'        => 'required|in:CDI,CDD,Freelance,Stage',
            'description' => 'required|string',
            'tags'        => 'required|array',
        ]);

        return response()->json(Offre::create($data), 201);
    }

    public function update(Request $request, Offre $offre)
    {
        $data = $request->validate([
            'title'       => 'sometimes|string',
            'company'     => 'sometimes|string',
            'city'        => 'sometimes|string',
            'salary'      => 'sometimes|integer',
            'type'        => 'sometimes|in:CDI,CDD,Freelance,Stage',
            'description' => 'sometimes|string',
            'tags'        => 'sometimes|array',
            'is_active'   => 'sometimes|boolean',
        ]);

        $offre->update($data);
        return response()->json($offre);
    }

    public function destroy(Offre $offre)
    {
        $offre->delete();
        return response()->json(['message' => 'Offre supprimée']);
    }
}
