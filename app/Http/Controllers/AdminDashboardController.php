<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WilApplication;
use App\Models\User;
use App\Models\CallRequest;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ApplicationStatusUpdated;



class AdminDashboardController extends Controller
{

    public function index()
    {
        //Data
        $users = User::all();
        $applications = WilApplication::with('user','documents')->get();
        $approvedApps = WilApplication::where('status','approved')->get();
        $rejectedApps = WilApplication::where('status','rejected')->get();
        $reviewApps = WilApplication::where('status','under_review')->get();
        $callRequests = CallRequest::latest()->get();


        //Count
        $appCount = WilApplication::count();
        $totalUsers = User::count();
        $approveCount = WilApplication::where('status','approved')->count();
        $rejected = WilApplication::where('status', 'rejected')->count();
        $pendingPayment = WilApplication::where('status', 'pending_payment')->count();
        $underReview = WilApplication::where('status', 'under_review')->count();
        $totalStudents = User::where('role', 'student')->count();
        $pendingCallRequests = CallRequest::where('status', 'pending')->count();

        return view('pages.wil.admin.dashboard',
         compact(
         'users',
         'applications',
         'approvedApps',
         'rejectedApps',
         'reviewApps',
         'appCount',
         'approveCount',
         'rejected',
         'pendingPayment',
         'underReview',
         'totalUsers',
         'callRequests',
         'pendingCallRequests'
         ));
    }


        public function review($id)
    {
        $application =
        WilApplication::with([
            'user',
            'documents',
            'payment'
        ])->findOrFail($id);

    return view(
        'pages.wil.admin.document_review',
        compact('application')
    );
    }


public function edit($id)
{
    $application =
        WilApplication::with([
            'user',
            'documents',
            'payment'
        ])->findOrFail($id);

    return view(
        'pages.wil.admin.edit_application',
        compact('application')
    );
}

    public function update(Request $request, $id)
{
    $request->validate([

        'status' => 'required',

        'notes' => 'nullable|string',

    ]);

    $application =
        WilApplication::with('user')->findOrFail($id);

    $application->update([

        'status' => $request->status,

        'notes' => $request->notes,

    ]);

    // 🔔 Notify the student who owns this application
        if ($application->user) {
         $application->user->notify(new ApplicationStatusUpdated($application));
      }

    return redirect()
        ->route('admin.dashboard')
        ->with(
            'success',
            'Application updated successfully'
        );
}

    public function destroy($id)
{
    $application =
        WilApplication::with('documents')
        ->findOrFail($id);

    foreach ($application->documents as $document) {

        Storage::disk('public')
            ->delete($document->file_path);

        $document->delete();
    }

    $application->delete();

    return back()->with(
        'success',
        'Application deleted successfully'
    );
}
}
