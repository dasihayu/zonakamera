<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;

class InvoiceController extends Controller
{
    public function generatePDF(Booking $booking)
    {
        $totalDays = $booking->start_date->diffInDays($booking->end_date) + 1;
        $pdf = Pdf::loadView('invoices.invoice', compact('booking', 'totalDays'));
        return $pdf->download('invoice-' . $booking->booking_id . '.pdf');
    }
}
