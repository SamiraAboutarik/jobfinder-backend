<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{
    public function index(Request $request)
    {
        $saved = $request->user()->savedJobs()->latest('saved_jobs.created_at')->get();

        return response()->json($saved);
    }

    public function toggle(Request $request, Job $job)
    {
        $user = $request->user();

        if ($user->savedJobs()->where('job_id', $job->id)->exists()) {
            $user->savedJobs()->detach($job->id);
            return response()->json(['saved' => false, 'message' => 'Offre retirée des favoris']);
        }

        $user->savedJobs()->attach($job->id);
        return response()->json(['saved' => true, 'message' => 'Offre sauvegardée !']);
    }
}
