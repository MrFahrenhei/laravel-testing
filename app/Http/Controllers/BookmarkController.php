<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    /**
     * @desc Get all users bookmakrs
     * @route GET /bookmarks
     * @method GET
     * @return View
     */
    public function index(): View
    {
        $user = Auth::user();
        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }

    /**
     * @desc Create a new bookmaked job
     * @route POST /bookmarks/{job}
     * @method POST
     * @param Job $job
     * @return RedirectResponse
     */
    public function store(Job $job): RedirectResponse
    {
        $user = Auth::user();
        if($user->bookmarkedJobs()->where('job_id', $job->id)->exists()){
           return back()->with('status', 'You have already bookmarked this job');
        }
        $user->bookmarkedJobs()->attach($job->id);
        return back()->with('status', 'Bookmarked successfully');
    }
}
