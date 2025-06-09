<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;         // asegúrate de importar el facade correcto
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Genera la factura PDF de un pedido y la guarda en storage.
     *
     * @param  \App\Models\Order  $order
     * @return \App\Models\Invoice
     */
    public function generateInvoice(Order $order): Invoice
    {
        // Nº y fecha de factura
        $invoiceNumber = 'INV-' . strtoupper(Str::random(8));
        $invoiceDate   = Carbon::now();

        // Crea la factura en BD con una ruta temporal
        $invoice = Invoice::create([
            'order_id'       => $order->id,
            'invoice_number' => $invoiceNumber,
            'invoice_date'   => $invoiceDate,
            'pdf_path'       => 'temporal',
        ]);

        // Carga relaciones necesarias para la vista (evita N+1)
        $invoice->load(['order.items.product', 'order.user']);

        // Genera el PDF con la vista Blade
        $pdf = Pdf::loadView('invoices.template', [
            'invoice' => $invoice,
        ]);

        // Guarda el PDF en storage/app/public/invoices/...
        $pdfPath = "invoices/{$invoiceNumber}.pdf";
        $pdf->save(storage_path("app/public/{$pdfPath}"));

        // Actualiza la ruta real del PDF
        $invoice->update(['pdf_path' => $pdfPath]);

        return $invoice;
    }
}
