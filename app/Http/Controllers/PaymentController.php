<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\WilApplication;
use Illuminate\Http\Request;

class PaymentController extends Controller
{


   public function pay($applicationId)
{
    $application = WilApplication::findOrFail($applicationId);

    // Check if already paid
    $existingPayment = Payment::where('application_id', $application->id)
        ->where('status', 'Paid')
        ->first();

    if ($existingPayment) {
        return back()->with('error', 'This application has already been paid.');
    }

    // Create pending payment record
    $payment = Payment::create([
        'application_id' => $application->id,
        'method' => 'payfast',
        'status' => 'pending',
        'amount' => 900.00,
    ]);

    // Prepare PayFast data
    $data = [
        'merchant_id' => env('PAYFAST_MERCHANT_ID'),
        'merchant_key' => env('PAYFAST_MERCHANT_KEY'),

        'return_url' => route('payment.success'),
        'cancel_url' => route('payment.cancel'),
        'notify_url' => route('payment.notify'),

        'm_payment_id' => $payment->id,

        'name_first' => auth()->user()->full_name,
        'email_address' => auth()->user()->email,

        'amount' => number_format($payment->amount, 2, '.', ''),
        'item_name' => 'WIL Application Fee',
    ];

    $url = 'https://sandbox.payfast.co.za/eng/process';

    return redirect($url . '?' . http_build_query($data));
}

    public function success()
    {
    return redirect()
        ->route('dashboard')
        ->with('success', 'Payment completed successfully.');
    }

    public function cancel()
    {
    return redirect()
        ->route('dashboard')
        ->with('error', 'Payment was cancelled.');
    }

    public function notify(Request $request)
    {
    $applicationId = $request->m_payment_id;

    $application = WilApplication::find($applicationId);

    if (!$application) {
        return response('Application not found', 404);
    }

    Payment::create([
        'application_id' => $application->id,
        'amount' => $request->amount_gross,
        'method' => 'PayFast',
        'status' => 'Paid',
        'transaction_id' => $request->pf_payment_id,
        'gateway_reference' => $request->payment_status,
        'paid_at' => now(),
    ]);

    $application->update([
        'status' => 'Under Review',
    ]);

    return response('OK', 200);
    }


}
