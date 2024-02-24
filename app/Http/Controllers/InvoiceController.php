<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Product;

class InvoiceController extends Controller
{

    public function index()
    {
        $product = Product::first(); // Assuming you want to pass the first product
        $invoices = Invoice::with(['product', 'customer'])->get();
        return view('invoices.index', compact('invoices', 'product'));
    }
    
    
    public function create(Product $product)
    {
        $customers = Customer::all();
        return view('invoices.create', compact('product', 'customers'));
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $invoiceData = $request->all();
        $invoiceData['total_amount'] = $request->input('quantity') * $request->input('price');
    
        $invoice = Invoice::create($invoiceData);
    
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }
    public function edit(Invoice $invoice)
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('invoices.edit', compact('invoice', 'products', 'customers'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer',
            'price' => 'required|integer',
        ]);
    
        $invoiceData = $request->all();
        $invoiceData['total_amount'] = $request->input('quantity') * $request->input('price');
    
        $invoice->update($invoiceData);
    
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully!');
    }
    
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
    }
}





