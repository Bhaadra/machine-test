<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Invoice;
use PDF;



class PdfController extends Controller
{
    public function generatePdf()
    {
        $invoice = Invoice::first(); // Replace with your logic
        $customer = Customer::first(); // Or Customer::find($customerId);
        $product = Product::first(); // Or Product::find($productId);

        $data = [
            'title' => 'Invoice',
            'date' => date('d/m/y'),
            'customer' => $customer,
            'product' => $product,
            'invoice' => $invoice,
        ];

        $pdf = PDF::loadView('generate-product-pdf', $data);

        // Set a custom file name for the downloaded PDF
        return $pdf->download('Invoice-' . date('dmY') . '.pdf');
    }

    public function calculateTotal()
    {
        $products = Product::all();
        $totalValue = 0;

        foreach ($products as $product) {
            $totalValue += $product->quantity * $product->price;
        }

        return [
            'total_value' => $totalValue,
        ];
    }
}
