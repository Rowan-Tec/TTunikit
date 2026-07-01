<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\WilApplication;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

   public function pay(Request $request, $applicationId)
    {
        $application = WilApplication::findOrFail($applicationId);

      /*  $request->validate([
        'card_number' => ['required', 'string', 'min:19'], // 16 digits + 3 spaces from mask
        'card_name'   => ['required', 'string', 'max:100'],
        'card_expiry' => ['required', 'string', 'size:5'],  // MM/YY
        'card_cvv'    => ['required', 'string', 'size:3'],
    ]); */

        $payment = Payment::firstOrCreate(
            ['application_id' => $application->id],
            [
                'status' => 'pending',
                'amount' => 900.00
            ]
        );

        $merchantId = config('services.payfast.merchant_id');
        $merchantKey = config('services.payfast.merchant_key');

        $data = [

            'merchant_id' => $merchantId,
            'merchant_key' => $merchantKey,

            'return_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
            'notify_url' => route('payment.notify'),

            'name_first' => auth()->user()->full_name,
            'email_address' => auth()->user()->email,

            'm_payment_id' => $payment->id,

            'amount' => number_format($payment->amount, 2, '.', ''),

            'item_name' => 'TT UNIK IT WIL Application Fee',
        ];

        $url = config('services.payfast.sandbox')
            ? 'https://sandbox.payfast.co.za/eng/process'
            : 'https://www.payfast.co.za/eng/process';


            $passphrase = config('services.payfast.passphrase');

           $queryString = http_build_query($data);

           if ($passphrase) {
              $queryString .= '&passphrase=' . urlencode($passphrase);
            }

            $data['signature'] = md5($queryString); 


        return redirect($url . '?' . http_build_query($data));
    }

    public function success()
    {
        return redirect()
            ->route('dashboard')
            ->with('success', 'Payment received.');
    }

    public function cancel()
    {
        return redirect()
            ->route('dashboard')
            ->with('error', 'Payment cancelled.');
    }

    public function notify(Request $request)
    {
        $payment = Payment::find($request->m_payment_id);

        if (!$payment) {
            return response('Payment not found', 404);
        }

        if ($request->payment_status !== 'COMPLETE') {
            return response('Ignored', 200);
        }

        $payment->update([
            'status' => 'Paid',
            'method' => 'PayFast',
            'transaction_id' => $request->pf_payment_id,
            'gateway_reference' => $request->pf_payment_id,
            'paid_at' => now(),
        ]);

        $payment->application()->update([
            'status' => 'Under Review',
        ]);

        return response('OK', 200);
    }


}
