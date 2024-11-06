<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\Category;
use App\Models\CompanyJob;
use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function index()
{
    $data = [];

    // Get data for admin dashboard
    if (auth()->user()->can('manage company')) {
        $user = Auth::user();
        $data['companies'] = Company::with(['employer'])->where('employer_id', $user->id)->first();
    }

    if (auth()->user()->can('manage categories')) {
        $data['companiesCount'] = Company::count();
        $data['categoriesCount'] = Category::count();
        $data['categories'] = Category::all();
    }

    if (auth()->user()->can('manage jobs')) {
        $data['jobsCount'] = CompanyJob::count();
    }

    // Get data for job seeker dashboard
    if (auth()->user()->can('apply job')) {
        $data['applicationsCount'] = JobCandidate::where('candidate_id', auth()->id())->count();
        $data['my_applications'] = JobCandidate::with(['job.category', 'job.company'])
            ->where('candidate_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(10);
    }

    // dd($data);
    return view('dashboard', $data);
}
    public function my_applications()
    {
        $user = Auth::user();
        $my_applications = JobCandidate::where('candidate_id', $user->id)->orderBy('id')->paginate(10);
        return view('dashboard.my_applications', compact('my_applications'));
    }

    public function my_applications_details(JobCandidate $JobCandidate)
    {
        $user = Auth::user();
        if ($JobCandidate->candidate_id != $user->id) {
            abort(403);
        }
        return view('dashboard.my_application_details', compact('JobCandidate'));
    }
}
