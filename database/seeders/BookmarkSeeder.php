<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get test user
        $testUser = User::where('email', 'test@test.com')->firstOrFail();

        // get all job ids
        $jobIds = Job::pluck('id')->toArray();

        //Randomly select jobs to bookmark
        $randomJobIds = array_rand($jobIds, 3);

        // Attach the selected jobs as bookmaks for the test user
        foreach($randomJobIds as $jobId) {
           $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        }
        echo 'Jobs bookmarked Successfully';
    }
}
