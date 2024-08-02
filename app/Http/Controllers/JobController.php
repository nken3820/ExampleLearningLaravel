<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate ;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::with('employer')->latest()->cursorPaginate(4);
        return view('jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function create() {
        return view('jobs.create');
    }

    public function show(Job $job) {
        return view('jobs.show', ['job' => $job]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);
    
        Job::create([
            'title' => $request->title,
            'salary' => $request->salary,
            'employer_id' => 1,
        ]);
    
        return redirect('/jobs');
    }

    public function edit(Job $job) {

        return view('jobs.edit', [
            'job' => $job,
        ]);
    }

    public function update(Request $request, Job $job) {
        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);
    
        $job->update([
            'title' => $request->title,
            'salary' => $request->salary,
        ]);
    
        return redirect('/jobs/' . $job->id );
    
        // validate
        // authorize
        // update
        // and persist
        // redirect
    }

    public function destroy(Job $job) {
        $job->delete();

        return redirect('/jobs');
    }
}
