<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function invoice()
    {
        // Membuat data simulasi (dummy) pesanan agar sesuai dengan View BKPM
        $invoice = (object) [
            'id' => 'INV-001',
            'created_at' => Carbon::now(),
            'total' => 27500,
            'items' => [
                (object) [
                    'product' => (object) ['name' => 'Mie Goreng'],
                    'price' => 3500,
                    'quantity' => 5,
                    'total' => 17500
                ],
                (object) [
                    'product' => (object) ['name' => 'Kopi Kapal Api'],
                    'price' => 5000,
                    'quantity' => 2,
                    'total' => 10000
                ]
            ]
        ];

        // Memuat view dan merender PDF
        $pdf = Pdf::loadView('invoices.invoice', ['invoice' => $invoice]);
        
        // Mengunduh file PDF
        return $pdf->download('invoice_' . $invoice->id . '.pdf');
    }
}