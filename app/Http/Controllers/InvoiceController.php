
<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Invoice;
use PDF; // Usa barryvdh/laravel-dompdf
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function generateInvoice(Order $order)
    {
        $invoiceNumber = 'INV-' . strtoupper(Str::random(8));
        $invoiceDate = Carbon::now();

        $pdf = PDF::loadView('invoices.template', compact('order', 'invoiceNumber', 'invoiceDate'));

        $pdfPath = 'invoices/' . $invoiceNumber . '.pdf';
        $pdf->save(storage_path('app/public/' . $pdfPath));

        $invoice = Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => $invoiceNumber,
            'invoice_date' => $invoiceDate,
            'pdf_path' => $pdfPath,
        ]);

        return $invoice;
    }
}
