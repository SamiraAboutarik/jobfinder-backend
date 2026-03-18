<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function apply(Request $request, Job $job)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email',
            'phone'        => 'nullable|string',
            'cover_letter' => 'nullable|string',
        ]);

        $already = Application::where('user_id', $request->user()->id)
            ->where('job_id', $job->id)
            ->exists();

        if ($already) {
            return response()->json(['message' => 'Vous avez déjà postulé à cette offre.'], 409);
        }

        $application = Application::create([
            ...$validated,
            'user_id' => $request->user()->id,
            'job_id'  => $job->id,
        ]);

        return response()->json([
            'message'     => 'Candidature envoyée avec succès !',
            'application' => $application,
        ], 201);
    }

    public function myApplications(Request $request)
    {
        $applications = $request->user()
            ->applications()
            ->with('job')
            ->latest()
            ->get();

        return response()->json($applications);
    }

    public function jobApplications(Job $job)
    {
        $applications = $job->applications()->with('user')->latest()->get();

        return response()->json($applications);
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
        ]);

        $application->update(['status' => $request->status]);

        return response()->json($application);
    }
}
