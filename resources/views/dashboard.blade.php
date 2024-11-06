<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Admin Dashboard --}}
            @can('manage categories')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 mt-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">Total Companies</h3>
                                <p class="text-3xl font-bold">{{ $companiesCount }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">Job Categories</h3>
                                <p class="text-3xl font-bold">{{ $categoriesCount }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">Active Jobs</h3>
                                <p class="text-3xl font-bold">{{ $jobsCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Categories List --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Job Categories Overview</h3>
                            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add Category</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Name</th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Total Jobs</th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
    <tr>
        <td class="px-6 py-4">{{ $category->name }}</td>
        <td class="px-6 py-4">{{ $category->jobs->count() }}</td>
        <td class="px-6 py-4">
            <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900">
                    Delete
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="px-6 py-4 text-center text-xl">Tidak ada data</td>
    </tr>
@endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan

            {{-- Employer Dashboard --}}
            @can('manage company')
                @if(isset($companies))
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900">
                                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold">Posted Jobs</h3>
                                    <p class="text-3xl font-bold">{{ $companies->jobs->count() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold">Total Applicants</h3>
                                    <p class="text-3xl font-bold">{{ $companies->jobs->sum(function($job) { return $job->job_candidates->count(); }) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold">Hired Candidates</h3>
                                    <p class="text-3xl font-bold">{{ $companies->jobs->sum(function($job) { return $job->job_candidates->where('is_hired', true)->count(); }) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Job Applications --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Recent Applications</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Applicant</th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Job Position</th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Applied Date</th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Status</th>
                                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($companies->jobs as $job)
                                            @foreach($job->job_candidates->sortByDesc('created_at')->take(5) as $candidate)
                                                <tr>
                                                    <td class="px-6 py-4">{{ $candidate->profile->name }}</td>
                                                    <td class="px-6 py-4">{{ $job->name }}</td>
                                                    <td class="px-6 py-4">{{ $candidate->created_at->format('M d, Y') }}</td>
                                                    <td class="px-6 py-4">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                            @if($candidate->is_hired) bg-green-100 text-green-800
                                                            @else bg-yellow-100 text-yellow-800 @endif">
                                                            {{ $candidate->is_hired ? 'Hired' : 'Pending' }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <a href="{{ route('admin.job_candidate.show', $candidate) }}" class="text-blue-600 hover:text-blue-900">View Details</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                    {{-- Active Job Listings --}}
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Active Job Listings</h3>
            <a href="{{ route('admin.company_jobs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Post New Job</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Position</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Category</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Type</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Location</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Applicants</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Status</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @if($companies && $companies->jobs->isNotEmpty())
    @forelse($companies->jobs as $job)
        <tr>
            <td class="px-6 py-4">{{ $job->name }}</td>
            <td class="px-6 py-4">{{ $job->category ? $job->category->name : 'No Category' }}</td>

            <td class="px-6 py-4">{{ $job->type }}</td>
            <td class="px-6 py-4">{{ $job->location }}</td>
            <td class="px-6 py-4">
                {{ $job->job_candidates->count() }} applicant(s)
            </td>
            <td class="px-6 py-4">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                    @if($job->is_open) bg-green-100 text-green-800 
                    @else bg-red-100 text-red-800 @endif">
                    {{ $job->is_open ? 'Open' : 'Closed' }}
                </span>
            </td>
            <td class="px-6 py-4 space-x-2">
                <a href="{{ route('admin.company_jobs.show', $job) }}" 
                   class="text-blue-600 hover:text-blue-900">View</a>
                <a href="{{ route('admin.company_jobs.edit', $job) }}"
                   class="text-yellow-600 hover:text-yellow-900">Edit</a>
                {{-- <button onclick="deleteJob({{ $job->id }})"
                        class="text-red-600 hover:text-red-900">Delete</button> --}}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="px-6 py-4 text-center text-xl">Tidak ada data</td>
        </tr>
    @endforelse
@else
    <tr>
        <td colspan="7" class="px-6 py-4 text-center text-xl">Tidak ada data</td>
    </tr>
@endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@endcan
{{-- Job Seeker Dashboard --}}
@can('apply job')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 mt-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Applications</h3>
                    <p class="text-3xl font-bold">{{ $applicationsCount }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Successful Applications</h3>
                    <p class="text-3xl font-bold">{{ $my_applications->where('is_hired', true)->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Pending Applications</h3>
                    <p class="text-3xl font-bold">{{ $my_applications->where('is_hired', false)->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Applications --}}
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">My Recent Applications</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Company</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Position</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Applied Date</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Status</th>
                            <th class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($my_applications as $application)
                            <tr>
                                <td class="px-6 py-4">{{ $application->job->company->name }}</td>
                                <td class="px-6 py-4">{{ $application->job->name }}</td>
                                <td class="px-6 py-4">{{ $application->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($application->is_hired) bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ $application->is_hired ? 'Hired' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('dashboard.my.applications.details', $application) }}"
                                       class="text-blue-600 hover:text-blue-900">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $my_applications->links() }}
            </div>
            </div>
            </div>
            @endcan
            </x-app-layout>
