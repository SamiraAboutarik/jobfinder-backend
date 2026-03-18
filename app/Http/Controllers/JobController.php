<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::active()
            ->filter($request->only(['search', 'city', 'type', 'salary']))
            ->latest()
            ->paginate(12);

        return response()->json($jobs);
    }

    public function show(Job $job)
    {
        return response()->json($job);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'logo'        => 'nullable|string|max:5',
            'color'       => 'nullable|string|max:10',
            'city'        => 'required|string',
            'salary'      => 'required|integer|min:0',
            'type'        => 'required|in:CDI,CDD,Freelance,Stage',
            'description' => 'required|string',
            'tags'        => 'required|array|min:1',
            'tags.*'      => 'string',
        ]);

        $job = Job::create($validated);

        return response()->json($job, 201);
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'company'     => 'sometimes|string|max:255',
            'city'        => 'sometimes|string',
            'salary'      => 'sometimes|integer|min:0',
            'type'        => 'sometimes|in:CDI,CDD,Freelance,Stage',
            'description' => 'sometimes|string',
            'tags'        => 'sometimes|array',
            'is_active'   => 'sometimes|boolean',
        ]);

        $job->update($validated);

        return response()->json($job);
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return response()->json(['message' => 'Offre supprimée']);
    }
}
