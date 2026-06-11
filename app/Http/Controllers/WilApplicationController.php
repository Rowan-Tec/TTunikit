<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WilApplication;
use App\Models\Document;
use App\Models\User;
use App\Notifications\ApplicationSubmitted;

class WilApplicationController extends Controller
{
    // Show the application form
    public function create()
    {
        $user        = Auth::user();
        $application = $user->wilApplication;

        // If already submitted, redirect to dashboard
        if ($application && $application->status !== 'draft') {
            return redirect()->route('dashboard')
                ->with('info', 'Your application has already been submitted.');
        }

        return view('pages.wil.student.wil_application', compact('user', 'application'));
    }

    // Handle form submission
    public function store(Request $request)
    {
        $request->validate([
            'id_number'                 => ['required', 'digits:13'],
            'phone'                     => ['required', 'string'],
            'address'                   => ['nullable', 'string'],
            'institution'               => ['required', 'string'],
            'student_number'            => ['required', 'string'],
            'field_of_study'            => ['required', 'string'],
            'faculty'                   => ['nullable', 'string'],
            'year_of_study'             => ['required', 'string'],
            'cv'                        => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'academic_records'          => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'wil_recommendation_letter' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'id_copy'                   => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        $user = Auth::user();

        // Create or update the application
        $application = WilApplication::updateOrCreate(
            ['user_id' => $user->id],
            [
                'id_number'      => $request->id_number,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'institution'    => $request->institution,
                'student_number' => $request->student_number,
                'field_of_study' => $request->field_of_study,
                'faculty'        => $request->faculty,
                'year_of_study'  => $request->year_of_study,
                'status'         => 'pending_payment',
            ]
        );
        

        // Store each uploaded document
        $documents = [
            'cv'                        => 'cv',
            'academic_records'          => 'academic_record',
            'wil_recommendation_letter' => 'recommendation_letter',
            'id_copy'                   => 'id_copy',
        ];

        foreach ($documents as $inputName => $docType) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $path = $file->store('documents', 'public');

                Document::updateOrCreate(
                    [
                        'application_id' => $application->id,
                        'type'           => $docType,
                    ],
                    [
                        'file_path'     => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type'     => $file->getMimeType(),
                        'file_size'     => $file->getSize(),
                    ]
                );

            }
        }

        // Notify all admins
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
        $admin->notify(new ApplicationSubmitted($application));
        }
        return redirect()->route('payment', $application->id)
            ->with('success', 'Application submitted! Please proceed to payment.');
    }
}