<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::with('student')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        $payment = Payment::create($request->all());

        return response()->json([
            'message' => 'Payment created successfully',
            'payment' => $payment
        ], 201);
    }

    public function show($id)
    {
        $payment = Payment::with('student')->find($id);

        if (! $payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return $payment;
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);

        if (! $payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->update($request->all());

        return response()->json(['message' => 'Payment updated successfully']);
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);

        if (! $payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
