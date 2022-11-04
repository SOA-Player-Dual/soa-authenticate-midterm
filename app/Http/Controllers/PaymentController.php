<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\TransactionHistory;

use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessMail;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $account = Account::where('id', $request->id)->first();
        if ($account) {
            $updateAccount = $account->update([
                'surplus' => $account->surplus - $request->amount
            ]);
            if ($updateAccount) {
                $contentPayment = 'Tuition payment for ' . $request->student_id;
                $storeTransaction = TransactionHistory::create([
                    'account_id' => $request->id,
                    'content' => $contentPayment,
                    'amount' => $request->amount,
                    'created_at' => now(),
                ]);
                if ($storeTransaction) {
                    $sent = Mail::to($account['email'])->send(new PaymentSuccessMail([
                        'student_name' => $request->student_name,
                        'student_id' => $request->student_id,
                        'tuition_fee' => $request->amount,
                    ]));
                    if ($sent) {
                        return response()->json([
                            'message' => 'Payment success',
                        ], 200);
                    } else {
                        return response()->json([
                            'message' => 'Payment success but email not sent',
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'message' => 'Payment failed',
                    ], 400);
                }
                return response()->json([
                    'message' => 'Payment success',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Payment failed',
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'Account not found',
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
