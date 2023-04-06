<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use DB;
use App\Models\Client;
// use Illuminate\Database\Eloquent\Model;

class InvoiceController extends Controller
{
    public function getInvoices(){

       $invoices = DB::table('invoice')
       ->join('client', 'client.client_id', '=', 'invoice.client_id')
       ->select('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at', 'invoice.equipment_serial_number', 'client.name', 'client.email', DB::raw('sum(invoice.cost) as total'))
       ->groupBy('invoice.invoice_number', 'invoice.client_id', 'invoice.created_at',  'invoice.equipment_serial_number', 'client.name', 'client.email')
       ->orderBy('created_at', 'desc')
       ->distinct()
       ->get();

        // $invoices = Invoice::query()->get();
        return $invoices;
    }





    public function store(Request $request)
    {
        try {





                $invoiceItem = new Invoice;
                $invoiceItem->invoice_number = $request->invoice_number;
                $invoiceItem->client_id = $request->client_id;
                $invoiceItem->equipment_serial_number = $request->equipment_serial_number;
                $invoiceItem->equipment = $request->equipment;
                $invoiceItem->quantity = $request->quantity;
                $invoiceItem->cost = $request->cost;
                $invoiceItem->save();

            return "success";
            // return redirect()->back()->with('success', 'Invoice added successfully!');
        } catch (\Exception $e) {
            // Redirect back with error message
            return "error";
            // return redirect()->back()->with('error', 'An error occurred while adding the invoice: ' . $e->getMessage());
        }
    }



}
