<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
class InvoiceController extends Controller
{
    public function getInvoices(){
        $invoices = Invoice::query()->get();
        return $invoices;
    }

    public function store(Request $request){
        $request->validate([
            'client_id' => 'string',
            'invoice_id' => 'string',
            'equipment_serial_number' => 'string',
            'equipment' => 'email',
            'quantity' => 'string',
            'cost' => 'string',

        ]);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(100000, 99999)
            . mt_rand(100000, 99999)
            . $characters[rand(0, strlen($characters) - 1)];
        $random_string = str_shuffle($pin);

        $invoice = new Invoice();
        $invoice->invoice_id = $random_string;
        $invoice->client_id = $request->client_id;
        $invoice->equipment_serial_number = $request->equipment_serial_number;
        $invoice->equipment = $request->equipment;
        $invoice->quantity = $request->quantity;
        $invoice->cost = $request->cost;

        $invoice->invoiced_by = auth()->id();
        $invoice->save();

        return response()->json([
            'status' => 'success',
            'message' => 'New invoice successfully generated',
            'invoice' => $invoice,
        ]);

    }


}
