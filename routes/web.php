<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    
    $jobs = Job::with('employer')->latest()->cursorPaginate(4);
    return view('jobs.index', [
        'jobs' => $jobs,
    ]);
});

Route::get('jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
}); 

Route::get('/contact', function () {
    return view('contact');
}); 

Route::post('/jobs', function (Request $request) {
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
});

Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', [
        'job' => $job,
    ]);
});

Route::patch('/jobs/{id}', function (Request $request, $id) {
    $request->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    $job = Job::findOrFail($id);

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

});


Route::delete('/jobs/{id}', function ($id) {
    
    Job::findOrFail($id)->delete();


    return redirect('/jobs');
});