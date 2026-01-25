<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

// php artisan make:controller JobController --resource
class JobController extends Controller
{

    /**
     * @desc Display a listing of jobs.
     * @route GET /jobs
     * @method GET
     * @return View
     */
    public function index(): View
    {
       $jobs = Job::all();
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * @desc Display a create job form.
     * @route GET /jobs/create
     * @method GET
     * @return View
     */
    public function create(): View
    {
        return view('jobs.create');
    }

    /**
     * @desc Save job to database.
     * @route POST /jobs
     * @method POST
     * @return RedirectResponse
     * @param Request $request
     */
    public function store(Request $request): RedirectResponse
    {
//        $title = $request->input('title');
//        $description = $request->input('description');
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'required|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        $validateData['user_id'] = 1;

        if($request->hasFile('company_logo')){
            $path = $request->file('company_logo')->store('logos', 'public');
            $validateData['company_logo'] = $path;
        }

        Job::create($validateData);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    /**
     * @desc Display a single job.
     * @route GET /job/{$id}
     * @method GET
     * @param Job $job
     * @return View
     */
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }

    /**
     * @desc Show edit form for a single job.
     * @route GET /job/{$id}/edit
     * @method GET
     * @param Job $job
     * @return View
     */
    public function edit(Job $job): View
    {
        return view('jobs.edit')->with('job', $job);
    }

    /**
     * @desc Update job information
     * @route  PUT /job/{$id}
     * @method PUT
     * @param Request $request
     * @param Job $job
     * @return string
     */
    public function update(Request $request, Job $job): string
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'required|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        if($request->hasFile('company_logo')){
            Storage::delete('public/logos/'. basename($job->company_logo));
            $path = $request->file('company_logo')->store('logos', 'public');
            $validateData['company_logo'] = $path;
        }

        $job->update($validateData);
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    /**
     * @desc Delete a job
     * @route DELETE /job/{$id}
     * @method DELETE
     * @param Job $job
     * @return RedirectResponse
     */
    public function destroy(Job $job): RedirectResponse
    {
        if($job->company_logo){
            Storage::delete('public/logos/', $job->company_logo);
        }
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
