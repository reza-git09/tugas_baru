<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function generate()
    {
        $pdf = Pdf::loadView('invoices.invoice');

        return $pdf->download('invoice-pembelian.pdf');
    }
}