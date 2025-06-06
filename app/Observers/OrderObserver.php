<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Support\Str;
use PDF;
use Illuminate\Support\Facades\File;


class OrderObserver
{
   public function created(Order $order)
{
    if (!$order->invoice) {
        $invoiceNumber = 'F-' . strtoupper(Str::random(8));

        $invoice = new Invoice();
        $invoice->order_id = $order->id;
        $invoice->invoice_number = $invoiceNumber;
        $invoice->invoice_date = now();
        $invoice->save();

        $pdf = PDF::loadView('invoices.pdf', ['invoice' => $invoice]);

        $directory = storage_path('app/public/invoices');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $pdfPath = 'invoices/' . $invoiceNumber . '.pdf';
        $pdf->save($directory . '/' . $invoiceNumber . '.pdf');

        $invoice->pdf_path = $pdfPath;
        $invoice->save();
    }
}
}

